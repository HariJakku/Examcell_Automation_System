<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 flex flex-col min-h-screen">

    <!-- Header at the very top -->
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold">
        Examination Cell Automation System
    </header>

    <!-- Main Content Centered -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="flex flex-col md:flex-row bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl space-x-6">
            
            <!-- Image Section -->
            <div class="w-full md:w-1/2 flex items-center justify-center">
                <img src="admin.jpg" alt="Admin Image" class="w-full max-w-sm rounded-lg shadow-md">
            </div>

            <!-- Form Section -->
            <div class="w-full md:w-1/2 flex flex-col justify-center text-center">
                <h2 class="text-2xl font-bold text-gray-700 mb-6">Welcome, Admin</h2>
                <ul class="space-y-4">
                    <li>
                        <a href="allocate_rooms.php" class="block w-full bg-purple-500 text-white py-3 px-4 rounded-lg hover:bg-purple-700 transition duration-300">Allocate Rooms</a>
                    </li>
                    <li>
                        <a href="schedule_exam.php" class="block w-full bg-purple-500 text-white py-3 px-4 rounded-lg hover:bg-purple-700 transition duration-300">Schedule Exams</a>
                    </li>
                    <li>
                        <a href="upload_results.php" class="block w-full bg-purple-500 text-white py-3 px-4 rounded-lg hover:bg-purple-700 transition duration-300">Upload Results</a>
                    </li>
                    <li>
                        <a href="logout.php" class="block w-full bg-red-500 text-white py-3 px-4 rounded-lg hover:bg-red-700 transition duration-300">Logout</a>
                    </li>
                </ul>
            </div>

        </div>
    </main>

    <!-- Footer at the very bottom -->
    <footer class="bg-gray-800 text-white text-center py-2 w-full mt-auto">
        &copy; 2025 Gorli Laxmi
    </footer>

</body>
</html>
