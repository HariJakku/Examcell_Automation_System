<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch exams with room numbers
$query = "SELECT exams.*, rooms.room_no 
          FROM exams 
          JOIN rooms ON exams.room_id = rooms.room_id 
          ORDER BY exams.exam_date, exams.exam_time";
$result = $conn->query($query);

// Check for SQL errors
if (!$result) {
    die("Error fetching exams: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Schedule</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold fixed top-0 left-0">Examination Cell Automation System</header>
    <div class="flex-grow flex flex-col items-center justify-center mt-20 mb-20">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-3xl">
            <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Exam Schedule</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="border border-gray-300 px-4 py-2">Subject</th>
                        <th class="border border-gray-300 px-4 py-2">Date</th>
                        <th class="border border-gray-300 px-4 py-2">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $row_count = 0; ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr class="<?php echo $row_count % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200'; ?> text-gray-700">
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['subject']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['exam_date']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['exam_time']) ?></td>
                        </tr>
                        <?php $row_count++; ?>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-center mt-6">
                <a href="<?= $_SESSION['role'] == 'student' ? 'student_dashboard.php' : 'staff_dashboard.php' ?>" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Back</a>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white text-center py-2 w-full fixed bottom-0 left-0">&copy; 2025 Gorli Laxmi</footer>
</body>
</html>
