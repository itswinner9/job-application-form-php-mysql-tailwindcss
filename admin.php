<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin_login.html");
    exit();
}

// Include the database connection
require_once("db.php");

// Retrieve all job applications
$sql = "SELECT * FROM applications";
$result = mysqli_query($connection, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Applications</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for dark theme */
        body {
            background-color: #1a202c;
            color: #cbd5e0;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #718096;
            text-align: left;
        }
        th {
            background-color: #2d3748;
        }
        tr:nth-child(even) {
            background-color: #4a5568;
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-4">Job Applications</h1>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-black bg-red-300">Name</th>
                        <th class="px-6 py-3 text-black bg-green-300">Email</th>
                        <th class="px-6 py-3 text-black bg-blue-300">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $row['name'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $row['email'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><a href='view_application.php?id=<?= $row['id'] ?>' class='text-blue-500 hover:underline'>View Details</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-gray-400">No job applications found.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
