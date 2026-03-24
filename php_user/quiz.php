<?php
require_once '../php_helpers/language.php';

require_once '../php_helpers/conexionDB.php';

// Security: Admins cannot take the quiz
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: ../php_admin/admin_dashboard.php");
    exit();
}

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
    <link rel="icon" type="image/png" href="/IATH_WEB_Basque_Country/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/auth.css">
    <link rel="stylesheet" href="../css/quiz.css">
</head>
<body>

    <?php include_once '../php_includes/header.php'; ?>

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
                        <img src="../svg/pc.svg" class="option-icon-svg" alt="PC">
                        <span class="option-label"><?php echo $txt['device_pc']; ?></span>
                    </div>
                    <div class="option-card" data-value="PlayStation">
                        <img src="../svg/playstation.svg" class="option-icon-svg" alt="PlayStation">
                        <span class="option-label"><?php echo $txt['device_ps']; ?></span>
                    </div>
                    <div class="option-card" data-value="Xbox">
                        <img src="../svg/xbox.svg" class="option-icon-svg" alt="Xbox">
                        <span class="option-label"><?php echo $txt['device_xbox']; ?></span>
                    </div>
                    <div class="option-card" data-value="Nintendo Switch">
                        <img src="../svg/switch.svg" class="option-icon-svg" alt="Nintendo Switch">
                        <span class="option-label"><?php echo $txt['device_switch']; ?></span>
                    </div>
                    <div class="option-card" data-value="Mobile">
                        <img src="../svg/mobile.svg" class="option-icon-svg" alt="Mobile">
                        <span class="option-label"><?php echo $txt['device_mobile']; ?></span>
                    </div>
                    <div class="option-card" data-value="Multi-platform">
                        <img src="../svg/multi.svg" class="option-icon-svg" alt="Any platform">
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
                        <img src="../svg/short.svg" class="option-icon-svg" alt="Quick game">
                        <span class="option-label"><?php echo $txt['time_short']; ?></span>
                        <span class="option-desc"><?php echo $txt['time_short_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="60">
                        <img src="../svg/medium.svg" class="option-icon-svg" alt="Normal session">
                        <span class="option-label"><?php echo $txt['time_medium']; ?></span>
                        <span class="option-desc"><?php echo $txt['time_medium_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="120">
                        <img src="../svg/long.svg" class="option-icon-svg" alt="Long session">
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
                        <img src="../svg/action.svg" class="option-icon-svg" alt="Action">
                        <span class="option-label"><?php echo $txt['mood_action']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_action_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Adventure">
                        <img src="../svg/adventure.svg" class="option-icon-svg" alt="Adventure">
                        <span class="option-label"><?php echo $txt['mood_adventure']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_adventure_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Strategy">
                        <img src="../svg/strategy.svg" class="option-icon-svg" alt="Strategy">
                        <span class="option-label"><?php echo $txt['mood_strategy']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_strategy_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Relaxing">
                        <img src="../svg/relax.svg" class="option-icon-svg" alt="Relaxing">
                        <span class="option-label"><?php echo $txt['mood_relax']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_relax_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Horror">
                        <img src="../svg/horror.svg" class="option-icon-svg" alt="Horror">
                        <span class="option-label"><?php echo $txt['mood_horror']; ?></span>
                        <span class="option-desc"><?php echo $txt['mood_horror_desc']; ?></span>
                    </div>
                    <div class="option-card" data-value="Sports">
                        <img src="../svg/sport.svg" class="option-icon-svg" alt="Sports">
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
                        data-submit-text="<?php echo $txt['quiz_submit']; ?>">
                    <?php echo $txt['next']; ?>
                </button>
            </div>

        </div>

        <!-- Loading State -->
        <div id="quiz-loading" class="quiz-loading">
            <div class="loading-spinner"></div>
            <p class="loading-text"><?php echo $txt['analyzing_prefs']; ?></p>
        </div>
    </main>

    <?php include_once '../php_includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../js/header.js"></script>
    <script src="../js/quiz.js"></script>
</body>
</html>


