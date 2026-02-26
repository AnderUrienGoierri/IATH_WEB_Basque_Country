<?php
session_start();
// Language Logic
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// Translations
$t = [
    'en' => [
        'home' => 'Home',
        'videogames' => 'Videogames',
        'back' => 'Back to Catalog',
        'compare' => 'Compare with...',
        'search_placeholder' => 'Search game to compare...',
        'vs' => 'VS',
        'release_year' => 'Release Year',
        'genre' => 'Genre',
        'platform' => 'Platform',
        'price' => 'Price',
        'size' => 'Size',
        'playtime' => 'Avg Playtime',
        'age' => 'Avg Player Age',
        'gender' => 'Audience',
        'purchases' => 'In-Game Purchases',
        'origin' => 'Developer Origin',
        'free' => 'Free',
        'yes' => 'Yes',
        'no' => 'No'
    ],
    'es' => [
        'home' => 'Inicio',
        'videogames' => 'Videojuegos',
        'back' => 'Volver al Catálogo',
        'compare' => 'Comparar con...',
        'search_placeholder' => 'Buscar juego para comparar...',
        'vs' => 'VS',
        'release_year' => 'Año de Lanzamiento',
        'genre' => 'Género',
        'platform' => 'Plataforma',
        'price' => 'Precio',
        'size' => 'Tamaño',
        'playtime' => 'Tiempo Medio',
        'age' => 'Edad Media',
        'gender' => 'Audiencia',
        'purchases' => 'Compras Integradas',
        'origin' => 'Origen del Desarrollador',
        'free' => 'Gratis',
        'yes' => 'Sí',
        'no' => 'No'
    ]
];
$txt = $t[$lang];

require_once 'conexionDB.php';

// Get IDs
$id1 = isset($_GET['id']) ? intval($_GET['id']) : 0;
$id2 = isset($_GET['compare_id']) ? intval($_GET['compare_id']) : 0;

if ($id1 === 0) {
    header("Location: videogames.php");
    exit();
}

// Fetch Game 1
$sql1 = "SELECT v.*, g.name AS genre_name, p.name AS platform_name 
         FROM videoGames v 
         LEFT JOIN genres g ON v.genre_id = g.id 
         LEFT JOIN platforms p ON v.platform_id = p.id 
         WHERE v.id = $id1";
$result1 = $conn->query($sql1);
$game1 = $result1->fetch_assoc();

// Fetch Game 2 if exists
$game2 = null;
if ($id2 > 0) {
    $sql2 = "SELECT v.*, g.name AS genre_name, p.name AS platform_name 
             FROM videoGames v 
             LEFT JOIN genres g ON v.genre_id = g.id 
             LEFT JOIN platforms p ON v.platform_id = p.id 
             WHERE v.id = $id2";
    $result2 = $conn->query($sql2);
    $game2 = $result2->fetch_assoc();
}

// Fetch list for search/dropdown
$sqlList = "SELECT id, name FROM videoGames ORDER BY name ASC";
$resultList = $conn->query($sqlList);

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $game1['name']; ?> - GameMatch AI</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/videogame_details.css">
    
    <!-- Select2 for searchable dropdown -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>

    <!-- Header -->
    <header class="main-header">
        <div class="container header-inner">
            <a href="index.php" class="logo-group">
                <img src="../img/logo.png" alt="GameMatch AI Logo" class="logo-img">
            </a>
            <nav class="main-nav">
                <a href="index.php" class="nav-link"><?php echo $txt['home']; ?></a>
                <a href="videogames.php" class="nav-link"><?php echo $txt['videogames']; ?></a>
            </nav>
        </div>
    </header>

    <main class="container details-layout">
        
        <!-- Back Button -->
        <a href="videogames.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="back-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
            <?php echo $txt['back']; ?>
        </a>

        <!-- Comparison Bar -->
        <div class="comparison-bar">
            <h3 class="comparison-title"><?php echo $txt['compare']; ?></h3>
            <form class="comparison-form" action="" method="GET">
                <input type="hidden" name="id" value="<?php echo $id1; ?>">
                <input type="hidden" name="lang" value="<?php echo $lang; ?>">
                <select name="compare_id" id="compare-select" style="width: 100%;">
                    <option value=""><?php echo $txt['search_placeholder']; ?></option>
                    <?php while($row = $resultList->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>" <?php echo ($id2 == $row['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($row['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" class="compare-btn">
                    <?php echo $txt['vs']; ?>
                </button>
            </form>
        </div>

        <div class="details-grid <?php echo $game2 ? 'has-comparison' : ''; ?>">
            
            <!-- Game 1 -->
            <?php renderGameCard($game1, $txt, $game2 ? true : false); ?>

            <!-- Game 2 -->
            <?php if ($game2): ?>
                <?php renderGameCard($game2, $txt, true); ?>
            <?php elseif ($id2 > 0): ?>
                <div class="not-found-container">
                    <p>Game not found.</p>
                </div>
            <?php endif; ?>

        </div>

    </main>

    <script>
        $(document).ready(function() {
            $('#compare-select').select2({
                placeholder: "Search for a game...",
                allowClear: true
            });
        });
    </script>
    <script src="../js/videogame_details.js"></script>
</body>
</html>

<?php
function renderGameCard($row, $txt, $isComparison) {
    if (!$row) return;

    // Data Processing
    $image = !empty($row["image"]) ? $row["image"] : 'https://placehold.co/600x900?text=No+Image';
    if (!str_starts_with($image, 'http')) {
        $image = '../' . $image;
    }
    $price = $row["actual_price"] == 0 ? $txt['free'] : "$" . number_format($row["actual_price"], 2);
    
    // Ratio Calc
    $ratio = floatval($row["male_female_ratio"]);
    $pctFemale = ($ratio + 1) > 0 ? round((1 / ($ratio + 1)) * 100) : 50;
    $pctMale = 100 - $pctFemale;

    $purchases = $row["purchases_on_game"] ? '<span class="text-yes">'.$txt['yes'].'</span>' : '<span class="text-no">'.$txt['no'].'</span>';
?>
    <div class="game-info-container">
        <!-- Hero Header for Card -->
        <div class="hero-header">
            <div class="cover-art-container">
                 <img src="<?php echo htmlspecialchars($image); ?>" 
                      alt="<?php echo htmlspecialchars($row["name"]); ?>" 
                      class="cover-image">
                 <div class="cover-overlay"></div>
            </div>
            
            <div class="game-content">
                <div class="genre-badge">
                    <?php echo htmlspecialchars($row["genre_name"] ?? 'Unknown Genre'); ?>
                </div>
                <h1 class="game-title">
                    <?php echo htmlspecialchars($row["name"]); ?>
                </h1>
                <p class="game-description">
                    <?php echo htmlspecialchars($row["game_description"]); ?>
                </p>
                <div class="game-price"><?php echo $price; ?></div>
                <div class="purchases-info"><?php echo $txt['purchases']; ?>: <?php echo $purchases; ?></div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <?php renderStat($txt['release_year'], $row['release_year']); ?>
            <?php renderStat($txt['platform'], $row['platform_name']); ?>
            <?php renderStat($txt['origin'], $row['originated'] ?? 'Unknown'); ?>
            <?php renderStat($txt['size'], $row['size_gb'] . " GB"); ?>
            <?php renderStat($txt['playtime'], $row['average_playgame_duration'] . " min"); ?>
            <?php renderStat($txt['age'], $row['average_player_age'] . " years"); ?>
        </div>

        <!-- Gender Bar -->
        <div class="gender-section">
            <h4 class="section-title"><?php echo $txt['gender']; ?></h4>
            <div class="gender-bar-container">
                <div class="gender-fill male" style="width: <?php echo $pctMale; ?>%"></div>
                <div class="gender-fill female" style="width: <?php echo $pctFemale; ?>%"></div>
            </div>
            <div class="gender-legend">
                <span class="legend-male">Male: <?php echo $pctMale; ?>%</span>
                <span class="legend-female">Female: <?php echo $pctFemale; ?>%</span>
            </div>
        </div>

        <?php if (!empty($row["more_data"])): ?>
        <div class="tech-data-section">
            <h4 class="section-title">Technical Data</h4>
            <code class="tech-code">
                <?php echo htmlspecialchars($row["more_data"]); ?>
            </code>
        </div>
        <?php endif; ?>
    </div>
<?php
}

function renderStat($label, $value) {
    echo '
    <div class="stat-card">
        <span class="stat-label">'.$label.'</span>
        <span class="stat-value">'.htmlspecialchars($value).'</span>
    </div>';
}
?>
