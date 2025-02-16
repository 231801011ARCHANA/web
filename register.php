<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        $_SESSION['alertMessage'] = "Passwords do not match!";
    } else {
        // Hash the password   
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert user data
        $sql = "INSERT INTO user (username, email, mobile, password) 
                VALUES ('$username', '$email', '$mobile', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['alertMessage'] = "Registration successful!";
        } else {
            $_SESSION['alertMessage'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Redirect to home.php after processing
    header('Location: home.php');
    exit();
}

// Close the connection
$conn->close();
?>
