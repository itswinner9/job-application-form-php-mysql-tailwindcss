<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin_login.html");
    exit();
}

// Include the database connection
require_once("db.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $application_id = $_GET['id'];

    // Retrieve the current application details
    $sql = "SELECT * FROM applications WHERE id = $application_id";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Display application details for review

        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>Application Details</title>";
        echo "<!-- Include Tailwind CSS -->";
        echo "<link href='https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css' rel='stylesheet'>";
        echo "<style>";
        echo "/* Custom styles for dark theme */";
        echo "body {";
        echo "    background-color: #1a202c;";
        echo "    color: #cbd5e0;";
        echo "}";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container mx-auto p-6'>";
        echo "<h1 class='text-3xl font-semibold mb-4'>Application Details</h1>";
        echo "<p class='mb-2'><span class='font-semibold'>Name:</span> " . $row['name'] . "</p>";
        echo "<p class='mb-2'><span class='font-semibold'>Email:</span> " . $row['email'] . "</p>";
        echo "<p class='mb-2'><span class='font-semibold'>Phone:</span> " . $row['phone'] . "</p>";
        echo "<p class='mb-2'><span class='font-semibold'>Experience:</span> " . $row['experience'] . "</p>";
        echo "<p class='mb-2'><span class='font-semibold'>Languages:</span>";
        if ($row['english'] == 1) {
            echo " English, ";
        }
        if ($row['malay'] == 1) {
            echo " Malay, ";
        }
        echo "</p>";
        echo "<p class='mb-2'><span class='font-semibold'>Experience Before:</span>";
        if ($row['experience_before'] == 1) {
            echo " Yes";
        } else {
            echo " No";
        }
        echo "</p>";

        // Add buttons to approve or deny the application
        echo "<form action='approve_application.php' method='post' class='mt-4'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='approve' class='px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600'>Approve</button>";
        echo "<button type='submit' name='deny' class='px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 ml-2'>Deny</button>";
        echo "</form>";
        echo "</div>";
        echo "</body>";
        echo "</html>";

        // Redirect back to the admin dashboard or a different page after processing
        exit(); // Exit here to prevent displaying the list of applications
    } else {
        echo "Application not found.";
    }
} else {
    echo "Invalid application ID.";
}

// Close the database connection
mysqli_close($connection);
?>
