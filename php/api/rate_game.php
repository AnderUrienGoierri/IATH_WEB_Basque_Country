<?php
session_start();
header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit();
}

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'error' => 'Not authenticated']);
    exit();
}

// Read JSON body
$input = json_decode(file_get_contents('php://input'), true);
$game_id = intval($input['game_id'] ?? 0);
$rating = intval($input['rating'] ?? 0);

// Validate
if ($game_id <= 0 || $rating < 1 || $rating > 5) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid game_id or rating (1-5)']);
    exit();
}

$user_id = $_SESSION['user_id'];

require_once '../conexionDB.php';

// Check if user already rated this game (interaction_type = 'liked')
$stmt = $conn->prepare("SELECT id FROM user_game_interactions WHERE user_id = ? AND game_id = ? AND interaction_type = 'liked'");
$stmt->bind_param("ii", $user_id, $game_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // UPDATE existing rating
    $stmt->close();
    $stmt = $conn->prepare("UPDATE user_game_interactions SET rating = ? WHERE user_id = ? AND game_id = ? AND interaction_type = 'liked'");
    $stmt->bind_param("iii", $rating, $user_id, $game_id);
} else {
    // INSERT new rating
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO user_game_interactions (user_id, game_id, interaction_type, rating) VALUES (?, ?, 'liked', ?)");
    $stmt->bind_param("iii", $user_id, $game_id, $rating);
}

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'rating' => $rating]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error']);
}

$stmt->close();
$conn->close();
