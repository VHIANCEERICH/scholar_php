<?php
// ======================================
// DATABASE CONFIGURATION
// ======================================

$host     = "localhost";
$username = "scholar_user";        // Secure database user (not root)
$password = "StrongPassword123!";  // Database password
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

// Secure character encoding
$conn->set_charset("utf8mb4");

// Set timezone
date_default_timezone_set("Asia/Manila");

// ======================================
// CONNECTION SUCCESSFUL
// ======================================

// echo "Database connected successfully"; // Keep commented in production

?>
