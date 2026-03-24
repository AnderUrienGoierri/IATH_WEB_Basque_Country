<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit;
}

require_once '../conexionDB.php';

$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['action']) || !isset($data['target_id'])) {
    echo json_encode(['success' => false, 'error' => 'Missing parameters']);
    exit;
}

$action = $data['action'];
$targetId = (int)$data['target_id'];

if ($action === 'send_request') {
    $stmt = $conn->prepare("INSERT INTO friendships (user_id, friend_id, status) VALUES (?, ?, 'pending')");
    $stmt->bind_param("ii", $userId, $targetId);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Request already exists or error occurred']);
    }
    $stmt->close();
} elseif ($action === 'accept_request') {
    $stmt = $conn->prepare("UPDATE friendships SET status = 'accepted' WHERE user_id = ? AND friend_id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $targetId, $userId);
    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No pending request found']);
    }
    $stmt->close();
} elseif ($action === 'decline_request') {
    $stmt = $conn->prepare("DELETE FROM friendships WHERE user_id = ? AND friend_id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $targetId, $userId);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Could not decline']);
    }
    $stmt->close();
} elseif ($action === 'remove_friend') {
    $stmt = $conn->prepare("DELETE FROM friendships WHERE (user_id = ? AND friend_id = ?) OR (user_id = ? AND friend_id = ?)");
    $stmt->bind_param("iiii", $userId, $targetId, $targetId, $userId);
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Could not remove']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>
