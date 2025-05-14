<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = "";
$dbname = "exam_cell_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
