<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

require_once '../conexionDB.php';

$userId = $_SESSION['user_id'];
$query = isset($_GET['q']) ? $_GET['q'] : '';

if (strlen($query) < 3) {
    echo json_encode(['success' => true, 'users' => []]);
    exit;
}

// Search by username or email, exclude self
$searchTerm = "%$query%";
$stmt = $conn->prepare("
    SELECT id, username, email 
    FROM users 
    WHERE (username LIKE ? OR email LIKE ?) 
      AND id != ? 
      AND role = 'user'
    LIMIT 10
");
$stmt->bind_param("ssi", $searchTerm, $searchTerm, $userId);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    // Check friendship status
    $statusStmt = $conn->prepare("
        SELECT status, user_id FROM friendships 
        WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)
    ");
    $statusStmt->bind_param("iiii", $userId, $row['id'], $row['id'], $userId);
    $statusStmt->execute();
    $statusRes = $statusStmt->get_result()->fetch_assoc();
    
    $row['friend_status'] = $statusRes ? $statusRes['status'] : null;
    $row['is_sender'] = $statusRes ? ($statusRes['user_id'] == $userId) : false;
    $users[] = $row;
    $statusStmt->close();
}
$stmt->close();

echo json_encode(['success' => true, 'users' => $users]);
?>
