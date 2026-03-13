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
        'title' => 'Login - GameMatch AI',
        'page_title' => 'Welcome Back',
        'page_subtitle' => 'Log in to access your profile and recommendations.',
        'username' => 'Username',
        'password' => 'Password',
        'submit' => 'Log In',
        'no_account' => "Don't have an account?",
        'register_link' => 'Sign up',
        'home' => 'Home',
        'videogames' => 'Videogames',
        'err_required' => 'Username and password are required.',
        'err_invalid' => 'Invalid username or password.'
    ],
    'es' => [
        'title' => 'Login - GameMatch AI',
        'page_title' => 'Bienvenido de nuevo',
        'page_subtitle' => 'Inicia sesión para acceder a tu perfil y recomendaciones.',
        'username' => 'Nombre de usuario',
        'password' => 'Contraseña',
        'submit' => 'Iniciar Sesión',
        'no_account' => '¿No tienes cuenta?',
        'register_link' => 'Regístrate',
        'home' => 'Inicio',
        'videogames' => 'Videojuegos',
        'err_required' => 'Usuario y contraseña son obligatorios.',
        'err_invalid' => 'Usuario o contraseña incorrectos.'
    ]
];
$txt = $t[$lang];

require_once 'conexionDB.php';

$error = '';
$old_username = '';

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $old_username = $username;

    if (empty($username) || empty($password)) {
        $error = $txt['err_required'];
    } else {
        $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                // Success — set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $stmt->close();
                $conn->close();
                header("Location: index.php");
                exit();
            } else {
                $error = $txt['err_invalid'];
            }
        } else {
            $error = $txt['err_invalid'];
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

    <!-- Login Form -->
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
                           value="<?php echo htmlspecialchars($old_username); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password"><?php echo $txt['password']; ?></label>
                    <input class="form-input" type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="auth-submit"><?php echo $txt['submit']; ?></button>
            </form>

            <p class="auth-footer">
                <?php echo $txt['no_account']; ?> <a href="register.php?lang=<?php echo $lang; ?>"><?php echo $txt['register_link']; ?></a>
            </p>
        </div>
    </main>

</body>
</html>
