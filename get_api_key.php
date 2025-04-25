<?php
header('Content-Type: application/json');

// Read API key from config file
$config = parse_ini_file('config.ini');
$gemini_api_key = $config['GEMINI_API_KEY'] ?? null;

if ($gemini_api_key) {
    echo json_encode(['success' => true, 'api_key' => $gemini_api_key]);
} else {
    echo json_encode(['success' => false, 'error' => 'API key not found']);
}
?>