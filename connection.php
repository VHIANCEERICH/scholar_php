<?php
// ======================================
// DATABASE CONFIGURATION
// ======================================

$host     = "localhost";
$username = "scholar_user";        // Do NOT use root in production
$password = "StrongPassword123!";  // Your database password
$dbname   = "scholarship_db";

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
// SECURITY IMPROVEMENTS
// ======================================

// Set secure character encoding
$conn->set_charset("utf8mb4");

// Optional: set timezone
date_default_timezone_set("Asia/Manila");

// ======================================
// CONNECTION SUCCESSFUL
// (Do not echo messages in production)
// ======================================

// echo "Database connected successfully";

?>
