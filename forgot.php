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

    // Validate email input
    if (empty($email)) {
        $_SESSION['alertMessage'] = "Email is required!";
        header('Location: home.php'); // Redirect to the appropriate page
        exit();
    }

    // Check if the email exists
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a random default password
        $default_password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);

        // Hash the default password
        $hashed_password = password_hash($default_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $update_sql = "UPDATE user SET password = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $hashed_password, $email);

        if ($update_stmt->execute()) {
            // Send the default password via email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // SMTP settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'archanamuruganrm@gmail.com'; // Replace with your email
                $mail->Password = 'vsou himy qpcy dxxc'; // Replace with your email password (App password)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
                $mail->Port = 587; // Port for TLS

                // Email settings
                $mail->setFrom('archanamuruganrm@gmail.com', 'E-commerce Team');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Your New Default Password';
                $mail->Body = "
                    <p>Dear User,</p>
                    <p>Your password has been reset. Below is your default password:</p>
                    <p><strong>$default_password</strong></p>
                    <p>Please log in and change your password immediately.</p>
                    <p>Regards,<br>E-commerce Team</p>
                ";

                $mail->send();

                $_SESSION['alertMessage'] = "A default password has been sent to your email. Use it to log in.";
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
        $_SESSION['alertMessage'] = "No account found with this email!";
        header('Location: home.php');
        exit();
    }
}

// Close the connection
$conn->close();
?>
