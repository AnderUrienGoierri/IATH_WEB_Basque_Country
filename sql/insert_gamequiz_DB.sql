-- BASE DATA INSERTS
USE video_games_quiz_db;

-- ====================================================== --
INSERT INTO genres (name)
VALUES ('Action-Adventure'),
    ('Action RPG'),
    ('Sandbox'),
    ('Platformer'),
    ('FPS'),
    ('Battle Royale'),
    ('Survival Horror'),
    ('Roguelike'),
    ('Simulation'),
    ('Social Simulation'),
    ('Racing'),
    ('Fighting'),
    ('TPS'),
    ('JRPG'),
    ('MOBA'),
    ('VR FPS'),
    ('Puzzle-Platformer'),
    ('Survival'),
    ('Metroidvania'),
    ('RPG'),
    ('Run and Gun'),
    ('Roguelite'),
    ('Deckbuilder'),
    ('Social Deduction'),
    ('Platform Battle Royale'),
    ('Sports'),
    ('Hack and Slash'),
    ('Action'),
    ('Stealth'),
    ('Immersive Sim'),
    ('Turn-based RPG'),
    ('Adventure'),
    ('Life Simulation'),
    ('City-building'),
    ('Strategy'),
    ('Grand Strategy'),
    ('Construction and Management Simulation'),
    ('MMORPG'),
    ('Puzzle'),
    ('Top-down Shooter'),
    ('Action-Platformer'),
    ('FPS/TPS'),
    ('Fishing');

INSERT INTO platforms (name)
VALUES ('Nintendo Switch'),
    ('PlayStation 5'),
    ('PC'),
    ('PS5'),
    ('Xbox Series X/S'),
    ('PS4'),
    ('Xbox One'),
    ('Switch'),
    ('Multi-platform'),
    ('PlayStation 4'),
    ('PC (VR)'),
    ('PS3'),
    ('Xbox 360'),
    ('Xbox'),
    ('PlayStation 3'),
    ('Android');





-- ====================================================== --
-- USERS TABLE (PROFILES)
-- Admin password: admin123, User passwords: user123
-- ====================================================== --
INSERT INTO users (username, email, password_hash, age, gender, role) VALUES
('Ander_Admin', 'ander.admin@gamematch.ai', '$2y$10$dcBGKSl8IzVTSru4LdmRwO8QRCUD6n7JGPkClGXKW4JIQzivI6OFu', 35, 'male', 'admin'),
('Ander', 'ander@gamematch.ai', '$2y$10$3lFQy9E6g3c3KWBgkeaGDuRDcOTmY1klDHMqXORVYILibe1KGyE/q', 28, 'male', 'user'),
('Oihan', 'oihan@gamematch.ai', '$2y$10$3lFQy9E6g3c3KWBgkeaGDuRDcOTmY1klDHMqXORVYILibe1KGyE/q', 22, 'male', 'user'),
('Julen', 'julen@gamematch.ai', '$2y$10$3lFQy9E6g3c3KWBgkeaGDuRDcOTmY1klDHMqXORVYILibe1KGyE/q', 25, 'male', 'user'),
('Liz', 'liz@gamematch.ai', '$2y$10$3lFQy9E6g3c3KWBgkeaGDuRDcOTmY1klDHMqXORVYILibe1KGyE/q', 24, 'female', 'user'),
('Sanne', 'sanne@gamematch.ai', '$2y$10$3lFQy9E6g3c3KWBgkeaGDuRDcOTmY1klDHMqXORVYILibe1KGyE/q', 26, 'female', 'user');

-- ====================================================== --
-- GAME MATCH SESSIONS
-- ====================================================== --
INSERT INTO game_match_sessions (user_id, device_preference, available_time_preference, mood_preference) VALUES
(2, 'PC', 120, 'Action'),
(2, 'PlayStation 5', 60, 'Relaxing'),
(3, 'Nintendo Switch', 30, 'Fun'),
(4, 'Xbox Series X/S', 180, 'Competitive'),
(5, 'PC', 90, 'Story-driven'),
(6, 'Multi-platform', 45, 'Casual');

-- ====================================================== --
-- ====================================================== --