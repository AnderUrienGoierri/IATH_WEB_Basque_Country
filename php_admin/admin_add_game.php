<?php
require_once '../php_helpers/language.php';
require_once '../php_helpers/conexionDB.php';

// Security check
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $platform_id = $_POST['platform_id'] ?? null;
    $size_gb = $_POST['size_gb'] ?? 0;
    $genre_id = $_POST['genre_id'] ?? null;
    $release_year = $_POST['release_year'] ?? date('Y');
    $desc = $_POST['game_description'] ?? '';
    
    // Default image if upload fails or is skipped
    $imagePath = 'https://placehold.co/600x900?text=No+Image';
    
    $originated = $_POST['originated'] ?? '';
    $price = $_POST['actual_price'] ?? 0;
    $purchases = isset($_POST['purchases_on_game']) ? 1 : 0;
    $avg_time = $_POST['average_playgame_duration'] ?? 0;
    $avg_age = $_POST['average_player_age'] ?? 0;
    $ratio = $_POST['male_female_ratio'] ?? 1.00;

    if (empty($name) || empty($platform_id) || empty($genre_id)) {
        $error = "Name, Platform, and Genre are required.";
    } else {
        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../videogame_images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            // Generate safe filename based on game name
            $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($name));
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            
            $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            if (in_array($ext, $allowedExts)) {
                $filename = $safeName . '_' . time() . '.' . $ext;
                $destFile = $uploadDir . $filename;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $destFile)) {
                    $imagePath = 'videogame_images/' . $filename;
                } else {
                    $error = "Failed to save the uploaded image.";
                }
            } else {
                $error = "Invalid image format. Only JPG, PNG, WEBP, and GIF are allowed.";
            }
        }

        if (empty($error)) {
            $stmt = $conn->prepare("INSERT INTO videoGames 
            (name, platform_id, size_gb, genre_id, release_year, game_description, image, originated, actual_price, purchases_on_game, average_playgame_duration, average_player_age, male_female_ratio) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sidiisssdiiid", 
            $name, $platform_id, $size_gb, $genre_id, $release_year, $desc, $imagePath, $originated, 
            $price, $purchases, $avg_time, $avg_age, $ratio
        );

        if ($stmt->execute()) {
            $message = "Game successfully added!";
        } else {
            $error = "Error adding game: " . $stmt->error;
        }
        $stmt->close();
    }
}

}

$genres = $conn->query("SELECT * FROM genres ORDER BY name ASC");
$platforms = $conn->query("SELECT * FROM platforms ORDER BY name ASC");
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Game - Admin - GameMatch AI</title>
    <!-- Google Fonts -->
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
            <a href="admin_dashboard.php" class="admin-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Dashboard Home
            </a>
            <a href="admin_add_game.php" class="admin-link active">
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
            <h2 class="page-title" style="margin-bottom: 2rem;">Add New Game</h2>
            
            <?php if(!empty($message)): ?>
                <div style="background: rgba(34, 197, 94, 0.2); color: #4ade80; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #4ade80;">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
            
            <?php if(!empty($error)): ?>
                <div style="background: rgba(239, 68, 68, 0.2); color: #f87171; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #f87171;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div class="admin-form-panel">
                <form method="POST" action="admin_add_game.php" enctype="multipart/form-data" class="auth-form" style="width: 100%; max-width: 100%;">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Game Name *</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Release Year *</label>
                        <input type="number" name="release_year" class="form-input" value="2026" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Platform *</label>
                        <select name="platform_id" class="form-select" required>
                            <option value="">Select Platform</option>
                            <?php while($p = $platforms->fetch_assoc()): ?>
                                <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Genre *</label>
                        <select name="genre_id" class="form-select" required>
                            <option value="">Select Genre</option>
                            <?php while($g = $genres->fetch_assoc()): ?>
                                <option value="<?php echo $g['id']; ?>"><?php echo htmlspecialchars($g['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Price ($)</label>
                        <input type="number" step="0.01" name="actual_price" class="form-input" value="59.99">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Size (GB)</label>
                        <input type="number" step="0.01" name="size_gb" class="form-input" value="50.00">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Developer Origin</label>
                        <input type="text" name="originated" class="form-input" placeholder="USA, Japan, etc.">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Cover Image</label>
                        <input type="file" name="image" class="form-input" accept="image/*" style="padding: 0.5rem 1rem;">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Average Playtime (hours)</label>
                        <input type="number" name="average_playgame_duration" class="form-input" value="30">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Average Player Age</label>
                        <input type="number" name="average_player_age" class="form-input" value="25">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Male/Female Ratio</label>
                        <input type="number" step="0.01" name="male_female_ratio" class="form-input" value="1.00">
                    </div>

                    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem; margin-top: 2rem; flex-direction: row;">
                        <input type="checkbox" name="purchases_on_game" style="width: 20px; height: 20px;">
                        <label class="form-label" style="margin-bottom: 0;">Has In-App Purchases?</label>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 1.5rem;">
                    <label class="form-label">Game Description</label>
                    <textarea name="game_description" class="form-input" rows="4"></textarea>
                </div>

                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn-primary" style="width: auto;">Add to Database</button>
                </div>
                </form>
            </div>
        </section>
    </main>

    <?php include_once '../php_includes/footer.php'; ?>

</body>
</html>
