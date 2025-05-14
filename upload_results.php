<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_results'])) {
    $students = $_POST['student_id'];
    $subjects = $_POST['subject'];
    $marks = $_POST['marks'];

    foreach ($students as $student_index => $student_id) {
        if (!empty($student_id)) {
            foreach ($subjects[$student_index] as $subject_index => $subject) {
                $mark = $marks[$student_index][$subject_index];

                // Prepare and execute the query to insert data
                $stmt = $conn->prepare("INSERT INTO results (student_id, subject, marks) VALUES (?, ?, ?)");
                $stmt->bind_param("ssi", $student_id, $subject, $mark);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    echo "<script>alert('Results uploaded successfully'); window.location='upload_results.php';</script>";
}

// Handle clearing student results
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['clear_results'])) {
    $student_id_clear = $_POST['student_id_clear'];

    if (!empty($student_id_clear)) {
        $stmt = $conn->prepare("DELETE FROM results WHERE student_id = ?");
        $stmt->bind_param("s", $student_id_clear);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('Results cleared successfully!'); window.location='upload_results.php';</script>";
    } else {
        echo "<p>Error: Invalid student ID.</p>";
    }
}

// Fetch students with results
$students_query = "SELECT DISTINCT student_id FROM results ORDER BY student_id";
$students_result = $conn->query($students_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Results</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        function addStudentField() {
            let container = document.getElementById("studentsContainer");
            let studentIndex = container.children.length;
            let newStudent = document.createElement("div");
            newStudent.classList.add("student-entry", "border-t", "pt-4", "mt-4", "space-y-4");
            newStudent.innerHTML = `
                <label class="block text-gray-700">Student ID:</label>
                <input type="text" name="student_id[]" required class="w-full p-2 border rounded">

                <div class="subjectsContainer space-y-2" id="subjectsContainer_${studentIndex}">
                    <input type="text" name="subject[${studentIndex}][]" placeholder="Subject" required class="w-full p-2 border rounded">
                    <input type="number" name="marks[${studentIndex}][]" placeholder="Marks" required class="w-full p-2 border rounded">
                    <button type="button" onclick="addSubjectField(${studentIndex})" class="bg-green-500 text-white py-1 px-2 rounded-lg hover:bg-green-600 transition duration-300">Add Subject</button>
                </div>
            `;
            container.appendChild(newStudent);
        }

        function addSubjectField(studentIndex) {
            let subjectContainer = document.getElementById(`subjectsContainer_${studentIndex}`);
            let newSubject = document.createElement("div");
            newSubject.classList.add("flex", "space-x-2", "mt-2");
            newSubject.innerHTML = `
                <input type="text" name="subject[${studentIndex}][]" placeholder="Subject" required class="w-full p-2 border rounded">
                <input type="number" name="marks[${studentIndex}][]" placeholder="Marks" required class="w-full p-2 border rounded">
                <button type="button" onclick="this.parentElement.remove()" class="bg-red-500 text-white py-1 px-2 rounded-lg hover:bg-red-600 transition duration-300">Remove</button>
            `;
            subjectContainer.appendChild(newSubject);
        }
    </script>
</head>
<body class="bg-blue-200 flex flex-col min-h-screen">
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold fixed top-0 left-0">Exam Cell Automation System</header>
    <div class="flex-grow flex flex-col items-center justify-center mt-20 mb-20">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-4xl">
            <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Upload Results</h2>
            <form method="POST" class="space-y-4">
                <div id="studentsContainer" class="space-y-4">
                    <div class="student-entry">
                        <label class="block text-gray-700">Student ID:</label>
                        <input type="text" name="student_id[]" required class="w-full p-2 border rounded">

                        <div class="subjectsContainer space-y-2" id="subjectsContainer_0">
                            <input type="text" name="subject[0][]" placeholder="Subject" required class="w-full p-2 border rounded">
                            <input type="number" name="marks[0][]" placeholder="Marks" required class="w-full p-2 border rounded">
                            <button type="button" onclick="addSubjectField(0)" class="bg-green-500 text-white py-1 px-2 rounded-lg hover:bg-green-600 transition duration-300">Add Subject</button>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addStudentField()" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Add Student</button>
                <button type="reset" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Clear</button>
                <button type="submit" name="upload_results" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition duration-300">Upload Results</button>
            </form>

            <h2 class="text-2xl font-bold text-gray-700 text-center mt-8">Clear Student Results</h2>
            <form method="POST" class="space-y-4">
                <label class="block text-gray-700">Select Student ID:</label>
                <select name="student_id_clear" required class="w-full p-2 border rounded">
                    <option value="">Select Student</option>
                    <?php 
                    $students_result->data_seek(0);
                    while ($student = $students_result->fetch_assoc()) { ?>
                        <option value="<?= htmlspecialchars($student['student_id']) ?>">
                            <?= htmlspecialchars($student['student_id']) ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit" name="clear_results" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300">Clear Results</button>
            </form>

            <div class="text-center mt-6">
                <a href="admin_dashboard.php" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">Back to Admin Dashboard</a>
            </div>
        </div>
    </div>
    <footer class="bg-gray-800 text-white text-center py-2 w-full fixed bottom-0 left-0">&copy; 2025 Gorli Laxmi</footer>
</body>
</html>

</html>
