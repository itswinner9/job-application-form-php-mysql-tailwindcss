<?php
session_start();

// Include the database connection
require_once("db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $application_id = $_POST['id'];

    // Check if the admin clicked the "Approve" or "Deny" button
    if (isset($_POST['approve'])) {
        // Implement the approval logic here (e.g., update the database, send notifications, etc.)
        // You can set a status field in the database to mark the application as approved.

        // Retrieve the applicant's email
        $sql = "SELECT email FROM applications WHERE id = $application_id";
        $result = mysqli_query($connection, $sql);
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $applicantEmail = $row['email'];

            // Send an approval email to the applicant
            try {
                require 'vendor/autoload.php'; // Adjust the path as needed

                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 0; // Enable verbose debugging (0 for production)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'oneto5services@gmail.com'; // Replace with your SMTP username
                $mail->Password = 'aidtzywqlewjjhdl'; // Replace with your SMTP password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption
                $mail->Port = 587; // Port for TLS (587 for Gmail)

                $mail->setFrom('oneto5services@gmail.com', 'oneto5services'); // Replace with your name and email
                $mail->addAddress($applicantEmail);

                $mail->isHTML(true);
                $mail->Subject = 'Application Approved';
                $mail->Body = 'Congratulations! Your application has been approved.';

                $mail->send();
            } catch (Exception $e) {
                echo "Error sending email: " . $mail->ErrorInfo;
            }
        }
        
        // Redirect back to the admin dashboard or a confirmation page
        header("Location: admin_dashboard.php");
        exit();
    } elseif (isset($_POST['deny'])) {
        // Implement the denial logic here (e.g., update the database, send notifications, etc.)
        // You can set a status field in the database to mark the application as denied.

        // Retrieve the applicant's email
        $sql = "SELECT email FROM applications WHERE id = $application_id";
        $result = mysqli_query($connection, $sql);
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $applicantEmail = $row['email'];

            // Send a denial email to the applicant
            try {
                require 'vendor/autoload.php'; // Adjust the path as needed

                $mail = new PHPMailer(true);
                $mail->SMTPDebug = 0; // Enable verbose debugging (0 for production)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'oneto5services@gmail.com'; // Replace with your SMTP username
                $mail->Password = 'aidtzywqlewjjhdl'; // Replace with your SMTP password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption
                $mail->Port = 587; // Port for TLS (587 for Gmail)

                $mail->setFrom('oneto5services@gmail.com', 'oneto5services'); // Replace with your name and email
                $mail->addAddress($applicantEmail);

                $mail->isHTML(true);
                $mail->Subject = 'Application Denied';
                $mail->Body = 'We regret to inform you that your application has been denied.';

                $mail->send();
            } catch (Exception $e) {
                echo "Error sending email: " . $mail->ErrorInfo;
            }
        }
        
        // Redirect back to the admin dashboard or a confirmation page
        header("Location: admin_dashboard.php");
        exit();
    }
}

// Redirect to the admin dashboard if no action was taken
header("Location: admin_dashboard.php");
exit();
?>
