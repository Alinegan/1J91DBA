<?php
header("Content-Type: application/json");

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "POST only"]);
    exit;
}

// Read raw POST data
$json = file_get_contents("php://input");

if (!$json) {
    http_response_code(400);
    echo json_encode(["error" => "No data received"]);
    exit;
}

// Decode JSON to validate
$data = json_decode($json, true);
if ($data === null) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid JSON"]);
    exit;
}

// Optional: clean room name for file saving
$roomName = isset($data["Room"]) ? preg_replace("/[^a-zA-Z0-9_-]/", "", $data["Room"]) : "UnknownRoom";

// Ensure storage folder exists
$storageDir = __DIR__ . "/rooms";
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0777, true);
}

// Save JSON file (overwrites existing room)
$filePath = $storageDir . "/" . $roomName . ".json";
file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));

// Response
echo json_encode([
    "status" => "success",
    "room" => $roomName,
    "players" => isset($data["Players"]) ? count($data["Players"]) : 0
]);
?>
