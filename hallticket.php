<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT name, user_id FROM users WHERE id = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No student found with this ID.");
}

$student = $result->fetch_assoc();
$stmt->close();

$examQuery = "SELECT subject, exam_date, exam_time FROM exams ORDER BY RAND() LIMIT 5";
$examResult = $conn->query($examQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Ticket (Sample)</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 flex flex-col min-h-screen items-center">
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold">Examination Cell Automation System</header>
    <div class="flex flex-col items-center justify-center mt-10 mb-10 w-full max-w-4xl bg-white p-10 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Hall Ticket (Sample)</h2>
        <div class="text-gray-700 text-lg mb-6">
            <p><strong>Student Name:</strong> <?= htmlspecialchars($student['name']) ?></p>
            <p><strong>Roll Number:</strong> <?= htmlspecialchars($student['user_id']) ?></p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Exam Schedule</h3>
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 px-4 py-2">Subject</th>
                    <th class="border border-gray-300 px-4 py-2">Exam Date</th>
                    <th class="border border-gray-300 px-4 py-2">Time</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $examResult->fetch_assoc()): ?>
                <tr class="bg-gray-100 text-gray-700">
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['subject']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['exam_date']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['exam_time']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <br>
        <a href="student_dashboard.php" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Back</a>
    </div>
    <footer class="bg-gray-800 text-white text-center py-2 w-full mt-auto">&copy; 2025 Gorli Laxmi</footer>
</body>
</html>
