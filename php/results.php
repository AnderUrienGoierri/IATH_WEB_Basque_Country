<?php
session_start();
require_once 'conexionDB.php';

// Language Logic
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Session ID from URL
$session_id = isset($_GET['session_id']) ? intval($_GET['session_id']) : 0;
if ($session_id <= 0) {
    header("Location: index.php");
    exit();
}

// Fetch Quiz Data
$stmt = $conn->prepare("SELECT * FROM game_match_sessions WHERE id = ? AND user_id = ?");
$user_id = $_SESSION['user_id'];
$stmt->bind_param("ii", $session_id, $user_id);
$stmt->execute();
$quiz = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$quiz) {
    header("Location: index.php");
    exit();
}

// Translations
$t = [
    'en' => [
        'title' => 'Your Recommendations - GameMatch AI',
        'home' => 'Home',
        'videogames' => 'Videogames',
        'logout' => 'Logout',
        'subtitle' => 'Based on your preferences, we found the perfect games for you.',
        'match' => 'MATCH',
        'top_match' => 'YOUR #1 MATCH',
        'others' => 'OTHER RECOMMENDATIONS',
        'see_details' => 'See Details',
        'platform' => 'Platform',
        'duration' => 'Avg. Playtime',
        'genre' => 'Genre',
        'rank' => 'RANK',
        'loading' => 'Calculating matches...'
    ],
    'es' => [
        'title' => 'Tus Recomendaciones - GameMatch AI',
        'home' => 'Inicio',
        'videogames' => 'Videojuegos',
        'logout' => 'Cerrar Sesión',
        'subtitle' => 'Basándonos en tus preferencias, hemos encontrado los juegos perfectos para ti.',
        'match' => 'COINCIDENCIA',
        'top_match' => 'TU MEJOR OPCIÓN #1',
        'others' => 'OTRAS RECOMENDACIONES',
        'see_details' => 'Ver Detalles',
        'platform' => 'Plataforma',
        'duration' => 'Duración media',
        'genre' => 'Género',
        'rank' => 'PUESTO',
        'loading' => 'Calculando coincidencias...'
    ]
];
$txt = $t[$lang];

// AI ALGORITHM LOGIC
// 1. Fetch all games with genre and platform names
$sql = "SELECT vg.*, g.name AS genre_name, p.name AS platform_name 
        FROM videoGames vg
        LEFT JOIN genres g ON vg.genre_id = g.id
        LEFT JOIN platforms p ON vg.platform_id = p.id";
$result = $conn->query($sql);
$games = [];
while ($row = $result->fetch_assoc()) {
    $games[] = $row;
}

// Mood to Genre Mapping (IDs)
$mood_map = [
    'Action' => [14, 17, 24, 25, 39, 40, 54], // Action RPG, FPS, Fighting, TPS, etc.
    'Adventure' => [13, 15, 31, 32, 44],      // Action-Adventure, Sandbox, Metroidvania, etc.
    'Strategy' => [35, 46, 47, 48],           // Deckbuilder, City-building, Strategy, etc.
    'Relaxing' => [21, 22, 45, 51, 55],       // Sim, Social Sim, life sim, puzzle, fishing
    'Horror' => [19, 30],                     // Survival Horror, Survival
    'Sports' => [23, 38]                      // Racing, Sports
];

$user_device = $quiz['device_preference'];
$user_time = $quiz['available_time_preference'];
$user_mood = $quiz['mood_preference'];

$scored_games = [];

foreach ($games as $game) {
    $score = 0;
    
    // 1. Platform (40%)
    if ($game['platform_name'] == $user_device || $game['platform_name'] == 'Multi-platform') {
        $score += 40;
    } elseif (strpos($game['platform_name'], $user_device) !== false) {
        $score += 35; // Partial match (e.g. Switch vs Nintendo Switch)
    }

    // 2. Time (30%)
    $game_time = $game['average_playgame_duration'];
    if ($game_time > 0) {
        $diff = abs($game_time - $user_time);
        $time_score = max(0, 30 * (1 - ($diff / ($user_time * 2))));
        $score += $time_score;
    } else {
        $score += 15; // Neutral if no time data
    }

    // 3. Mood/Genre (30%)
    $allowed_genres = $mood_map[$user_mood] ?? [];
    if (in_array($game['genre_id'], $allowed_genres)) {
        $score += 30;
    } else {
        // Broad genre match
        $score += 5; 
    }

    $game['match_score'] = round($score, 1);
    $scored_games[] = $game;
}

// Sort by match_score DESC
usort($scored_games, function($a, $b) {
    return $b['match_score'] <=> $a['match_score'];
});

// Take Top 10
$top_10 = array_slice($scored_games, 0, 10);

// Save to recommendations table (only if not already there for this session)
$check_stmt = $conn->prepare("SELECT id FROM recommendations WHERE session_id = ?");
$check_stmt->bind_param("i", $session_id);
$check_stmt->execute();
if ($check_stmt->get_result()->num_rows == 0) {
    $ins_stmt = $conn->prepare("INSERT INTO recommendations (session_id, game_id, match_score, rank_position) VALUES (?, ?, ?, ?)");
    foreach ($top_10 as $index => $game) {
        $rank = $index + 1;
        $ins_stmt->bind_param("iiii", $session_id, $game['id'], $game['match_score'], $rank);
        $ins_stmt->execute();
    }
    $ins_stmt->close();
}
$check_stmt->close();

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $txt['title']; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/results.css">
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
                <div class="user-welcome">
                    <span class="welcome-text"><strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                    <a href="logout.php" class="btn-logout"><?php echo $txt['logout']; ?></a>
                </div>
                <div class="lang-switcher">
                    <a href="?session_id=<?php echo $session_id; ?>&lang=en" class="lang-link <?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
                    <span style="color: var(--slate-700)">|</span>
                    <a href="?session_id=<?php echo $session_id; ?>&lang=es" class="lang-link <?php echo $lang === 'es' ? 'active' : ''; ?>">ES</a>
                </div>
            </nav>
        </div>
    </header>

    <main class="results-page">
        <div class="results-container">
            
            <header class="results-header fade-in-up">
                <h1 class="results-title"><?php echo $txt['title']; ?></h1>
                <p class="results-subtitle"><?php echo $txt['subtitle']; ?></p>
            </header>

            <?php if (!empty($top_10)): 
                $best = $top_10[0];
            ?>
                <!-- TOP 1 MATCH -->
                <section class="match-hero fade-in-up" style="animation-delay: 0.2s">
                    <div class="hero-image-container">
                        <img src="../<?php echo !empty($best['image']) ? $best['image'] : 'img/placeholder.jpg'; ?>" 
                             alt="<?php echo htmlspecialchars($best['name']); ?>" class="hero-image">
                    </div>
                    <div class="hero-content">
                        <div class="match-badge-large">
                            ✨ <?php echo $best['match_score']; ?>% <?php echo $txt['match']; ?>
                        </div>
                        <h2 class="hero-title"><?php echo htmlspecialchars($best['name']); ?></h2>
                        <p class="hero-description"><?php echo htmlspecialchars($best['game_description'] ?? ''); ?></p>
                        
                        <div class="hero-stats">
                            <div class="stat-item">
                                <span class="stat-value"><?php echo htmlspecialchars($best['platform_name']); ?></span>
                                <span class="stat-label"><?php echo $txt['platform']; ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?php echo $best['average_playgame_duration']; ?> min</span>
                                <span class="stat-label"><?php echo $txt['duration']; ?></span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?php echo htmlspecialchars($best['genre_name']); ?></span>
                                <span class="stat-label"><?php echo $txt['genre']; ?></span>
                            </div>
                        </div>

                        <a href="videogame_details.php?id=<?php echo $best['id']; ?>" class="btn-primary" style="padding: 1rem 2.5rem; width: fit-content;">
                            <?php echo $txt['see_details']; ?>
                        </a>
                    </div>
                </section>

                <h3 class="step-title fade-in-up" style="margin-bottom: 2rem; animation-delay: 0.4s">
                    <?php echo $txt['others']; ?>
                </h3>

                <!-- OTHER MATCHES (2-10) -->
                <div class="results-grid">
                    <?php for ($i = 1; $i < count($top_10); $i++): 
                        $game = $top_10[$i];
                    ?>
                        <article class="match-card fade-in-up" style="animation-delay: <?php echo 0.4 + ($i * 0.1); ?>s">
                            <div class="card-image-wrap">
                                <img src="../<?php echo !empty($game['image']) ? $game['image'] : 'img/placeholder.jpg'; ?>" 
                                     alt="<?php echo htmlspecialchars($game['name']); ?>" class="card-image">
                                <div class="match-badge-small">
                                    <?php echo $game['match_score']; ?>%
                                </div>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title"><?php echo htmlspecialchars($game['name']); ?></h4>
                                <span class="card-genre"><?php echo htmlspecialchars($game['genre_name']); ?></span>
                                
                                <div class="card-footer">
                                    <span class="card-rank">#<?php echo $i + 1; ?></span>
                                    <a href="videogame_details.php?id=<?php echo $game['id']; ?>" class="btn-secondary" style="font-size: 0.8125rem; padding: 0.5rem 1rem;">
                                        <?php echo $txt['see_details']; ?>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endfor; ?>
                </div>

            <?php endif; ?>

        </div>
    </main>

    <footer class="main-footer" style="background: transparent; border-top: 1px solid rgba(255,255,255,0.05); margin-top: 5rem;">
        <div class="container" style="text-align: center; color: var(--slate-500); font-size: 0.875rem;">
            &copy; 2026 GameMatch AI. All rights reserved.
        </div>
    </footer>

</body>
</html>
