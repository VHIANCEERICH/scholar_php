<?php

// ================================
// CORS CONFIGURATION (SECURE)
// ================================

$trusted_domains = [
    "https://yourdomain.com",
    "http://localhost:3000",
    "http://localhost:5000"
];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $trusted_domains)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Handle browser preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json");

// ================================
// DATABASE CONNECTION
// ================================
include 'connection.php';

// ================================
// READ INPUT FROM FLUTTER
// ================================

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$email = $_POST['email'] ?? ($data['email'] ?? '');
$password = $_POST['password'] ?? ($data['password'] ?? '');

// ================================
// VALIDATION
// ================================

if (empty($email) || empty($password)) {
    echo json_encode([
        "status" => "error",
        "message" => "Please provide email and password"
    ]);
    exit();
}

// ================================
// FIND USER
// ================================

$stmt = $conn->prepare("SELECT id, email, password, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {

    // Verify hashed password
    if (password_verify($password, $user['password'])) {

        $response = [
            "status" => "success",
            "user" => [
                "id" => $user['id'],
                "email" => $user['email'],
                "role" => $user['role'],
                "usr_fullname" => explode('@', $user['email'])[0]
            ]
        ];

        echo json_encode($response);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "Invalid password"
        ]);

    }

} else {

    echo json_encode([
        "status" => "error",
        "message" => "User not found"
    ]);

}

$stmt->close();
$conn->close();

?>
