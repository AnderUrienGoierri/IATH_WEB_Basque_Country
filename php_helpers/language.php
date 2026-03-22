<?php
// language.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';

// Map explicit language settings to their XML files
$xml_files = [
    'en' => 'english.xml',
    'es' => 'castellano.xml',
    'eu' => 'euskara.xml',
    'nl' => 'dutch.xml'
];

if (!array_key_exists($lang, $xml_files)) {
    $lang = 'en'; // Fallback
}

$xml_path = __DIR__ . '/../xml/' . $xml_files[$lang];
$txt = [];

if (file_exists($xml_path)) {
    $xml = simplexml_load_file($xml_path);
    if ($xml !== false) {
        foreach ($xml->children() as $child) {
            $txt[$child->getName()] = (string)$child;
        }
    } else {
         die("Error parsing XML language file.");
    }
} else {
    die("Language file not found: " . htmlspecialchars($xml_files[$lang]));
}
?>
