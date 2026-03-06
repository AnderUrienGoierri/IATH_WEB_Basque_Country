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
        'title' => 'GameMatch AI - Find your perfect game',
        'home' => 'Home',
        'videogames' => 'Videogames',
        'login' => 'Login',
        'register' => 'Register',
        'powered_by' => 'Powered by Artificial Intelligence',
        'hero_title_1' => 'Discover your next',
        'hero_title_2' => 'favorite videogame',
        'hero_desc' => 'Don\'t know what to play? Our algorithm analyzes your preferences, time, and playstyle to recommend the perfect gem you\'ve been waiting for.',
        'btn_quiz' => 'Start Quiz',
        'btn_catalog' => 'Browse Catalog',
        'stats_games' => '+500 Games',
        'stats_ai' => 'Advanced AI',
        'stats_updated' => 'Updated 2026'
    ],
    'es' => [
        'title' => 'GameMatch AI - Encuentra tu juego perfecto',
        'home' => 'Inicio',
        'videogames' => 'Videojuegos',
        'login' => 'Iniciar Sesión',
        'register' => 'Registrarse',
        'powered_by' => 'Desarrollado con Inteligencia Artificial',
        'hero_title_1' => 'Descubre tu próximo',
        'hero_title_2' => 'videojuego favorito',
        'hero_desc' => '¿No sabes qué jugar? Nuestro algoritmo analiza tus preferencias, tiempo y estilo de juego para recomendarte la joya perfecta que estabas esperando.',
        'btn_quiz' => 'Iniciar Quiz',
        'btn_catalog' => 'Ver Catálogo',
        'stats_games' => '+500 Juegos',
        'stats_ai' => 'IA Avanzada',
        'stats_updated' => 'Actualizado 2026'
    ]
];
$txt = $t[$lang];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $txt['title']; ?></title>
    <!-- Google Fonts: Inter & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>

    <!-- Background Pattern -->
    <div class="bg-grid-pattern"></div>

    <!-- Header -->
    <header class="main-header">
        <div class="container header-inner">
            <!-- Logo -->
            <a href="index.php" class="logo-group">
                <img src="../img/logo.png" alt="GameMatch AI Logo" class="logo-img">
            </a>

            <!-- Navigation -->
            <nav class="main-nav">
                <a href="index.php" class="nav-link active"><?php echo $txt['home']; ?></a>
                <a href="videogames.php" class="nav-link"><?php echo $txt['videogames']; ?></a>
                
                <!-- Auth Buttons -->
                <div class="auth-buttons" style="display: flex; gap: 0.5rem; margin-left: 1rem; align-items: center;">
                    <a href="login.php" class="btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.875rem;"><?php echo $txt['login']; ?></a>
                    <a href="register.php" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;"><?php echo $txt['register']; ?></a>
                </div>

                <!-- Language Switcher -->
                <div class="lang-switcher">
                    <a href="?lang=en" class="lang-link <?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
                    <span style="color: var(--slate-700)">|</span>
                    <a href="?lang=es" class="lang-link <?php echo $lang === 'es' ? 'active' : ''; ?>">ES</a>
                </div>
            </nav>

            <!-- Mobile Menu Button (Optional placeholder for responsiveness) -->
            <button class="mobile-menu-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <main class="hero-section">
        <div class="container hero-content">
            
            <div class="powered-by-badge animate-fade-in-up">
                <?php echo $txt['powered_by']; ?>
            </div>

            <h1 class="hero-title animate-fade-in-up">
                <?php echo $txt['hero_title_1']; ?> <br class="hidden md:block" />
                <span class="hero-title-gradient"><?php echo $txt['hero_title_2']; ?></span>
            </h1>

            <p class="hero-desc animate-fade-in-up">
                <?php echo $txt['hero_desc']; ?>
            </p>

            <div class="cta-group animate-fade-in-up">
                <!-- CIA Button (Link to Quiz - setup for future) -->
                <a href="#" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                    </svg>
                    <?php echo $txt['btn_quiz']; ?>
                </a>
                
                <a href="videogames.php" class="btn-secondary">
                    <?php echo $txt['btn_catalog']; ?>
                </a>
            </div>

            <!-- Stats or Socials Placeholder -->
            <div class="stats-footer animate-fade-in-up">
                <span class="stat-item"><span class="dot dot-green"></span> <?php echo $txt['stats_games']; ?></span>
                <span class="stat-item"><span class="dot dot-blue"></span> <?php echo $txt['stats_ai']; ?></span>
                <span class="stat-item"><span class="dot dot-violet"></span> <?php echo $txt['stats_updated']; ?></span>
            </div>

        </div>
    </main>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/index.js"></script>
</body>
</html>
