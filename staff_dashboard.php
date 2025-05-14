<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold fixed top-0 left-0">Examination Cell Automation System</header>
    <div class="flex-grow flex flex-col items-center justify-center mt-20 mb-20">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-2xl flex items-center">
            <img src="staff.jpg" alt="Staff Image" class="w-40 h-40 object-cover rounded-lg shadow-lg mr-6">
            <div class="text-center flex-1">
                <h2 class="text-2xl font-bold text-gray-700 mb-6">Welcome, Staff</h2>
                <ul class="space-y-4">
                    <li>
                        <a href="view_exam_schedule.php" class="block w-full bg-purple-500 text-white py-3 px-4 rounded-lg hover:bg-purple-700 transition duration-300">View Exam Schedule</a>
                    </li>
                    <li>
                        <a href="view_room_allocations_staff.php" class="block w-full bg-purple-500 text-white py-3 px-4 rounded-lg hover:bg-purple-700 transition duration-300">View Room Allocations</a>
                    </li>
                    <li>
                        <a href="logout.php" class="block bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white text-center py-2 w-full fixed bottom-0 left-0">&copy; 2025 Hari Jakku</footer>
</body>
</html>
