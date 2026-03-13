<?php
session_start();
// Language Logic
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// If already logged in, redirect
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Translations
$t = [
    'en' => [
        'title' => 'Register - GameMatch AI',
        'page_title' => 'Create Account',
        'page_subtitle' => 'Join GameMatch AI and discover your perfect game.',
        'username' => 'Username',
        'email' => 'Email',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'age' => 'Age',
        'gender' => 'Gender',
        'gender_select' => 'Select...',
        'gender_male' => 'Male',
        'gender_female' => 'Female',
        'gender_nb' => 'Non-binary',
        'submit' => 'Create Account',
        'has_account' => 'Already have an account?',
        'login_link' => 'Log in',
        'home' => 'Home',
        'videogames' => 'Videogames',
        'err_required' => 'All fields are required.',
        'err_password_match' => 'Passwords do not match.',
        'err_password_length' => 'Password must be at least 6 characters.',
        'err_email' => 'Invalid email format.',
        'err_username_taken' => 'Username is already taken.',
        'err_email_taken' => 'Email is already registered.',
        'err_generic' => 'An error occurred. Please try again.'
    ],
    'es' => [
        'title' => 'Registro - GameMatch AI',
        'page_title' => 'Crear Cuenta',
        'page_subtitle' => 'Únete a GameMatch AI y descubre tu juego perfecto.',
        'username' => 'Nombre de usuario',
        'email' => 'Correo electrónico',
        'password' => 'Contraseña',
        'confirm_password' => 'Confirmar Contraseña',
        'age' => 'Edad',
        'gender' => 'Género',
        'gender_select' => 'Seleccionar...',
        'gender_male' => 'Masculino',
        'gender_female' => 'Femenino',
        'gender_nb' => 'No binario',
        'submit' => 'Crear Cuenta',
        'has_account' => '¿Ya tienes cuenta?',
        'login_link' => 'Inicia sesión',
        'home' => 'Inicio',
        'videogames' => 'Videojuegos',
        'err_required' => 'Todos los campos son obligatorios.',
        'err_password_match' => 'Las contraseñas no coinciden.',
        'err_password_length' => 'La contraseña debe tener al menos 6 caracteres.',
        'err_email' => 'Formato de correo no válido.',
        'err_username_taken' => 'El nombre de usuario ya está en uso.',
        'err_email_taken' => 'El correo electrónico ya está registrado.',
        'err_generic' => 'Ha ocurrido un error. Inténtalo de nuevo.'
    ]
];
$txt = $t[$lang];

require_once 'conexionDB.php';

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
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, age, gender) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssis", $username, $email, $hash, $age, $gender);

            if ($stmt->execute()) {
                // Auto-login
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                $stmt->close();
                $conn->close();
                header("Location: index.php");
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

    <!-- Header -->
    <header class="main-header">
        <div class="container header-inner">
            <a href="index.php" class="logo-group">
                <img src="../img/logo.png" alt="GameMatch AI Logo" class="logo-img">
            </a>
            <nav class="main-nav">
                <a href="index.php" class="nav-link"><?php echo $txt['home']; ?></a>
                <a href="videogames.php" class="nav-link"><?php echo $txt['videogames']; ?></a>
                <div class="lang-switcher">
                    <a href="?lang=en" class="lang-link <?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
                    <span style="color: var(--slate-700)">|</span>
                    <a href="?lang=es" class="lang-link <?php echo $lang === 'es' ? 'active' : ''; ?>">ES</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Register Form -->
    <main class="auth-page">
        <div class="auth-container">
            <h1 class="auth-title"><?php echo $txt['page_title']; ?></h1>
            <p class="auth-subtitle"><?php echo $txt['page_subtitle']; ?></p>

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

                <button type="submit" class="auth-submit"><?php echo $txt['submit']; ?></button>
            </form>

            <p class="auth-footer">
                <?php echo $txt['has_account']; ?> <a href="login.php?lang=<?php echo $lang; ?>"><?php echo $txt['login_link']; ?></a>
            </p>
        </div>
    </main>

</body>
</html>
