<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lucky";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sqlquery = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sqlquery);

    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Redirect to the main page
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
