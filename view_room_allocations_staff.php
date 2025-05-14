<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'staff', 'student'])) {
    header("Location: login.php");
    exit();
}

// Fetch and display allocated rooms with invigilators, date, and time
$query = "SELECT r.room_no, 
                 r.exam_date,
                 r.exam_time,
                 MIN(u.user_id) AS roll_start, 
                 MAX(u.user_id) AS roll_end,
                 COALESCE(inv1.name, 'Not Assigned') AS invigilator_1,
                 COALESCE(inv2.name, 'Not Assigned') AS invigilator_2
          FROM room_allocations ra
          JOIN rooms r ON ra.room_id = r.room_id  
          JOIN users u ON ra.student_id = u.id  
          LEFT JOIN users inv1 ON r.invigilator1_id = inv1.id  
          LEFT JOIN users inv2 ON r.invigilator2_id = inv2.id
          GROUP BY r.room_no, r.exam_date, r.exam_time, inv1.name, inv2.name
          ORDER BY r.exam_date, r.exam_time, r.room_no";

$result = $conn->query($query);

if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Allocations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold fixed top-0 left-0">Examination Cell Automation System</header>
    <div class="flex-grow flex flex-col items-center justify-center mt-20 mb-20">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Room Allocations</h2>
            <?php if ($result->num_rows == 0): ?>
                <p class="text-center text-gray-700">No room allocations found!</p>
            <?php else: ?>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="border border-gray-300 px-4 py-2">Room Number</th>
                            <th class="border border-gray-300 px-4 py-2">Exam Date</th>
                            <th class="border border-gray-300 px-4 py-2">Exam Time</th>
                            <th class="border border-gray-300 px-4 py-2">Roll Start</th>
                            <th class="border border-gray-300 px-4 py-2">Roll End</th>
                            <th class="border border-gray-300 px-4 py-2">Invigilator 1</th>
                            <th class="border border-gray-300 px-4 py-2">Invigilator 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $row_count = 0; ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="<?php echo $row_count % 2 == 0 ? 'bg-gray-100' : 'bg-gray-200'; ?> text-gray-700">
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['room_no']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['exam_date']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['exam_time']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['roll_start']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['roll_end']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['invigilator_1']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['invigilator_2']) ?></td>
                            </tr>
                            <?php $row_count++; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <div class="text-center mt-6">
                <a href="staff_dashboard.php" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Back</a>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white text-center py-2 w-full fixed bottom-0 left-0">&copy; 2025 Hari Jakku</footer>
</body>
</html>
