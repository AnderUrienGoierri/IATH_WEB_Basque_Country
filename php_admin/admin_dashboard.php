<?php
require_once '../php_helpers/language.php';
require_once '../php_helpers/conexionDB.php';

// Security: Only admins can access this page
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GameMatch AI</title>
    <link rel="icon" type="image/png" href="/IATH_WEB_Basque_Country/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/header.js"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <?php include_once '../php_includes/header.php'; ?>

    <main class="container admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <h3 style="font-family: 'Poppins'; font-size: 1.25rem; margin-bottom: 0.5rem; color: white;">Admin Panel</h3>
            <a href="admin_dashboard.php" class="admin-link active">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Dashboard Home
            </a>
            <a href="admin_add_game.php" class="admin-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add New Game
            </a>
            <a href="admin_users.php" class="admin-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Manage Users
            </a>
        </aside>

        <!-- Content -->
        <section class="admin-content">
            <h2 class="page-title" style="margin-bottom: 1rem;">Welcome, Admin!</h2>
            <p style="color: var(--slate-300); margin-bottom: 2rem;">
                This is the GameMatch AI control panel. From here, you can manage the video game catalog and monitor registered user quiz activity.
            </p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                <div style="background: rgba(139, 92, 246, 0.1); border: 1px solid var(--violet-500); padding: 1.5rem; border-radius: 8px; text-align: center;">
                    <?php 
                        $res = $conn->query("SELECT COUNT(*) as c FROM videoGames");
                        $countGames = $res->fetch_assoc()['c'];
                    ?>
                    <h3 style="font-size: 2.5rem; color: white; margin-bottom: 0.5rem;"><?php echo $countGames; ?></h3>
                    <p style="color: var(--violet-300); font-weight: 600;">Total Games</p>
                </div>
                
                <div style="background: rgba(56, 189, 248, 0.1); border: 1px solid var(--blue-500); padding: 1.5rem; border-radius: 8px; text-align: center;">
                    <?php 
                        $res = $conn->query("SELECT COUNT(*) as c FROM users WHERE role = 'user'");
                        $countUsers = $res->fetch_assoc()['c'];
                    ?>
                    <h3 style="font-size: 2.5rem; color: white; margin-bottom: 0.5rem;"><?php echo $countUsers; ?></h3>
                    <p style="color: var(--blue-300); font-weight: 600;">Registered Users</p>
                </div>
            </div>
        </section>
    </main>

    <?php include_once '../php_includes/footer.php'; ?>

</body>
</html>
