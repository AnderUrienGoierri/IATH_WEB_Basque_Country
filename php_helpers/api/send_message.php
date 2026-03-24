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
$senderId = $_SESSION['user_id'];
$receiverId = isset($data['receiver_id']) ? (int)$data['receiver_id'] : 0;
$message = isset($data['message']) ? trim($data['message']) : '';

if ($receiverId <= 0 || empty($message)) {
    echo json_encode(['success' => false, 'error' => 'Missing receiver or message']);
    exit;
}

if ($receiverId === $senderId) {
    echo json_encode(['success' => false, 'error' => 'Cannot message yourself']);
    exit;
}

// Limit message length
if (strlen($message) > 1000) {
    $message = substr($message, 0, 1000);
}

$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $senderId, $receiverId, $message);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => [
            'id' => $stmt->insert_id,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => htmlspecialchars($message),
            'sent_at' => date('Y-m-d H:i:s'),
            'is_mine' => true
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to send message']);
}
$stmt->close();
?>
