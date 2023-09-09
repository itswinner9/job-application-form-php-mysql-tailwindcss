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
        <form action="process.php" method="post">
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-300">Name:</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-2 bg-gray-800 border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-300">Email:</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 bg-gray-800 border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="phone" class="block font-medium text-gray-300">Phone:</label>
                <input type="tel" id="phone" name="phone" required
                    class="w-full px-4 py-2 bg-gray-800 border rounded-md focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="experience" class="block font-medium text-gray-300">Experience:</label>
                <textarea id="experience" name="experience" required
                    class="w-full px-4 py-2 bg-gray-800 border rounded-md focus:outline-none focus:border-blue-500 text-gray-300"></textarea>
            </div>

            <div class="mb-4">
                <label for="english" class="block font-medium text-gray-300">Can speak English:</label>
                <input type="checkbox" id="english" name="english" value="1"
                    class="ml-1">
            </div>

            <div class="mb-4">
                <label for="malay" class="block font-medium text-gray-300">Can speak Malay:</label>
                <input type="checkbox" id="malay" name="malay" value="1"
                    class="ml-1">
            </div>

            <div class="mb-4">
                <label for="experience_before" class="block font-medium text-gray-300">Experience before:</label>
                <input type="checkbox" id="experience_before" name="experience_before" value="1"
                    class="ml-1">
            </div>

            <div class="mt-4">
                <input type="submit" value="Apply"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 cursor-pointer">
            </div>
        </form>
    </div>
</body>
</html>
