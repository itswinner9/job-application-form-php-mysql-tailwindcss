<?php
// Include the database connection
require_once("db.php");

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($connection, $_POST["name"]);
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $phone = mysqli_real_escape_string($connection, $_POST["phone"]);
    $experience = mysqli_real_escape_string($connection, $_POST["experience"]);
    $english = isset($_POST["english"]) ? 1 : 0;
    $malay = isset($_POST["malay"]) ? 1 : 0;
    $experience_before = isset($_POST["experience_before"]) ? 1 : 0;

    // Check if the email or phone already exists in the database
    $checkQuery = "SELECT * FROM applications WHERE email='$email' OR phone='$phone'";
    $result = mysqli_query($connection, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $errorMessage = "You have already applied. Please wait for a response.";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO applications (name, email, phone, experience, english, malay, experience_before)
                VALUES ('$name', '$email', '$phone', '$experience', '$english', '$malay', '$experience_before')";

        if (mysqli_query($connection, $sql)) {
            $successMessage = "Application successful!";
        } else {
            $errorMessage = "Application not successful. Please try again later.";
        }
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-4">Job Application</h1>
        <form id="applicationForm" action="apply.php" method="post">
            <!-- ... (Rest of the form remains unchanged) -->

            <!-- Success or Error Message Popup -->
            <?php if (!empty($successMessage) || !empty($errorMessage)) : ?>
                <div id="message" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                        <?php if (!empty($successMessage)) : ?>
                            <p class="text-green-500 font-semibold"><?= $successMessage ?></p>
                        <?php elseif (!empty($errorMessage)) : ?>
                            <p class="text-red-500 font-semibold"><?= $errorMessage ?></p>
                        <?php endif; ?>
                        <button id="closeMessage" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 cursor-pointer">Close</button>
                    </div>
                </div>
                <script>
                    document.getElementById("closeMessage").addEventListener("click", function () {
                        document.getElementById("message").style.display = "none";
                    });
                </script>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
