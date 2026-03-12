<?php
// ======================================
// DATABASE CONFIGURATION (FROM ENV)
// ======================================

// Load values from environment variables
$host     = getenv('DB_HOST') ?: 'localhost';
$username = getenv('DB_USER') ?: '';
$password = getenv('DB_PASS') ?: '';
$dbname   = getenv('DB_NAME') ?: '';

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

// Secure character encoding
$conn->set_charset("utf8mb4");

// Set timezone
date_default_timezone_set("Asia/Manila");

?>
