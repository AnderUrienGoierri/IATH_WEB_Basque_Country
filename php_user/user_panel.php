<?php
session_start();
if (!isset($_SESSION['user_id']) || (isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    header("Location: ../php_generic/login.php");
    exit;
}
require_once '../php_helpers/language.php';
require_once '../php_helpers/conexionDB.php';

$userId = $_SESSION['user_id'];

// Get user data
$stmt = $conn->prepare("SELECT username, email, age, gender, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Get user ratings
$ratingsQuery = $conn->prepare("
    SELECT ugi.rating, ugi.interaction_date, vg.name, vg.image, vg.id as game_id
    FROM user_game_interactions ugi
    JOIN videoGames vg ON ugi.game_id = vg.id
    WHERE ugi.user_id = ? AND ugi.interaction_type = 'liked' AND ugi.rating IS NOT NULL
    ORDER BY ugi.interaction_date DESC
");
$ratingsQuery->bind_param("i", $userId);
$ratingsQuery->execute();
$ratings = $ratingsQuery->get_result();
$ratingsQuery->close();

// Get quiz sessions with recommendations
$sessionsQuery = $conn->prepare("
    SELECT gms.id, gms.device_preference, gms.mood_preference, gms.available_time_preference, gms.session_date,
           r.game_id, r.match_score, r.rank_position, vg.name AS game_name, vg.image AS game_image
    FROM game_match_sessions gms
    JOIN recommendations r ON r.session_id = gms.id
    JOIN videoGames vg ON r.game_id = vg.id
    WHERE gms.user_id = ?
    ORDER BY gms.session_date DESC, r.rank_position ASC
    LIMIT 30
");
$sessionsQuery->bind_param("i", $userId);
$sessionsQuery->execute();
$sessionsResult = $sessionsQuery->get_result();

$sessions = [];
while ($row = $sessionsResult->fetch_assoc()) {
    $sid = $row['id'];
    if (!isset($sessions[$sid])) {
        $sessions[$sid] = [
            'id' => $sid,
            'device' => $row['device_preference'],
            'mood' => $row['mood_preference'],
            'time' => $row['available_time_preference'],
            'date' => $row['session_date'],
            'games' => []
        ];
    }
    $sessions[$sid]['games'][] = [
        'id' => $row['game_id'],
        'name' => $row['game_name'],
        'image' => $row['game_image'],
        'score' => $row['match_score'],
        'rank' => $row['rank_position']
    ];
}
$sessionsQuery->close();

// Update last_active
$conn->query("UPDATE users SET last_active = NOW() WHERE id = $userId");
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel - GameMatch AI</title>
    <link rel="icon" type="image/png" href="/IATH_WEB_Basque_Country/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/user_panel.css">
</head>
<body>

    <?php include_once '../php_includes/header.php'; ?>

    <main class="container panel-layout">
        <!-- Sidebar -->
        <aside class="panel-sidebar">
            <div class="panel-avatar">
                <div class="avatar-circle">
                    <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                </div>
                <h3 class="avatar-name"><?php echo htmlspecialchars($user['username']); ?></h3>
                <span class="avatar-role">Player</span>
            </div>
            <nav class="panel-nav">
                <a href="#profile" class="panel-link active" data-tab="profile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    My Profile
                </a>
                <a href="#ratings" class="panel-link" data-tab="ratings">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    My Ratings
                </a>
                <a href="#recommendations" class="panel-link" data-tab="recommendations">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    Recommendations
                </a>
                <a href="#friends" class="panel-link" data-tab="friends">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Friends & Chat
                </a>
            </nav>
        </aside>

        <!-- Content Area -->
        <section class="panel-content">

            <!-- TAB: Profile -->
            <div class="tab-pane active" id="tab-profile">
                <h2 class="section-title">My Profile</h2>
                <form id="profile-form" class="profile-form">
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="inp-username" value="<?php echo htmlspecialchars($user['username']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" id="inp-email" value="<?php echo htmlspecialchars($user['email']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" id="inp-age" value="<?php echo (int)$user['age']; ?>" min="1" max="120">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" id="inp-gender">
                                <option value="male" <?php echo $user['gender'] === 'male' ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo $user['gender'] === 'female' ? 'selected' : ''; ?>>Female</option>
                                <option value="non-binary" <?php echo $user['gender'] === 'non-binary' ? 'selected' : ''; ?>>Non-binary</option>
                            </select>
                        </div>
                    </div>
                    <hr class="form-divider">
                    <h3 class="subsection-title">Change Password</h3>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" id="inp-current-pw" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" id="inp-new-pw" placeholder="••••••••">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-save">Save Changes</button>
                        <span id="profile-msg" class="form-msg"></span>
                    </div>
                </form>
                <div class="profile-meta">
                    <span>Member since: <?php echo date('d M Y', strtotime($user['created_at'])); ?></span>
                </div>
            </div>

            <!-- TAB: Ratings -->
            <div class="tab-pane" id="tab-ratings">
                <h2 class="section-title">My Ratings</h2>
                <?php if ($ratings->num_rows > 0): ?>
                <div class="ratings-grid">
                    <?php while ($r = $ratings->fetch_assoc()): 
                        $img = $r['image'];
                        if ($img && !str_starts_with($img, 'http')) {
                            $img = '../' . $img;
                        }
                    ?>
                    <a href="../php_generic/videogame_details.php?id=<?php echo $r['game_id']; ?>" class="rating-card">
                        <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($r['name']); ?>" class="rating-img" loading="lazy" decoding="async">
                        <div class="rating-info">
                            <h4><?php echo htmlspecialchars($r['name']); ?></h4>
                            <div class="stars-display">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star <?php echo $i <= $r['rating'] ? 'filled' : ''; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <small><?php echo date('d/m/Y', strtotime($r['interaction_date'])); ?></small>
                        </div>
                    </a>
                    <?php endwhile; ?>
                </div>
                <?php else: ?>
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    <p>You haven't rated any games yet.</p>
                    <a href="../php_generic/videogames.php" class="btn-save">Browse Games</a>
                </div>
                <?php endif; ?>
            </div>

            <!-- TAB: Recommendations -->
            <div class="tab-pane" id="tab-recommendations">
                <h2 class="section-title">My Recommendations</h2>
                <?php if (!empty($sessions)): ?>
                <?php foreach ($sessions as $s): ?>
                <div class="session-card-user">
                    <div class="session-header">
                        <span class="session-date"><?php echo date('d M Y, H:i', strtotime($s['date'])); ?></span>
                        <div class="session-tags">
                            <?php if ($s['device']): ?>
                                <span class="tag">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.5 8.5l2 2m-2-2l-2 2m2-2l2-2m-2 2L13.5 6.5m-7 5h3m-1.5-1.5v3M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <?php echo htmlspecialchars($s['device']); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ($s['mood']): ?>
                                <span class="tag">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9 9h.01M15 9h.01" /></svg>
                                    <?php echo htmlspecialchars($s['mood']); ?>
                                </span>
                            <?php endif; ?>
                            <?php if ($s['time']): ?>
                                <span class="tag">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <?php echo $s['time']; ?> min
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="rec-grid-user">
                        <?php foreach ($s['games'] as $g): 
                            $gImg = $g['image'];
                            if ($gImg && !str_starts_with($gImg, 'http')) {
                                $gImg = '../' . $gImg;
                            }
                        ?>
                        <a href="../php_generic/videogame_details.php?id=<?php echo $g['id']; ?>" class="rec-card">
                            <div class="rec-rank">#<?php echo $g['rank']; ?></div>
                            <img src="<?php echo htmlspecialchars($gImg); ?>" alt="<?php echo htmlspecialchars($g['name']); ?>" class="rec-img-user" loading="lazy" decoding="async">
                            <div class="rec-name"><?php echo htmlspecialchars($g['name']); ?></div>
                            <div class="rec-score"><?php echo number_format($g['score'], 0); ?>% match</div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    <p>No quiz sessions yet.</p>
                    <a href="quiz.php" class="btn-save">Take the Quiz</a>
                </div>
                <?php endif; ?>
            </div>

            <!-- TAB: Friends & Chat -->
            <div class="tab-pane" id="tab-friends">
                <h2 class="section-title">Friends & Chat</h2>
                <div class="chat-layout">
                    <div class="chat-users-panel">
                        <h3 class="chat-panel-title">
                            <span class="online-dot"></span> Online Users
                        </h3>
                        <div id="online-users-list" class="online-users-list">
                            <div class="loading-users">Loading...</div>
                        </div>
                    </div>
                    <div class="chat-window" id="chat-window">
                        <div class="chat-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            <p>Select a user to start chatting</p>
                        </div>
                        <div class="chat-active" id="chat-active" style="display:none;">
                            <div class="chat-header" id="chat-header">
                                <span class="chat-with"></span>
                                <button class="chat-close" id="chat-close-btn">&times;</button>
                            </div>
                            <div class="chat-messages" id="chat-messages"></div>
                            <form class="chat-input-form" id="chat-form">
                                <input type="text" id="chat-input" placeholder="Type a message..." autocomplete="off" maxlength="1000">
                                <button type="submit" class="chat-send-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <?php include_once '../php_includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/header.js"></script>
    <script>const CURRENT_USER_ID = <?php echo $userId; ?>;</script>
    <script src="../js/user_panel.js"></script>
</body>
</html>
