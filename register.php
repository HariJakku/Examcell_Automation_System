<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    if ($role == 'admin') {
        $email = $_POST['email'];
        $query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'admin')";
    } else {
        $user_id = $_POST['user_id'];
        $query = "INSERT INTO users (name, user_id, password, role) VALUES ('$name', '$user_id', '$password', '$role')";
    }

    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Examination Cell</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 flex flex-col items-center justify-center min-h-screen">
<header class="bg-blue-600 text-white text-center py-4 w-full text-xl font-bold">Examination Cell Automation System</header>
   
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-6">
        
        <!-- Registration Form -->
        <div class="w-full md:w-1/2">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6"> Registration Page</h2>
            <form method="POST" class="space-y-4">

                <!-- Name Field -->
                <div>
                    <label class="block text-gray-600 font-medium">Name:</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Role Selection -->
                <div>
                    <label class="block text-gray-600 font-medium">Role:</label>
                    <select name="role" id="role" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="student">Student</option>
                    </select>
                </div>

                <!-- Admin Fields -->
                <div id="admin_fields" class="hidden">
                    <label class="block text-gray-600 font-medium">Email:</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- User Fields -->
                <div id="user_fields" class="hidden">
                    <label class="block text-gray-600 font-medium">User ID:</label>
                    <input type="text" name="user_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-gray-600 font-medium">Password:</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition duration-300">
                    Register Here
                </button>
            </form>
        </div>
       
        <!-- Image Section -->
        <div class="w-full md:w-1/2 flex justify-center">
            <img alt="Person using a tablet for automation" class="w-full max-w-sm rounded-lg shadow-md" height="200" src="reg.jpg" width="300"/>
        </div>
        
    </div>
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
