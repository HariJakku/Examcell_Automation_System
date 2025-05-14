<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $password = $_POST['password'];
    
    if ($role == 'admin') {
        $email = $_POST['email'];
        $query = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    } else {
        $user_id = $_POST['user_id'];
        $query = "SELECT * FROM users WHERE user_id='$user_id' AND role='$role'";
    }
    
    $result = $conn->query($query);
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            
            if ($role == 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($role == 'staff') {
                header("Location: staff_dashboard.php");
            } elseif ($role == 'student') {
                header("Location: student_dashboard.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid credentials'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials'); window.location='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 flex flex-col items-center justify-center min-h-screen">
    <!-- Header -->
    <header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold">Examination Cell Automation System</header>
    
    <div class="bg-white p-8 rounded-lg shadow-lg flex flex-col md:flex-row w-full max-w-4xl mt-6">
        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex items-center justify-center p-4">
            <img src="login.jpg" alt="Login Illustration" class="w-full max-w-sm rounded-lg shadow-md">
        </div>
        
        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-6">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Login Page</h2>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-gray-600 font-medium">Role:</label>
                    <select name="role" id="role" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                
                <div id="admin_fields" class="hidden">
                    <label class="block text-gray-600 font-medium">Email:</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                
                <div id="user_fields" class="hidden">
                    <label class="block text-gray-600 font-medium">User ID:</label>
                    <input type="text" name="user_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                
                <div>
                    <label class="block text-gray-600 font-medium">Password:</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                
                <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition duration-300">Login</button>
            </form>
            
            <div class="text-center mt-4">
                <a href="register.php" class="text-blue-500 hover:underline">New User? Register Here</a>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-2 mt-6 w-full">&copy; 2025 Gorli Laxmi</footer>
    
    <script>
        document.getElementById('role').addEventListener('change', function () {
            if (this.value === 'admin') {
                document.getElementById('admin_fields').classList.remove('hidden');
                document.getElementById('user_fields').classList.add('hidden');
            } else {
                document.getElementById('admin_fields').classList.add('hidden');
                document.getElementById('user_fields').classList.remove('hidden');
            }
        });
        document.getElementById('role').dispatchEvent(new Event('change'));
    </script>
</body>
</html>
