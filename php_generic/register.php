<?php
require_once '../php_helpers/language.php';

require_once '../php_helpers/conexionDB.php';

$error = '';
$old = ['username' => '', 'email' => '', 'age' => '', 'gender' => ''];

// Process registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $age = intval($_POST['age'] ?? 0);
    $gender = $_POST['gender'] ?? '';

    // Preserve old values
    $old = ['username' => $username, 'email' => $email, 'age' => $age, 'gender' => $gender];

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm) || $age <= 0 || empty($gender)) {
        $error = $txt['err_required'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = $txt['err_email'];
    } elseif (strlen($password) < 6) {
        $error = $txt['err_password_length'];
    } elseif ($password !== $confirm) {
        $error = $txt['err_password_match'];
    } else {
        // Check username uniqueness
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $error = $txt['err_username_taken'];
        }
        $stmt->close();

        // Check email uniqueness
        if (empty($error)) {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            if ($stmt->get_result()->num_rows > 0) {
                $error = $txt['err_email_taken'];
            }
            $stmt->close();
        }

        // Insert user
        if (empty($error)) {
            $hash = $password; // Use plaintext password as requested for the remember feature
            $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, age, gender) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $username, $email, $hash, $age, $gender);

            if ($stmt->execute()) {
                // Auto-login
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                $stmt->close();
                $conn->close();
                header("Location: ../index.php");
                exit();
            } else {
                $error = $txt['err_generic'];
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>

    <?php include_once '../php_includes/header.php'; ?>

    <!-- Register Form -->
    <main class="auth-page">
        <div class="auth-container">
            <h1 class="auth-title"><?php echo $txt['register_title']; ?></h1>
            <p class="auth-subtitle"><?php echo $txt['register_subtitle']; ?></p>

            <?php if (!empty($error)): ?>
                <div class="auth-message error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form class="auth-form" method="POST" action="">
                <div class="form-group">
                    <label class="form-label" for="username"><?php echo $txt['username']; ?></label>
                    <input class="form-input" type="text" id="username" name="username" 
                           value="<?php echo htmlspecialchars($old['username']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email"><?php echo $txt['email']; ?></label>
                    <input class="form-input" type="email" id="email" name="email"
                           value="<?php echo htmlspecialchars($old['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password"><?php echo $txt['password']; ?></label>
                    <input class="form-input" type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="confirm_password"><?php echo $txt['confirm_password']; ?></label>
                    <input class="form-input" type="password" id="confirm_password" name="confirm_password" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="age"><?php echo $txt['age']; ?></label>
                        <input class="form-input" type="number" id="age" name="age" min="1" max="120"
                               value="<?php echo htmlspecialchars($old['age']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="gender"><?php echo $txt['gender']; ?></label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value=""><?php echo $txt['gender_select']; ?></option>
                            <option value="male" <?php echo $old['gender'] === 'male' ? 'selected' : ''; ?>><?php echo $txt['gender_male']; ?></option>
                            <option value="female" <?php echo $old['gender'] === 'female' ? 'selected' : ''; ?>><?php echo $txt['gender_female']; ?></option>
                            <option value="non-binary" <?php echo $old['gender'] === 'non-binary' ? 'selected' : ''; ?>><?php echo $txt['gender_nb']; ?></option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="auth-submit"><?php echo $txt['register_btn']; ?></button>
            </form>

            <p class="auth-footer">
                <?php echo $txt['has_account']; ?> <a href="login.php?lang=<?php echo $lang; ?>"><?php echo $txt['login_link']; ?></a>
            </p>
        </div>
    </main>

    <?php include_once '../php_includes/footer.php'; ?>

</body>
</html>


