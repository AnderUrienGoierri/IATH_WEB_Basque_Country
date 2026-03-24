<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid method']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

require_once '../conexionDB.php';

$data = json_decode(file_get_contents('php://input'), true);
$userId = $_SESSION['user_id'];

$updates = [];
$types = '';
$values = [];

// Username
if (!empty($data['username'])) {
    $updates[] = "username = ?";
    $types .= 's';
    $values[] = $data['username'];
}

// Email
if (!empty($data['email'])) {
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'error' => 'Invalid email format']);
        exit;
    }
    $updates[] = "email = ?";
    $types .= 's';
    $values[] = $data['email'];
}

// Age
if (isset($data['age']) && is_numeric($data['age'])) {
    $updates[] = "age = ?";
    $types .= 'i';
    $values[] = (int)$data['age'];
}

// Gender
if (!empty($data['gender'])) {
    $allowed = ['male', 'female', 'non-binary'];
    if (in_array($data['gender'], $allowed)) {
        $updates[] = "gender = ?";
        $types .= 's';
        $values[] = $data['gender'];
    }
}

// Password
if (!empty($data['new_password'])) {
    if (strlen($data['new_password']) < 6) {
        echo json_encode(['success' => false, 'error' => 'Password must be at least 6 characters']);
        exit;
    }
    // Verify current password
    $stmt = $conn->prepare("SELECT password_hash FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (!password_verify($data['current_password'] ?? '', $user['password_hash'])) {
        echo json_encode(['success' => false, 'error' => 'Current password is incorrect']);
        exit;
    }

    $updates[] = "password_hash = ?";
    $types .= 's';
    $values[] = password_hash($data['new_password'], PASSWORD_DEFAULT);
}

if (empty($updates)) {
    echo json_encode(['success' => false, 'error' => 'No changes provided']);
    exit;
}

$sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
$types .= 'i';
$values[] = $userId;

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$values);

if ($stmt->execute()) {
    // Update session username if changed
    if (!empty($data['username'])) {
        $_SESSION['username'] = $data['username'];
    }
    echo json_encode(['success' => true]);
} else {
    $error = $stmt->error;
    if (strpos($error, 'Duplicate') !== false) {
        echo json_encode(['success' => false, 'error' => 'Username or email already taken']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Update failed']);
    }
}
$stmt->close();
?>
