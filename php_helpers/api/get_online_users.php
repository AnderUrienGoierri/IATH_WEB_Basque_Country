<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

require_once '../conexionDB.php';

$userId = $_SESSION['user_id'];

// Get users active in the last 2 minutes, exclude current user and admins
$stmt = $conn->prepare("
    SELECT id, username, gender 
    FROM users 
    WHERE last_active >= NOW() - INTERVAL 2 MINUTE 
      AND id != ? 
      AND role = 'user'
    ORDER BY username ASC
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$stmt->close();

echo json_encode(['success' => true, 'users' => $users]);
?>
