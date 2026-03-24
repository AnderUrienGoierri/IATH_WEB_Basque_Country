-- CREATE SCRIPT WITH CONSTRAINTS

DROP DATABASE IF EXISTS video_games_quiz_db;

CREATE DATABASE video_games_quiz_db;
USE video_games_quiz_db;

-- ====================================================== --
-- GENRES TABLE --
-- ====================================================== --
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- ====================================================== --
-- PLATFORMS TABLE --
-- ====================================================== --
CREATE TABLE platforms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- ====================================================== --
-- VIDEOGAMES TABLE --
-- ====================================================== --
CREATE TABLE videoGames (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    platform_id INT,
    size_gb DECIMAL(10, 2),
    genre_id INT,
    release_year INT,
    first_release_date DATE,
    game_description TEXT,
    full_description TEXT,
    more_data TEXT,
    image VARCHAR(255) DEFAULT NULL,
    originated VARCHAR(100) DEFAULT NULL,
    actual_price DECIMAL(10, 2) DEFAULT 0.00,
    purchases_on_game BOOLEAN DEFAULT FALSE,
    average_playgame_duration INT,
    average_player_age INT,
    male_female_ratio DECIMAL(5, 2),
    FOREIGN KEY (genre_id) REFERENCES genres(id) 
        ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (platform_id) REFERENCES platforms(id) 
        ON DELETE SET NULL ON UPDATE CASCADE
);

-- ====================================================== --
-- ====================================================== --
-- USERS TABLE (PROFILES) --
-- ====================================================== --
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    age INT UNSIGNED NOT NULL,
    gender ENUM('male', 'female', 'non-binary') DEFAULT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
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
    FOREIGN KEY (user_id) REFERENCES users(id) 
        ON DELETE SET NULL
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
    FOREIGN KEY (session_id) REFERENCES game_match_sessions(id) 
        ON DELETE CASCADE,
    FOREIGN KEY (game_id) REFERENCES videoGames(id) 
        ON DELETE CASCADE
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
    FOREIGN KEY (user_id) REFERENCES users(id) 
        ON DELETE CASCADE,
    FOREIGN KEY (game_id) REFERENCES videoGames(id) 
        ON DELETE CASCADE,
    UNIQUE KEY unique_user_game_interaction (user_id, game_id, interaction_type)
);

-- ====================================================== --
-- MESSAGES TABLE (USER CHAT)                             --
-- ====================================================== --
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT NOT NULL,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
);

