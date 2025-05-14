<?php
session_start();
include 'db.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the correct student_id from users table
$query = "SELECT user_id FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->bind_result($student_id);
    $stmt->fetch();
    $stmt->close();
} else {
    die("Error fetching user_id.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold fixed top-0 left-0">Examination Cell Automation System</header>
    <div class="flex-grow flex flex-col items-center justify-center mt-20 mb-20">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Your Results</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="border border-gray-300 px-4 py-2">Student ID</th>
                        <th class="border border-gray-300 px-4 py-2">Subject</th>
                        <th class="border border-gray-300 px-4 py-2">Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Fetch results where student_id matches the retrieved student_id
                    $query = "SELECT * FROM results WHERE student_id = ?";
                    $stmt = $conn->prepare($query);
                    if ($stmt) {
                        $stmt->bind_param("s", $student_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows == 0) {
                            echo "<tr><td colspan='3' class='text-center py-4'>No results found</td></tr>";
                        }
                        
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr class="bg-gray-100 text-gray-700">
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['student_id']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['subject']) ?></td>
                                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['marks']) ?></td>
                            </tr>
                        <?php }
                        $stmt->close();
                    } else {
                        echo "<p class='text-red-500 text-center'>Error: Query preparation failed.</p>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="text-center mt-6">
                <a href="student_dashboard.php" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Back</a>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white text-center py-2 w-full fixed bottom-0 left-0">&copy; 2025 Gorli Laxmi</footer>
</body>
</html>
