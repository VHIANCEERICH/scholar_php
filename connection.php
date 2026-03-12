<?php

// ======================================
// LOAD ENVIRONMENT VARIABLES
// ======================================

$host     = $_ENV['DB_HOST'] ?? 'localhost';
$username = $_ENV['DB_USER'] ?? '';
$password = $_ENV['DB_PASS'] ?? '';
$dbname   = $_ENV['DB_NAME'] ?? '';

// ======================================
// CREATE DATABASE CONNECTION
// ======================================

$conn = new mysqli($host, $username, $password, $dbname);

// ======================================
// CHECK CONNECTION
// ======================================

if ($conn->connect_error) {
    http_response_code(500);

    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed"
    ]);

    exit();
}

// ======================================
// SECURITY SETTINGS
// ======================================

$conn->set_charset("utf8mb4");
date_default_timezone_set("Asia/Manila");

?>
