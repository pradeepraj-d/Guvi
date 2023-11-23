<?php

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow the following methods
header("Access-Control-Allow-Methods: POST");

// Allow the following headers
header("Access-Control-Allow-Headers: Content-Type");

// Set content type to JSON
header("Content-Type: application/json");

// Get user data from the POST request
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Create a response array
$response = [];

// Establish a database connection
$conn = mysqli_connect('localhost', 'root', '', 'userdata');

if (!$conn) {
    $response['status'] = 'error';
    $response['message'] = 'Connection failed: ' . mysqli_connect_error();
    echo json_encode($response);
    exit();
}

// Check if the email already exists
$stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$num_rows = $stmt->num_rows;
$stmt->close();

// If the email already exists, return an error response
if ($num_rows > 0) {
    $response['status'] = 'error';
    $response['message'] = 'Email already registered';
    echo json_encode($response);
    exit();
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert new user data
$stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $username, $hashedPassword);

if ($stmt->execute()) {
    $response['status'] = 'success';
    $response['message'] = 'Registration successful!';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error during registration: ' . $stmt->error;
}

$stmt->close();
$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
