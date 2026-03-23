<?php
require_once 'php_helpers/language.php';
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
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

    <!-- Background Pattern -->
    <div class="bg-grid-pattern"></div>

    <?php include_once 'php_includes/header.php'; ?>

    <!-- Hero Section -->
    <main class="hero-section">
        <div class="container hero-content">
            
            <div class="powered-by-badge animate-fade-in-up">
                <?php echo $txt['powered_by']; ?>
            </div>

            <h1 class="hero-title animate-fade-in-up">
                <?php echo $txt['hero_title_1']; ?> <br />
                <span class="hero-title-gradient"><?php echo $txt['hero_title_2']; ?></span>
            </h1>

            <p class="hero-desc animate-fade-in-up">
                <?php echo $txt['hero_desc']; ?>
            </p>

            <div class="cta-group animate-fade-in-up">
                <?php if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'): ?>
                    <a href="php_user/quiz.php" class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        <?php echo $txt['btn_quiz']; ?>
                    </a>
                <?php else: ?>
                    <a href="php_admin/admin_dashboard.php" class="btn-primary" style="background: var(--violet-600);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                        Admin Portal
                    </a>
                <?php endif; ?>
                
                <a href="php_generic/videogames.php" class="btn-secondary">
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
    
    <?php include_once 'php_includes/footer.php'; ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/header.js"></script>
    <script src="js/index.js"></script>
</body>
</html>


