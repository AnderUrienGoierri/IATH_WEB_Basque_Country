<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

require_once '../conexionDB.php';
$userId = $_SESSION['user_id'];

// Get accepted friends
$stmt = $conn->prepare("
    SELECT u.id, u.username, u.email, u.last_active, u.gender
    FROM friendships f
    JOIN users u ON (f.user_id = u.id OR f.friend_id = u.id)
    WHERE (f.user_id = ? OR f.friend_id = ?) 
      AND f.status = 'accepted'
      AND u.id != ?
    ORDER BY u.username ASC
");
$stmt->bind_param("iii", $userId, $userId, $userId);
$stmt->execute();
$result = $stmt->get_result();

$friends = [];
while ($row = $result->fetch_assoc()) {
    $row['is_online'] = (strtotime($row['last_active']) > strtotime('-2 minutes'));
    $friends[] = $row;
}
$stmt->close();

echo json_encode(['success' => true, 'friends' => $friends]);
?>
