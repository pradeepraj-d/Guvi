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