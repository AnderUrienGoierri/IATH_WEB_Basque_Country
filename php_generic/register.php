<?php
require_once '../php_helpers/language.php';

require_once '../php_helpers/conexionDB.php';

$error = '';
$old = ['username' => '', 'email' => '', 'age' => '', 'gender' => '', 'territory' => ''];

// Process registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $age = intval($_POST['age'] ?? 0);
    $gender = $_POST['gender'] ?: null;
    $territory = trim($_POST['territory'] ?? '') ?: null;

    // Preserve old values
    $old = [
        'username' => $username, 
        'email' => $email, 
        'age' => $age, 
        'gender' => $gender,
        'territory' => $territory
    ];

    // Validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm) || $age <= 0) {
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
            $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, age, gender, territory) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssisss", $username, $email, $hash, $age, $gender, $territory);

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
    <link rel="icon" type="image/png" href="/IATH_WEB_Basque_Country/img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Poppins:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/auth.css">
    <style>
        /* Custom Country Dropdown Styles */
        .country-select-container {
            position: relative;
            width: 100%;
        }
        .country-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(139, 92, 246, 0.3);
            border-radius: 8px;
            margin-top: 5px;
            max-height: 250px;
            overflow-y: auto;
            z-index: 1000;
            display: none;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(12px);
        }
        .country-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 15px;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--slate-300);
        }
        .country-option:hover {
            background: rgba(139, 92, 246, 0.2);
            color: white;
        }
        .country-flag {
            width: 24px;
            height: 16px;
            object-fit: cover;
            border-radius: 2px;
            box-shadow: 0 0 4px rgba(0,0,0,0.3);
        }
        .country-name {
            font-size: 0.95rem;
        }
        .country-search-input {
            padding-right: 40px !important;
        }
        .dropdown-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--slate-500);
            pointer-events: none;
            transition: transform 0.3s;
        }
        .country-select-container.active .dropdown-icon {
            transform: translateY(-50%) rotate(180deg);
        }
    </style>
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
                        <label class="form-label" for="territory"><?php echo $txt['territory']; ?></label>
                        <div class="country-select-container" id="country-container">
                            <input class="form-input country-search-input" type="text" id="territory-search" 
                                   placeholder="<?php echo $txt['territory_select']; ?>"
                                   value="<?php echo htmlspecialchars($old['territory'] ?? ''); ?>" autocomplete="off">
                            <input type="hidden" name="territory" id="territory-hidden" value="<?php echo htmlspecialchars($old['territory'] ?? ''); ?>">
                            <span class="dropdown-icon">▼</span>
                            <div class="country-dropdown" id="country-list">
                                <!-- Options will be populated by JS -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="gender"><?php echo $txt['gender']; ?></label>
                        <select class="form-select" id="gender" name="gender">
                            <option value=""><?php echo $txt['gender_select']; ?></option>
                            <option value="male" <?php echo ($old['gender'] ?? '') === 'male' ? 'selected' : ''; ?>><?php echo $txt['gender_male']; ?></option>
                            <option value="female" <?php echo ($old['gender'] ?? '') === 'female' ? 'selected' : ''; ?>><?php echo $txt['gender_female']; ?></option>
                            <option value="non-binary" <?php echo ($old['gender'] ?? '') === 'non-binary' ? 'selected' : ''; ?>><?php echo $txt['gender_nb']; ?></option>
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

    <script>
        const countries = [
            { name: "<?php echo $txt['country_eu']; ?>", code: "EU", flag: "../img/flags/eu.png" },
            { name: "<?php echo $txt['country_nl']; ?>", code: "NL", flag: "../img/flags/nl.png" },
            { name: "<?php echo $txt['country_es']; ?>", code: "ES", flag: "../img/flags/es.png" },
            { name: "<?php echo $txt['country_fr']; ?>", code: "FR", flag: "../img/flags/fr.png" },
            { name: "<?php echo $txt['country_cn']; ?>", code: "CN", flag: "../img/flags/cn.png" },
            { name: "<?php echo $txt['country_gb']; ?>", code: "GB", flag: "../img/flags/gb.png" },
            { name: "<?php echo $txt['country_de']; ?>", code: "DE", flag: "../img/flags/de.png" },
            { name: "<?php echo $txt['country_it']; ?>", code: "IT", flag: "../img/flags/it.png" },
            { name: "<?php echo $txt['country_pt']; ?>", code: "PT", flag: "../img/flags/pt.png" },
            { name: "<?php echo $txt['country_jp']; ?>", code: "JP", flag: "../img/flags/jp.png" },
            { name: "<?php echo $txt['country_kr']; ?>", code: "KR", flag: "../img/flags/kr.png" },
            { name: "<?php echo $txt['country_ca']; ?>", code: "CA", flag: "../img/flags/ca.png" },
            { name: "<?php echo $txt['country_au']; ?>", code: "AU", flag: "../img/flags/au.png" },
            { name: "<?php echo $txt['country_br']; ?>", code: "BR", flag: "../img/flags/br.png" },
            { name: "<?php echo $txt['country_mx']; ?>", code: "MX", flag: "../img/flags/mx.png" },
            { name: "<?php echo $txt['country_us']; ?>", code: "US", flag: "../img/flags/us.png" }
        ];

        const searchInput = document.getElementById('territory-search');
        const hiddenInput = document.getElementById('territory-hidden');
        const countryList = document.getElementById('country-list');
        const container = document.getElementById('country-container');

        function populateList(filter = '') {
            countryList.innerHTML = '';
            const filtered = countries.filter(c => 
                c.name.toLowerCase().includes(filter.toLowerCase())
            );

            if (filtered.length === 0) {
                countryList.innerHTML = '<div class="country-option">No results found</div>';
                return;
            }

            filtered.forEach(country => {
                const div = document.createElement('div');
                div.className = 'country-option';
                div.innerHTML = `
                    <img src="${country.flag}" alt="${country.name}" class="country-flag">
                    <span class="country-name">${country.name}</span>
                `;
                div.onclick = () => selectCountry(country);
                countryList.appendChild(div);
            });
        }

        function selectCountry(country) {
            searchInput.value = country.name;
            hiddenInput.value = country.name;
            countryList.style.display = 'none';
            container.classList.remove('active');
        }

        searchInput.onfocus = () => {
            populateList(searchInput.value);
            countryList.style.display = 'block';
            container.classList.add('active');
        };

        searchInput.oninput = (e) => {
            populateList(e.target.value);
            hiddenInput.value = e.target.value; // Fallback if user types manually
        };

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!container.contains(e.target)) {
                countryList.style.display = 'none';
                container.classList.remove('active');
            }
        });

        // Initialize
        populateList();
    </script>

</body>
</html>


