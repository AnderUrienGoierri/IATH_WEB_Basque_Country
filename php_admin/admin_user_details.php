<?php
require_once '../php_helpers/language.php';
require_once '../php_helpers/conexionDB.php';

// Security check
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$user_id = $_GET['id'] ?? 0;
if (!$user_id) {
    die("Invalid user ID.");
}

// Fetch user info
$stmt = $conn->prepare("SELECT username, email, age, gender, role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userProfile = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$userProfile) {
    die("User not found.");
}

// Fetch user's quiz sessions and top recommendations
$sessionsQ = "
    SELECT s.id as session_id, s.device_preference, s.available_time_preference, s.mood_preference, s.session_date,
           r.match_score, r.rank_position, r.is_selected,
           v.name as game_name, v.image
    FROM game_match_sessions s
    LEFT JOIN recommendations r ON s.id = r.session_id
    LEFT JOIN videoGames v ON r.game_id = v.id
    WHERE s.user_id = ? AND (r.rank_position <= 3 OR r.rank_position IS NULL)
    ORDER BY s.session_date DESC, r.rank_position ASC
";
$stmt = $conn->prepare($sessionsQ);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$sessionRes = $stmt->get_result();
$sessions = [];
while ($row = $sessionRes->fetch_assoc()) {
    $sid = $row['session_id'];
    if (!isset($sessions[$sid])) {
        $sessions[$sid] = [
            'date' => $row['session_date'],
            'device' => $row['device_preference'],
            'time' => $row['available_time_preference'],
            'mood' => $row['mood_preference'],
            'recs' => []
        ];
    }
    if ($row['game_name']) {
        $sessions[$sid]['recs'][] = [
            'name' => $row['game_name'],
            'score' => $row['match_score'],
            'rank' => $row['rank_position'],
            'selected' => $row['is_selected'],
            'image' => $row['image']
        ];
    }
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - Admin - GameMatch AI</title>
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
            <a href="admin_dashboard.php" class="admin-link">
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
            <a href="admin_users.php" class="admin-link active">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Manage Users
            </a>
        </aside>

        <!-- Content -->
        <section class="admin-content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2 class="page-title" style="margin-bottom: 0;">User Details</h2>
                <a href="admin_users.php" class="btn-secondary" style="width: auto; padding: 0.5rem 1rem;">&larr; Back</a>
            </div>
            
            <div class="profile-header">
                <div>
                    <h3 style="font-size: 1.8rem; color: white; margin-bottom: 0.25rem;"><?php echo htmlspecialchars($userProfile['username']); ?></h3>
                    <p style="color: var(--violet-400); font-weight: 600; margin-bottom: 1rem;"><?php echo htmlspecialchars($userProfile['email']); ?></p>
                    <div style="display: flex; gap: 1.5rem; color: var(--slate-300);">
                        <span><strong>Age:</strong> <?php echo $userProfile['age']; ?></span>
                        <span><strong>Gender:</strong> <?php echo ucfirst($userProfile['gender'] ?? 'N/A'); ?></span>
                        <span><strong>Role:</strong> <?php echo strtoupper($userProfile['role']); ?></span>
                        <span><strong>Joined:</strong> <?php echo date('M j, Y', strtotime($userProfile['created_at'])); ?></span>
                    </div>
                </div>
            </div>

            <h3 style="font-size: 1.4rem; color: white; margin-bottom: 1.5rem;">Quiz & Recommendation History</h3>
            
            <?php if(empty($sessions)): ?>
                <p style="color: var(--slate-400);">This user has not taken the quiz yet.</p>
            <?php else: ?>
                <?php foreach($sessions as $sid => $s): ?>
                    <div class="session-card">
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.75rem; margin-bottom: 1rem;">
                            <h4 style="color: white; font-size: 1.1rem;">Session #<?php echo $sid; ?></h4>
                            <span style="color: var(--slate-400); font-size: 0.9rem;"><?php echo date('M j, Y g:i A', strtotime($s['date'])); ?></span>
                        </div>
                        
                        <div class="session-meta">
                            <span style="background: rgba(255,255,255,0.1); padding: 0.25rem 0.75rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 5H9a7 7 0 00-7 7v5h2v-1a1 1 0 011-1h2a1 1 0 011 1v1h2V5zm0 0h6a7 7 0 017 7v5h-2v-1a1 1 0 00-1-1h-2a1 1 0 00-1 1v1h-2V5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 10h2m-1-1v2m11-2l.01.01m2.99.99l.01.01" />
                                </svg>
                                <?php echo htmlspecialchars($s['device'] ?? 'Any'); ?>
                            </span>
                            <span style="background: rgba(255,255,255,0.1); padding: 0.25rem 0.75rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <?php echo htmlspecialchars($s['time'] ?? '0'); ?> min
                            </span>
                            <span style="background: rgba(255,255,255,0.1); padding: 0.25rem 0.75rem; border-radius: 20px; display: inline-flex; align-items: center; gap: 0.4rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <?php echo htmlspecialchars($s['mood'] ?? 'Action'); ?>
                            </span>
                        </div>
                        
                        <h5 style="color: var(--slate-300); margin-top: 1.5rem; font-size: 0.95rem;">Top 3 AI Recommendations:</h5>
                        <?php if(empty($s['recs'])): ?>
                            <p style="color: var(--slate-500); font-size: 0.9rem;">No recommendations generated for this session.</p>
                        <?php else: ?>
                            <div class="rec-grid">
                                <?php foreach($s['recs'] as $rec): ?>
                                    <div class="rec-item <?php echo $rec['selected'] ? 'selected' : ''; ?>">
                                        <img src="<?php echo htmlspecialchars(strpos($rec['image'], 'http') === 0 ? $rec['image'] : '../' . $rec['image']); ?>" class="rec-img" alt="Game cover">
                                        <div style="padding: 0.75rem;">
                                            <p style="color: white; font-size: 0.85rem; font-weight: 600; line-height: 1.3; margin-bottom: 0.25rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo htmlspecialchars($rec['name']); ?></p>
                                            <p style="color: var(--violet-400); font-size: 0.75rem; font-weight: bold;"><?php echo round($rec['score'], 0); ?>% Match</p>
                                            <?php if($rec['selected']): ?>
                                                <span style="display: block; margin-top: 0.5rem; background: var(--violet-600); color: white; font-size: 0.65rem; padding: 2px; border-radius: 3px;">CLICKED</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </section>
    </main>

    <?php include_once '../php_includes/footer.php'; ?>

</body>
</html>
