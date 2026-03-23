<?php
// We expect $txt and $lang to be defined in the parent script before including this file.

// Determine the current page to apply active styles correctly
$currentPage = basename($_SERVER['PHP_SELF']);

// Determine path prefix based on whether we are in a subfolder
$isSubfolder = stripos($_SERVER['PHP_SELF'], '/php_user/') !== false || 
               stripos($_SERVER['PHP_SELF'], '/php_admin/') !== false || 
               stripos($_SERVER['PHP_SELF'], '/php_generic/') !== false;
$prefix = $isSubfolder ? '../' : '';

// Admin-specific path logic
$inAdmin = str_contains($_SERVER['PHP_SELF'], '/php_admin/');
$adminPath = $inAdmin ? '' : ($prefix . 'php_admin/');
?>
<!-- Header -->
<header class="main-header">
    <div class="container header-inner">
        <a href="<?php echo $prefix; ?>index.php" class="logo-group">
            <img src="<?php echo $prefix; ?>img/logo.png" alt="GameMatch AI Logo" class="logo-img">
        </a>
        <nav class="main-nav">
            <?php if (!str_contains($_SERVER['PHP_SELF'], '/php_admin/')): ?>
                <a href="<?php echo $prefix; ?>index.php" class="nav-link <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>"><?php echo $txt['home']; ?></a>
                <a href="<?php echo $prefix; ?>php_generic/videogames.php" class="nav-link <?php echo ($currentPage === 'videogames.php' || $currentPage === 'videogame_details.php') ? 'active' : ''; ?>"><?php echo $txt['videogames']; ?></a>
            <?php else: ?>
                <a href="<?php echo $adminPath; ?>admin_dashboard.php" class="nav-link <?php echo $currentPage === 'admin_dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
            <?php endif; ?>
            
            <!-- Auth / User Area -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-welcome">
                    <span class="welcome-text"><?php echo $txt['welcome']; ?>, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                    
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <div class="admin-dropdown">
                            <button class="btn-quiz-header admin-dropdown-btn <?php echo strpos($currentPage, 'admin_') === 0 ? 'active' : ''; ?>" style="background: var(--violet-600); border-color: var(--violet-400); margin-right: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="margin-right:0.2rem">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Admin Panel 
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="margin-left: 0.3rem; opacity: 0.8;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="admin-dropdown-content">
                                <a href="<?php echo $adminPath; ?>admin_dashboard.php" class="dropdown-item">
                                    <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </span> Analytics Dashboard
                                </a>
                                <a href="<?php echo $adminPath; ?>admin_add_game.php" class="dropdown-item">
                                    <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 5H9a7 7 0 00-7 7v5h2v-1a1 1 0 011-1h2a1 1 0 011 1v1h2V5zm0 0h6a7 7 0 017 7v5h-2v-1a1 1 0 00-1-1h-2a1 1 0 00-1 1v1h-2V5z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 10h2m-1-1v2m11-2l.01.01m2.99.99l.01.01" />
                                        </svg>
                                    </span> Add New Game
                                </a>
                                <a href="<?php echo $adminPath; ?>admin_users.php" class="dropdown-item">
                                    <span class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </span> Manage Users
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!str_contains($_SERVER['PHP_SELF'], '/php_admin/') && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')): ?>
                        <a href="<?php echo $prefix; ?>php_user/quiz.php" class="btn-quiz-header <?php echo $currentPage === 'quiz.php' ? 'active' : ''; ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M10.146 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L12.793 5l-2.647-2.646a.5.5 0 0 1 0-.708z"/>
                                <path d="M2 5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8A.5.5 0 0 1 2 5z"/>
                            </svg>
                            <?php echo $txt['quiz_link']; ?>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo $prefix; ?>php_helpers/logout.php" class="btn-logout"><?php echo $txt['logout']; ?></a>
                </div>
            <?php else: ?>
                <div class="auth-buttons" style="display: flex; gap: 0.5rem; margin-left: 1rem; align-items: center;">
                    <a href="<?php echo $prefix; ?>php_generic/login.php" class="btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.875rem;"><?php echo $txt['login']; ?></a>
                    <a href="<?php echo $prefix; ?>php_generic/register.php" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;"><?php echo $txt['register']; ?></a>
                </div>
            <?php endif; ?>

            <!-- Language Switcher -->
            <div class="lang-switcher">
                <a href="?lang=eu" class="lang-link <?php echo $lang === 'eu' ? 'active' : ''; ?>">EU</a>
                <span style="color: var(--slate-700)">|</span>
                <a href="?lang=es" class="lang-link <?php echo $lang === 'es' ? 'active' : ''; ?>">ES</a>
                <span style="color: var(--slate-700)">|</span>
                <a href="?lang=en" class="lang-link <?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
                <span style="color: var(--slate-700)">|</span>
                <a href="?lang=nl" class="lang-link <?php echo $lang === 'nl' ? 'active' : ''; ?>">NL</a>
            </div>
        </nav>

        <!-- Mobile Menu Toggle -->
        <button class="mobile-menu-btn" aria-label="Toggle Menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>
</header>
