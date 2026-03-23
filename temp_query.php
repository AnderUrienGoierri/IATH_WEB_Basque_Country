<?php
require_once 'php_helpers/conexionDB.php';

echo "Shortest images:\n";
$res = $conn->query("SELECT id, name, image FROM videoGames ORDER BY LENGTH(IFNULL(image, '')) ASC LIMIT 5");
while($r = $res->fetch_assoc()) echo $r['id']." | ".$r['name']." | length: ".strlen($r['image'])." | val: ".$r['image']."\n";

echo "\nShortest descriptions:\n";
$res = $conn->query("SELECT id, name, game_description FROM videoGames ORDER BY LENGTH(IFNULL(game_description, '')) ASC LIMIT 5");
while($r = $res->fetch_assoc()) echo $r['id']." | ".$r['name']." | length: ".strlen($r['game_description'])." | val: ".$r['game_description']."\n";
?>
