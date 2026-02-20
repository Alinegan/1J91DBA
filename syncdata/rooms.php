<?php
header("Content-Type: application/json");

$storageDir = __DIR__ . "/rooms";

$allRooms = [];
if (is_dir($storageDir)) {
    foreach (glob($storageDir . "/*.json") as $file) {
        $allRooms[] = json_decode(file_get_contents($file), true);
    }
}

echo json_encode([
    "roomCount" => count($allRooms),
    "rooms" => $allRooms
], JSON_PRETTY_PRINT);
