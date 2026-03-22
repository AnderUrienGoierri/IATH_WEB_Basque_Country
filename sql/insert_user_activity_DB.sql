USE video_games_quiz_db;

-- RECOMMENDATIONS
-- ====================================================== --
INSERT INTO recommendations (session_id, game_id, match_score, rank_position, is_selected) VALUES
(1, 2, 95.5, 1, 1), (1, 15, 88.0, 2, 0), (1, 34, 85.2, 3, 0),
(2, 7, 92.1, 1, 1), (2, 22, 90.5, 2, 0), (2, 8, 81.0, 3, 0),
(3, 11, 98.0, 1, 1), (3, 14, 89.4, 2, 0),
(4, 9, 94.2, 1, 0), (4, 18, 91.1, 2, 1), (4, 25, 86.5, 3, 0),
(5, 1, 97.8, 1, 1), (5, 4, 93.2, 2, 0),
(6, 30, 88.5, 1, 1), (6, 12, 85.0, 2, 0);

-- USER GAME INTERACTIONS
-- ====================================================== --
INSERT INTO user_game_interactions (user_id, game_id, interaction_type, rating) VALUES
(2, 2, 'played', 5),
(2, 15, 'viewed', NULL),
(3, 11, 'liked', 4),
(4, 18, 'played', 5),
(5, 1, 'wishlist', NULL);