<?php
require_once '../php_helpers/language.php';
require_once '../php_helpers/conexionDB.php';

// Get session ID from URL
$session_id = isset($_GET['session_id']) ? intval($_GET['session_id']) : 0;

if ($session_id === 0) {
    header("Location: quiz.php");
    exit();
}

// Fetch quiz session data
$qStmt = $conn->prepare("SELECT * FROM game_match_sessions WHERE id = ?");
$qStmt->bind_param("i", $session_id);
$qStmt->execute();
$qRes = $qStmt->get_result();
$quiz = $qRes->fetch_assoc();
$qStmt->close();

if (!$quiz) {
    header("Location: quiz.php");
    exit();
}

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
// Mood to Genre Mapping (IDs based on insert_gamequiz_DB.sql)
$mood_map = [
    'Action' => [1, 2, 5, 6, 12, 13, 16, 17, 21, 27, 28, 40, 41, 42],
    'Adventure' => [1, 3, 4, 7, 18, 19, 24, 29, 30, 32],
    'Strategy' => [2, 8, 14, 15, 20, 22, 23, 24, 31, 35, 36, 40],
    'Relaxing' => [9, 10, 22, 33, 34, 37, 39, 43],
    'Horror' => [7, 12, 18],
    'Sports' => [11, 26]
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
    <link rel="icon" type="image/png" href="/IATH_WEB_Basque_Country/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/results.css">
</head>
<body>

    <?php include_once '../php_includes/header.php'; ?>

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
                            <img src="../svg/sparkles.svg" alt="Match" style="width: 1.2em; height: 1.2em; vertical-align: middle; filter: invert(1);"> <?php echo $best['match_score']; ?>% <?php echo $txt['match']; ?>
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

                        <a href="../php_generic/videogame_details.php?id=<?php echo $best['id']; ?>" class="btn-primary" style="padding: 1rem 2.5rem; width: fit-content;">
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
                                    <a href="../php_generic/videogame_details.php?id=<?php echo $game['id']; ?>" class="btn-secondary" style="font-size: 0.8125rem; padding: 0.5rem 1rem;">
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

    <?php include_once '../php_includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/header.js"></script>
</body>
</html>


