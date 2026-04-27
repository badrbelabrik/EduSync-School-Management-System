<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-4">
    <header class="flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <span class="text-2xl font-bold text-blue-600">EduSync</span>
    </div> <!-- Navigation -->
    <nav class="flex items-center space-x-6 text-gray-700 font-medium">
        <a href="index.php" class="hover:text-blue-600 transition">Home</a>
        <a href="#" class="hover:text-blue-600 transition">About us</a>
        <a href="#" class="hover:text-blue-600 transition">Contact</a>
    </nav> <!-- CTA Button -->
    <div>
        <?php 
            if(isset($_SESSION["username"])){
                echo '
                <div class="flex gap-2 items-center">
                    <a href="../public/dashboard.php" class="text-blue-500"> '.$_SESSION["email"].' </a>
                    <a href="../scripts/logout.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"> Log out </a>
                </div>';
            } else {
                echo '<a href="../public/login.php" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"> Login </a>';
            }
        ?>
        
    </div>
    </header>