USE video_games_quiz_db;

CREATE TABLE platforms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO platforms (name) VALUES
('Nintendo Switch'),
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
('PlayStation 3');
