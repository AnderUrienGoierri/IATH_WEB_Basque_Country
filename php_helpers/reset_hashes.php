<?php
require 'c:/Apache24-64/htdocs/IATH_WEB_Basque_Country/php/conexionDB.php';

$conn->query("UPDATE users SET password_hash = '123456' WHERE password_hash LIKE '\$2y\$%' OR password_hash LIKE '\$2a\$%'");
echo "Updated " . $conn->affected_rows . " rows.\n";
?>
