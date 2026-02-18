USE video_games_quiz_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    device VARCHAR(100),
    available_time_minutes INT,
    mood VARCHAR(100),
    recommended_game_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recommended_game_id) REFERENCES videoGames(id)
);