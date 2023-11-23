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
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Create a response array
$response = [];

// Establish a database connection
$conn = mysqli_connect('localhost', 'root', '', 'userdata');
$response['status'] = 'error';
if (!$conn) {
    $response['status'] = 'error';
    $response['message'] = 'Connection failed: ' . mysqli_connect_error();
    echo json_encode($response);
    exit();
}
$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);

    // Execute the prepared statement
$stmt->execute();

    // Bind the result variable
$stmt->bind_result($hashedPassword);

    // Fetch the result
$stmt->fetch();

    // Close the prepared statement
$stmt->close();

    // Check if the hashed password is not empty
if (!empty($hashedPassword)) {
        // Verify the password using password_verify
    if (password_verify($password, $hashedPassword)) {
            // Password is correct
        $response['status'] = 'success';
        $response['email'] = $email;
        $response['message'] = 'login successful!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Ivalid Password';
    }
} else {
        // Email not found in the database
    $response['status'] = 'error';
    $response['message'] = 'Email not found';
}
echo json_encode($response);
    // Close the database connection
$conn->close();
?>