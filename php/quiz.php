<?php
session_start();
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

// Translations
$t = [
    'en' => [
        'title' => 'Quiz - GameMatch AI',
        'home' => 'Home',
        'videogames' => 'Videogames',
        'logout' => 'Logout',
        'welcome' => 'Welcome',
        'quiz_link' => 'Start Quiz',
        'login' => 'Login',
        'register' => 'Register',
        'progress' => 'Step',
        'of' => 'of',
        // Step 1 — Device
        'step1_title' => 'Your platform',
        'step1_subtitle' => 'What device do you usually play on?',
        'device_pc' => 'PC',
        'device_ps' => 'PlayStation',
        'device_xbox' => 'Xbox',
        'device_switch' => 'Nintendo Switch',
        'device_mobile' => 'Mobile',
        'device_any' => 'Any platform',
        // Step 2 — Time
        'step2_title' => 'Your time',
        'step2_subtitle' => 'How much time do you have for a gaming session?',
        'time_short' => 'Quick game',
        'time_short_desc' => '< 30 min',
        'time_medium' => 'Normal session',
        'time_medium_desc' => '30–90 min',
        'time_long' => 'Long session',
        'time_long_desc' => '90+ min',
        // Step 3 — Mood
        'step3_title' => 'Your mood',
        'step3_subtitle' => 'What kind of experience are you looking for?',
        'mood_action' => 'Action',
        'mood_action_desc' => 'Adrenaline & combat',
        'mood_adventure' => 'Adventure',
        'mood_adventure_desc' => 'Explore & discover',
        'mood_strategy' => 'Strategy',
        'mood_strategy_desc' => 'Think & plan',
        'mood_relax' => 'Relaxing',
        'mood_relax_desc' => 'Chill & unwind',
        'mood_horror' => 'Horror',
        'mood_horror_desc' => 'Fear & suspense',
        'mood_sport' => 'Sports/Racing',
        'mood_sport_desc' => 'Compete & speed',
        // Nav
        'next' => 'Next',
        'back' => 'Back',
        'submit' => 'Get Recommendations!',
        'error_select' => 'Please select an option to continue.'
    ],
    'es' => [
        'title' => 'Quiz - GameMatch AI',
        'home' => 'Inicio',
        'videogames' => 'Videojuegos',
        'logout' => 'Cerrar Sesión',
        'welcome' => 'Bienvenido',
        'quiz_link' => 'Iniciar Quiz',
        'login' => 'Iniciar Sesión',
        'register' => 'Registrarse',
        'progress' => 'Paso',
        'of' => 'de',
        // Step 1
        'step1_title' => 'Tu plataforma',
        'step1_subtitle' => '¿En qué dispositivo sueles jugar?',
        'device_pc' => 'PC',
        'device_ps' => 'PlayStation',
        'device_xbox' => 'Xbox',
        'device_switch' => 'Nintendo Switch',
        'device_mobile' => 'Móvil',
        'device_any' => 'Cualquier plataforma',
        // Step 2
        'step2_title' => 'Tu tiempo',
        'step2_subtitle' => '¿Cuánto tiempo tienes para jugar?',
        'time_short' => 'Partida rápida',
        'time_short_desc' => '< 30 min',
        'time_medium' => 'Sesión normal',
        'time_medium_desc' => '30–90 min',
        'time_long' => 'Sesión larga',
        'time_long_desc' => '90+ min',
        // Step 3
        'step3_title' => 'Tu estado de ánimo',
        'step3_subtitle' => '¿Qué tipo de experiencia buscas?',
        'mood_action' => 'Acción',
        'mood_action_desc' => 'Adrenalina y combate',
        'mood_adventure' => 'Aventura',
        'mood_adventure_desc' => 'Explorar y descubrir',
        'mood_strategy' => 'Estrategia',
        'mood_strategy_desc' => 'Pensar y planificar',
        'mood_relax' => 'Relajante',
        'mood_relax_desc' => 'Tranquilidad',
        'mood_horror' => 'Terror',
        'mood_horror_desc' => 'Miedo y suspense',
        'mood_sport' => 'Deportes/Carreras',
        'mood_sport_desc' => 'Competir y velocidad',
        // Nav
        'next' => 'Siguiente',
        'back' => 'Atrás',
        'submit' => '¡Ver Recomendaciones!',
        'error_select' => 'Selecciona una opción para continuar.'
    ]
];
$txt = $t[$lang];

require_once 'conexionDB.php';

// Handle POST — save quiz to DB and redirect to results
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $device = trim($_POST['device'] ?? '');
    $time = intval($_POST['time'] ?? 0);
    $mood = trim($_POST['mood'] ?? '');
    $user_id = $_SESSION['user_id'];

    if (!empty($device) && $time > 0 && !empty($mood)) {
        $stmt = $conn->prepare("INSERT INTO game_match_sessions (user_id, device_preference, available_time_preference, mood_preference) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $user_id, $device, $time, $mood);
        
        if ($stmt->execute()) {
            $session_id = $stmt->insert_id;
            $stmt->close();
            $conn->close();
            // Redirect to results page with session ID
            header("Location: results.php?session_id=" . $session_id);
            exit();
        }
        $stmt->close();
    }
}
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
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/quiz.css">
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
                    <span class="welcome-text"><?php echo $txt['welcome']; ?>, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                    <a href="logout.php" class="btn-logout"><?php echo $txt['logout']; ?></a>
                </div>
                <div class="lang-switcher">
                    <a href="?lang=en" class="lang-link <?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
                    <span style="color: var(--slate-700)">|</span>
                    <a href="?lang=es" class="lang-link <?php echo $lang === 'es' ? 'active' : ''; ?>">ES</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Quiz -->
    <main class="quiz-page">
        <div class="quiz-container">

            <!-- Progress Bar -->
            <div class="quiz-progress">
                <span class="progress-label"><?php echo $txt['progress']; ?></span>
                <div class="progress-step active"></div>
                <div class="progress-step"></div>
                <div class="progress-step"></div>
            </div>

            <!-- Hidden Form (submitted on final step) -->
            <form id="quiz-form" method="POST" action="">
                <input type="hidden" id="input-device" name="device" value="">
                <input type="hidden" id="input-time" name="time" value="">
                <input type="hidden" id="input-mood" name="mood" value="">
            </form>

            <!-- Step 1: Device -->
            <div class="quiz-step active" data-field="device">
                <h2 class="step-title"><?php echo $txt['step1_title']; ?></h2>
                <p class="step-subtitle"><?php echo $txt['step1_subtitle']; ?></p>

                <div class="option-grid">
                    <div class="option-card" data-value="PC">
                        <span class="option-icon">🖥️</span>
                        <span class="option-label"><?php echo $txt['device_pc']; ?></span>
                    </div>
                    <div class="option-card" data-value="PlayStation">
                        <span class="option-icon">🎮</span>
                        <span class="option-label"><?php echo $txt['device_ps']; ?></span>
                    </div>
                    <div class="option-card" data-value="Xbox">
                        <span class="option-icon">🟢</span>
                        <span class="option-label"><?php echo $txt['device_xbox']; ?></span>
                    </div>
                    <div class="option-card" data-value="Nintendo Switch">
                        <span class="option-icon">🕹️</span>
                        <span class="option-label"><?php echo $txt['device_switch']; ?></span>
                    </div>
                    <div class="option-card" data-value="Mobile">
                        <span class="option-icon">📱</span>
                        <span class="option-label"><?php echo $txt['device_mobile']; ?></span>
                    </div>
                    <div class="option-card" data-value="Multi-platform">
                        <span class="option-icon">🌐</span>
                        <span class="option-label"><?php echo $txt['device_any']; ?></span>
                    </div>
                </div>
            </div>

            <!-- Step 2: Time -->
            <div class="quiz-step" data-field="time">
                <h2 class="step-title"><?php echo $txt['step2_title']; ?></h2>
                <p class="step-subtitle"><?php echo $txt['step2_subtitle']; ?></p>

                <div class="option-grid three-col">
                    <div class="option-card" data-value="30">
                        <span class="option-icon">⚡</span>
                        <span class="option-label"><?php echo $txt['time_short']; ?></span>
                        <span class="option-desc"><?php echo $txt['time_short_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="60">
                        <span class="option-icon">⏱️</span>
                        <span class="option-label"><?php echo $txt['time_medium']; ?></span>
                        <span class="option-desc"><?php echo $txt['time_medium_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="120">
                        <span class="option-icon">🕐</span>
                        <span class="option-label"><?php echo $txt['time_long']; ?></span>
                        <span class="option-desc"><?php echo $txt['time_long_desc']; ?></span>
                    </div>
                </div>
            </div>

            <!-- Step 3: Mood -->
            <div class="quiz-step" data-field="mood">
                <h2 class="step-title"><?php echo $txt['step3_title']; ?></h2>
                <p class="step-subtitle"><?php echo $txt['step3_subtitle']; ?></p>

                <div class="option-grid">
                    <div class="option-card" data-value="Action">
                        <span class="option-icon">💥</span>
                        <span class="option-label"><?php echo $txt['mood_action']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_action_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Adventure">
                        <span class="option-icon">🗺️</span>
                        <span class="option-label"><?php echo $txt['mood_adventure']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_adventure_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Strategy">
                        <span class="option-icon">🧠</span>
                        <span class="option-label"><?php echo $txt['mood_strategy']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_strategy_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Relaxing">
                        <span class="option-icon">🌿</span>
                        <span class="option-label"><?php echo $txt['mood_relax']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_relax_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Horror">
                        <span class="option-icon">👻</span>
                        <span class="option-label"><?php echo $txt['mood_horror']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_horror_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Sports">
                        <span class="option-icon">🏆</span>
                        <span class="option-label"><?php echo $txt['mood_sport']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_sport_desc']; ?></span>
                    </div>
                </div>
            </div>

            <!-- Error -->
            <div id="quiz-error" class="quiz-error" data-select-msg="<?php echo $txt['error_select']; ?>"></div>

            <!-- Navigation -->
            <div class="quiz-nav">
                <button id="btn-back" class="btn-quiz-back" style="display: none;"><?php echo $txt['back']; ?></button>
                <button id="btn-next" class="btn-quiz-next" disabled 
                        data-next-text="<?php echo $txt['next']; ?>" 
                        data-submit-text="<?php echo $txt['submit']; ?>">
                    <?php echo $txt['next']; ?>
                </button>
            </div>

        </div>

        <!-- Loading State -->
        <div id="quiz-loading" class="quiz-loading">
            <div class="loading-spinner"></div>
            <p class="loading-text">Analyzing your preferences...</p>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/quiz.js"></script>
</body>
</html>
