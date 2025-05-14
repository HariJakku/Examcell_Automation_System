<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'staff')) {
    header("Location: login.php");
    exit();
}

// Fetch exams with invigilators
$query = "SELECT exams.*, u1.name AS invigilator1_name, u2.name AS invigilator2_name 
          FROM exams 
          JOIN users u1 ON exams.invigilator1 = u1.id
          JOIN users u2 ON exams.invigilator2 = u2.id
          ORDER BY exam_date, exam_time";
$result = $conn->query($query);
?>

<h2>Assigned Invigilators</h2>
<table border="1">
    <tr>
        <th>Subject</th>
        <th>Date</th>
        <th>Time</th>
        <th>Invigilator 1</th>
        <th>Invigilator 2</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['subject'] ?></td>
            <td><?= $row['exam_date'] ?></td>
            <td><?= $row['exam_time'] ?></td>
            <td><?= $row['invigilator1_name'] ?></td>
            <td><?= $row['invigilator2_name'] ?></td>
        </tr>
    <?php } ?>
</table>
<a href="<?= $_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'staff_dashboard.php' ?>">Back</a>
