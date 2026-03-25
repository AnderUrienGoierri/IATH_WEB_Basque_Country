<?php
require_once '../php_helpers/language.php';

require_once '../php_helpers/conexionDB.php';

$error = '';
$old_username = '';
$success_msg = '';
$recovered_password = '';

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $old_username = $username;

    if (isset($_POST['remember_password'])) {
        if (empty($username)) {
            $error = $txt['err_username_email_missing'];
        } else {
            $stmt = $conn->prepare("SELECT password_hash FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $username, $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows >= 1) {
                $user = $result->fetch_assoc();
                $success_msg = $txt['msg_password_is'];
                $recovered_password = $user['password_hash']; // Database now stores/contains plaintext
            } else {
                $error = $txt['err_username_email_missing'];
            }
            $stmt->close();
        }
    } else {
        if (empty($username) || empty($password)) {
            $error = $txt['err_required'];
        } else {
            $stmt = $conn->prepare("SELECT id, username, password_hash, role FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $username, $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows >= 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password_hash']) || $password === $user['password_hash']) {
                    // Success — set session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $stmt->close();
                    $conn->close();
                    
                    if ($_SESSION['role'] === 'admin') {
                        header("Location: ../php_admin/admin_dashboard.php");
                    } else {
                        header("Location: ../index.php");
                    }
                    exit();
                } else {
                    error_log("Login failed for user $username: Password mismatch. Input pass: $password, DB hash: " . $user['password_hash']);
                    $error = $txt['err_invalid'];
                }
            } else {
                error_log("Login failed: Username $username not found.");
                $error = $txt['err_invalid'];
            }
            $stmt->close();
        }
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
</head>
<body>

    <?php include_once '../php_includes/header.php'; ?>

    <!-- Login Form -->
    <main class="auth-page">
        <div class="auth-container">
            <h1 class="auth-title"><?php echo $txt['login_title']; ?></h1>
            <p class="auth-subtitle"><?php echo $txt['login_subtitle']; ?></p>

            <?php if (!empty($error)): ?>
                <div class="auth-message error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if (!empty($success_msg)): ?>
                <div class="auth-message success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                    <div style="margin-bottom: 8px; font-weight: 600;"><?php echo htmlspecialchars($success_msg); ?></div>
                    <div style="display: flex; gap: 8px;">
                        <input type="text" id="recovered-pwd" value="<?php echo htmlspecialchars($recovered_password); ?>" readonly style="flex: 1; padding: 8px 12px; border: 1px solid #c3e6cb; border-radius: 6px; background: #e2f3e5; color: #155724; font-family: monospace; font-size: 1rem;">
                        <button type="button" onclick="copyPassword()" style="padding: 0 16px; background: #155724; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; font-family: 'Poppins', sans-serif;">Copy</button>
                    </div>
                </div>
                <script>
                function copyPassword() {
                    var copyText = document.getElementById("recovered-pwd");
                    navigator.clipboard.writeText(copyText.value).then(function() {
                        var btn = copyText.nextElementSibling;
                        var originalText = btn.innerText;
                        btn.innerText = "Copied!";
                        setTimeout(function() { btn.innerText = originalText; }, 2000);
                    });
                }
                </script>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="">
                <div class="form-group">
                    <label class="form-label" for="username"><?php echo $txt['username']; ?></label>
                    <input class="form-input" type="text" id="username" name="username"
                           value="<?php echo htmlspecialchars($old_username); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="password"><?php echo $txt['password']; ?></label>
                    <input class="form-input" type="password" id="password" name="password">
                </div>

                <div class="auth-buttons-row">
                    <button type="submit" name="login_submit" class="auth-submit" style="flex: 1; margin: 0;"><?php echo $txt['login_btn']; ?></button>
                    <button type="submit" name="remember_password" class="auth-submit" style="flex: 1; margin: 0; background-color: var(--slate-600);"><?php echo $txt['remember']; ?></button>
                </div>
            </form>

            <p class="auth-footer">
                <?php echo $txt['no_account']; ?> <a href="register.php?lang=<?php echo $lang; ?>"><?php echo $txt['register_link']; ?></a>
            </p>
        </div>
    </main>

    <?php include_once '../php_includes/footer.php'; ?>

</body>
</html>


