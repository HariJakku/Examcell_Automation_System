<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch available rooms
$room_query = "SELECT room_id, room_no FROM rooms";
$room_result = $conn->query($room_query);

// Handle Scheduling Multiple Exams
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['schedule_exam'])) {
    $subjects = $_POST['subjects'];
    $dates = $_POST['dates'];
    $times = $_POST['times'];
    $room_ids = $_POST['room_ids'];

    if (!empty($subjects)) {
        $stmt = $conn->prepare("INSERT INTO exams (subject, exam_date, exam_time, room_id) VALUES (?, ?, ?, ?)");

        for ($i = 0; $i < count($subjects); $i++) {
            if (!empty($subjects[$i]) && !empty($dates[$i]) && !empty($times[$i]) && !empty($room_ids[$i])) {
                $stmt->bind_param("sssi", $subjects[$i], $dates[$i], $times[$i], $room_ids[$i]);
                $stmt->execute();
            }
        }
        $stmt->close();
        echo "<script>alert('Exams Scheduled Successfully!'); window.location='schedule_exam.php';</script>";
    }
}

// Fetch scheduled exams
$exams_query = "SELECT subject FROM exams";
$exams_result = $conn->query($exams_query);
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Exam</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
       function addExamField() {
    let container = document.getElementById("exam-container");
    let newField = document.createElement("div");
    newField.classList.add("space-y-4", "mt-4", "border-t", "pt-4");

    newField.innerHTML = `
        <label class="block text-gray-700">Subject:</label>
        <input type="text" name="subjects[]" required class="w-full p-2 border rounded">

        <label class="block text-gray-700">Date:</label>
        <input type="date" name="dates[]" required class="w-full p-2 border rounded">

        <label class="block text-gray-700">Time:</label>
        <input type="time" name="times[]" required class="w-full p-2 border rounded">

        <label class="block text-gray-700">Select Room:</label>
        <select name="room_ids[]" required class="w-full p-2 border rounded">
            <option value="">Select Room</option>
            ${document.querySelector("select[name='room_ids[]']").innerHTML}
        </select>
    `;

    container.appendChild(newField);
}

    </script>
</head>
<body class="bg-blue-200 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold fixed top-0 left-0">Examination Cell Automation System</header>
    <div class="flex-grow flex flex-col items-center justify-center mt-20 mb-20">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Schedule an Exam</h2>
            <form method="post" action="schedule_exam.php" class="space-y-4">
                <div id="exam-container">
                    <div class="space-y-4">
                        <label class="block text-gray-700">Subject:</label>
                        <input type="text" name="subjects[]" required class="w-full p-2 border rounded">

                        <label class="block text-gray-700">Date:</label>
                        <input type="date" name="dates[]" required class="w-full p-2 border rounded">

                        <label class="block text-gray-700">Time:</label>
                        <input type="time" name="times[]" required class="w-full p-2 border rounded">

                        <label class="block text-gray-700">Select Room:</label>
                        <select name="room_ids[]" required class="w-full p-2 border rounded">
                            <option value="">Select Room</option>
                            <?php 
                            $room_result->data_seek(0);
                            while ($room = $room_result->fetch_assoc()) { ?>
                                <option value="<?= htmlspecialchars($room['room_id']) ?>">
                                    <?= htmlspecialchars($room['room_no']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button type="button" onclick="addExamField()" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">Add Another Subject</button>
                <button type="reset" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Clear</button>
                <button type="submit" name="schedule_exam" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Schedule Exam</button>
            </form>
            
            <h2 class="text-2xl font-bold text-gray-700 text-center mt-8">Clear Exam</h2>
            <form method="post" action="schedule_exam.php" class="space-y-4">
                <label class="block text-gray-700">Select Subject:</label>
                <select name="subject_clear" required class="w-full p-2 border rounded">
                    <option value="">Select Subject</option>
                    <?php while ($exam = $exams_result->fetch_assoc()) { ?>
                        <option value="<?= htmlspecialchars($exam['subject']) ?>">
                            <?= htmlspecialchars($exam['subject']) ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit" name="clear_exam" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Clear Exam</button>
            </form>
            
            <div class="text-center mt-6">
                <a href="admin_dashboard.php" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Back to Admin Dashboard</a>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white text-center py-2 w-full fixed bottom-0 left-0">&copy; 2025 Gorli Laxmi</footer>
</body>
</html>

</html>
