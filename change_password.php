<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'vendor/autoload.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if (empty($email) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['alertMessage'] = "All fields are required!";
        header('Location: home.php'); // Or 'dashboard.php'
        exit();
    } elseif ($new_password !== $confirm_password) {
        $_SESSION['alertMessage'] = "Passwords do not match!";
        header('Location: home.php'); // Or 'dashboard.php'
        exit();
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Check if the email exists
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update the password in the database
            $update_sql = "UPDATE user SET password = ? WHERE email = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ss", $hashed_password, $email);

            if ($update_stmt->execute()) {
                // Send confirmation email using PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // SMTP settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                    $mail->SMTPAuth = true;
                    $mail->Username = 'archanamuruganrm@gmail.com'; // Replace with your email
                    $mail->Password = 'vsou himy qpcy dxxc'; // Replace with your email password(App password)
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
                    $mail->Port = 587; // Port for TLS
                    // Email settings
                    $mail->setFrom('archanamuruganrm@gmail.com', 'E-commerce Team');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Password Changed Successfully';
                    $mail->Body = "
                        <p>Dear User,</p>
                        <p>Your password has been successfully updated. You can now log in with your new password.</p>
                        <p>Regards,<br>E-commerce Team</p>
                    ";

                    $mail->send();

                    $_SESSION['alertMessage'] = "Password changed successfully! A confirmation email has been sent. press ok to login with your new password!";
                    header('Location: home.php'); 
                    exit();
                } catch (Exception $e) {
                    $_SESSION['alertMessage'] = "Password updated, but email could not be sent. Error: {$mail->ErrorInfo}";
                    header('Location: home.php'); 
                    exit();
                }
            } else {
                $_SESSION['alertMessage'] = "Error updating password. Please try again later.";
                header('Location: home.php'); 
                exit();
            }
        } else {
            $_SESSION['alertMessage'] = "No account found with this email! Press ok";
            header('Location: home.php'); 
            exit();
        }
    }
}

// Close the connection
$conn->close();
?>
