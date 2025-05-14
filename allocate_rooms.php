<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Function to get the next unallocated student
function getNextStudentId($conn) {
    $query = "SELECT id FROM users WHERE role = 'student' AND id NOT IN (SELECT student_id FROM room_allocations) ORDER BY id ASC LIMIT 1";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['id'];
    }
    return null;
}

// Fetch available invigilators
$invigilatorsQuery = "SELECT id, name FROM users WHERE role = 'staff'";
$invigilatorsResult = $conn->query($invigilatorsQuery);

// Handle room allocation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['allocate_rooms'])) {
    $room_numbers = $_POST['room_no'];
    $capacities = $_POST['capacity'];
    $invigilator_1s = $_POST['invigilator_1'];
    $invigilator_2s = $_POST['invigilator_2'];
    $exam_dates = $_POST['exam_date'];
    $exam_times = $_POST['exam_time'];

    if (!empty($room_numbers)) {
        $stmt = $conn->prepare("INSERT INTO rooms (room_no, capacity, invigilator1_id, invigilator2_id, exam_date, exam_time) VALUES (?, ?, ?, ?, ?, ?)");

        for ($i = 0; $i < count($room_numbers); $i++) {
            if (!empty($room_numbers[$i]) && $capacities[$i] > 0) {
                $stmt->bind_param("siisss", $room_numbers[$i], $capacities[$i], $invigilator_1s[$i], $invigilator_2s[$i], $exam_dates[$i], $exam_times[$i]);
                $stmt->execute();
                $room_id = $stmt->insert_id;  // Get the inserted room ID

                // Allocate students
                $student_id = getNextStudentId($conn);
                $allocated_students = 0;

                while ($student_id && $allocated_students < $capacities[$i]) {
                    $allocStmt = $conn->prepare("INSERT INTO room_allocations (room_id, student_id) VALUES (?, ?)");
                    $allocStmt->bind_param("ii", $room_id, $student_id);
                    $allocStmt->execute();
                    $allocStmt->close();
                    $allocated_students++;
                    $student_id = getNextStudentId($conn);
                }
            }
        }
        $stmt->close();
        echo "<script>alert('Rooms allocated successfully!'); window.location='room_allocation.php';</script>";
    }
}

// Handle clearing room allocations
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['clear_allocations'])) {
    $room_no = $_POST['room_no_clear'];

    if ($room_no) {
        // Delete allocations for the specified room
        $stmt = $conn->prepare("DELETE FROM room_allocations WHERE room_id = (SELECT room_id FROM rooms WHERE room_no = ?)");
        $stmt->bind_param("s", $room_no);
        $stmt->execute();
        $stmt->close();

        echo "<p>Allocations for Room $room_no cleared.</p>";
    }
}

// Fetch allocated rooms
$roomsQuery = "SELECT room_no FROM rooms";
$roomsResult = $conn->query($roomsQuery);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Room Allocations</title>
    <script>
function addRoomField() {
    let container = document.getElementById("room-container");

    let newRoom = document.createElement("div");
    newRoom.classList.add("space-y-4", "mt-4");

    newRoom.innerHTML = `
        <label class="block text-gray-700">Room Number:</label>
        <input type="text" name="room_no[]" required class="w-full p-2 border rounded">

        <label class="block text-gray-700">Room Capacity:</label>
        <input type="number" name="capacity[]" min="1" required class="w-full p-2 border rounded">

        <label class="block text-gray-700">Exam Date:</label>
        <input type="date" name="exam_date[]" required class="w-full p-2 border rounded">

        <label class="block text-gray-700">Exam Time:</label>
        <input type="time" name="exam_time[]" required class="w-full p-2 border rounded">

        <label class="block text-gray-700">Invigilator 1:</label>
        <select name="invigilator_1[]" required class="w-full p-2 border rounded">
            <option value="">Select Invigilator 1</option>
            <?php 
            $invigilatorsResult->data_seek(0);
            while ($row = $invigilatorsResult->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label class="block text-gray-700">Invigilator 2:</label>
        <select name="invigilator_2[]" required class="w-full p-2 border rounded">
            <option value="">Select Invigilator 2</option>
            <?php 
            $invigilatorsResult->data_seek(0);
            while ($row = $invigilatorsResult->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php endwhile; ?>
        </select>

        <button type="button" onclick="removeRoomField(this)" class="bg-red-500 text-white py-1 px-3 rounded-lg hover:bg-red-600 transition duration-300">Remove</button>
    `;

    container.appendChild(newRoom);
}

function removeRoomField(button) {
    button.parentElement.remove();
}
</script>

</head>
<body class="bg-blue-200 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold fixed top-0 left-0">Examination Cell Automation System</header>
    <div class="flex-grow flex flex-col items-center justify-center mt-20 mb-20">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Allocate Multiple Rooms</h2>
            <form method="post" class="space-y-4">
                <div id="room-container">
                    <div class="space-y-4">
                        <label class="block text-gray-700">Room Number:</label>
                        <input type="text" name="room_no[]" required class="w-full p-2 border rounded">

                        <label class="block text-gray-700">Room Capacity:</label>
                        <input type="number" name="capacity[]" min="1" required class="w-full p-2 border rounded">

                        <label class="block text-gray-700">Exam Date:</label>
                        <input type="date" name="exam_date[]" required class="w-full p-2 border rounded">

                        <label class="block text-gray-700">Exam Time:</label>
                        <input type="time" name="exam_time[]" required class="w-full p-2 border rounded">

                        <label class="block text-gray-700">Invigilator 1:</label>
                        <select name="invigilator_1[]" required class="w-full p-2 border rounded">
                            <option value="">Select Invigilator 1</option>
                            <?php 
                            $invigilatorsResult->data_seek(0);
                            while ($row = $invigilatorsResult->fetch_assoc()): ?>
                                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                            <?php endwhile; ?>
                        </select>

                        <label class="block text-gray-700">Invigilator 2:</label>
                        <select name="invigilator_2[]" required class="w-full p-2 border rounded">
                            <option value="">Select Invigilator 2</option>
                            <?php 
                            $invigilatorsResult->data_seek(0);
                            while ($row = $invigilatorsResult->fetch_assoc()): ?>
                                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <button type="button" onclick="addRoomField()" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">Add Another Room</button>
                <button type="submit" name="allocate_rooms" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Allocate Rooms</button>
            </form>

            <h2 class="text-2xl font-bold text-gray-700 text-center mt-8">Clear Room Allocations</h2>
            <form method="post" class="space-y-4">
                <label class="block text-gray-700">Select Room:</label>
                <select name="room_no_clear" required class="w-full p-2 border rounded">
                    <option value="">Select Room</option>
                    <?php while ($room = $roomsResult->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($room['room_no']) ?>">
                            <?= htmlspecialchars($room['room_no']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="clear_allocations" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Clear Allocations</button>
            </form>
            <div class="text-center mt-6">
                <a href="admin_dashboard.php" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Back</a>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white text-center py-2 w-full fixed bottom-0 left-0">&copy; 2025 Gorli Laxmi</footer>
</body>
</html>


