<?php
include 'php_helpers/conexionDB.php';
$conn = getConexion();

// Add columns if they don't exist
$cols = ['game_desc_en', 'game_desc_es', 'game_desc_eu', 'game_desc_nl'];
foreach($cols as $col) {
    try {
        $conn->query("ALTER TABLE videogames ADD COLUMN $col TEXT");
    } catch (PDOException $e) {
        // Column likely exists
    }
}

// Migrate existing descriptions
$conn->query("UPDATE videogames SET 
    game_desc_en = COALESCE(game_desc_en, card_desc),
    game_desc_es = COALESCE(game_desc_es, card_desc),
    game_desc_eu = COALESCE(game_desc_eu, card_desc),
    game_desc_nl = COALESCE(game_desc_nl, card_desc)");

echo "Migration completed successfully.";
?>
