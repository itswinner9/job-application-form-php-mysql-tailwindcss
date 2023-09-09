<?php
// Include the database connection
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);

    // Validate and sanitize input data here

    // Check if the admin exists in the database
    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // Admin is authenticated, store a session variable or cookie to indicate login
        session_start();
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        // Invalid credentials, redirect back to login page with an error message
        header("Location: admin_login.html?error=1");
        exit();
    }
}

// Close the database connection
mysqli_close($connection);
?>
