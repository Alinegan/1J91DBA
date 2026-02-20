<?php

$API_KEY = "123456"; // change this

if (!isset($_SERVER['HTTP_X_API_KEY']) || $_SERVER['HTTP_X_API_KEY'] !== $API_KEY) {
    http_response_code(401);
    die("Invalid API Key");
}

$data = file_get_contents("php://input");

file_put_contents("update.json", $data);

echo "Updated";

?>