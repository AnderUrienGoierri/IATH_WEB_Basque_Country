USE video_games_quiz_db;
-- ====================================================== --
-- ====================================================== --
-- USERS TABLE (PROFILES) --
-- ====================================================== --
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) UNIQUE,
    password_hash VARCHAR(255),
    age INT,
    gender ENUM('male', 'female', 'non-binary') DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- ====================================================== --
-- GAME MATCH SESSIONS (QUIZ DATA) --
-- ====================================================== --
CREATE TABLE game_match_sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    device_preference VARCHAR(100),
    -- 'Nintendo Switch', 'PC', etc.
    available_time_preference INT,
    -- in minutes
    mood_preference VARCHAR(100),
    -- 'Relaxing', 'Action', etc.
    session_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE
    SET NULL
);
-- ====================================================== --
-- RECOMMENDATIONS (RESULTS) --
-- ====================================================== --
CREATE TABLE recommendations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    session_id INT NOT NULL,
    game_id INT NOT NULL,
    match_score DECIMAL(5, 2),
    -- Score calculated by the algorithm
    rank_position INT,
    -- 1 for top match, 2 for second, etc.
    is_selected BOOLEAN DEFAULT FALSE,
    -- If user clicked/viewed this specific recommendation
    FOREIGN KEY (session_id) REFERENCES game_match_sessions(id) ON DELETE CASCADE,
    FOREIGN KEY (game_id) REFERENCES videoGames(id) ON DELETE CASCADE
);
-- ====================================================== --
-- USER GAME INTERACTIONS (FEEDBACK/HISTORY) --
-- ====================================================== --
CREATE TABLE user_game_interactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    game_id INT NOT NULL,
    interaction_type ENUM(
        'viewed',
        'liked',
        'disliked',
        'played',
        'wishlist'
    ) NOT NULL,
    rating INT CHECK (
        rating >= 1
        AND rating <= 5
    ),
    -- Optional 1-5 rating
    interaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (game_id) REFERENCES videoGames(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_game_interaction (user_id, game_id, interaction_type)
);