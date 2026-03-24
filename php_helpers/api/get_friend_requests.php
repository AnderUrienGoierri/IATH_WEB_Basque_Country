<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

require_once '../conexionDB.php';
$userId = $_SESSION['user_id'];

// Incoming requests
$incomingStmt = $conn->prepare("
    SELECT f.id as request_id, u.id as user_id, u.username, u.email 
    FROM friendships f
    JOIN users u ON f.user_id = u.id
    WHERE f.friend_id = ? AND f.status = 'pending'
");
$incomingStmt->bind_param("i", $userId);
$incomingStmt->execute();
$incomingResult = $incomingStmt->get_result();
$incoming = [];
while ($row = $incomingResult->fetch_assoc()) $incoming[] = $row;
$incomingStmt->close();

// Outgoing requests
$outgoingStmt = $conn->prepare("
    SELECT f.id as request_id, u.id as user_id, u.username, u.email 
    FROM friendships f
    JOIN users u ON f.friend_id = u.id
    WHERE f.user_id = ? AND f.status = 'pending'
");
$outgoingStmt->bind_param("i", $userId);
$outgoingStmt->execute();
$outgoingResult = $outgoingStmt->get_result();
$outgoing = [];
while ($row = $outgoingResult->fetch_assoc()) $outgoing[] = $row;
$outgoingStmt->close();

echo json_encode([
    'success' => true, 
    'incoming' => $incoming, 
    'outgoing' => $outgoing
]);
?>
