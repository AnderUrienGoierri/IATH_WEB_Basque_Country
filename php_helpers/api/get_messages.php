<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

require_once '../conexionDB.php';

$userId = $_SESSION['user_id'];
$otherId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 0;
$afterId = isset($_GET['after_id']) ? (int)$_GET['after_id'] : 0;

if ($otherId <= 0) {
    echo json_encode(['success' => false, 'error' => 'Missing user_id']);
    exit;
}

// Build query - if after_id is set, only get newer messages (for polling)
$where = "((sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?))";
$params = [$userId, $otherId, $otherId, $userId];
$types = "iiii";

if ($afterId > 0) {
    $where .= " AND id > ?";
    $params[] = $afterId;
    $types .= "i";
} else {
    // First load: get last 50 messages
    $where .= " ORDER BY id DESC LIMIT 50";
}

$sql = "SELECT id, sender_id, receiver_id, message, sent_at FROM messages WHERE $where";
if ($afterId > 0) {
    $sql .= " ORDER BY id ASC";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $row['message'] = htmlspecialchars($row['message']);
    $row['is_mine'] = ($row['sender_id'] == $userId);
    $messages[] = $row;
}
$stmt->close();

// If first load, reverse to chronological order
if ($afterId <= 0) {
    $messages = array_reverse($messages);
}

// Mark received messages as read
$markStmt = $conn->prepare("UPDATE messages SET is_read = TRUE WHERE sender_id = ? AND receiver_id = ? AND is_read = FALSE");
$markStmt->bind_param("ii", $otherId, $userId);
$markStmt->execute();
$markStmt->close();

echo json_encode(['success' => true, 'messages' => $messages]);
?>
