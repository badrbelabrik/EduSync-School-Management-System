<?php 
session_start();
include '../includes/header.php'; ?>
<main class="flex flex-col items-center justify-center text-center px-6 py-16">

    <!-- Hero Section -->
    <h1 class="text-4xl font-bold text-gray-800 mb-4">
        Welcome to EduSync
    </h1>

    <p class="text-gray-600 max-w-xl mb-6">
        EduSync is a simple platform that helps you manage your learning experience. 
        Register, log in, and access your personalized dashboard.
    </p>
    <?php     
    if(!isset($_SESSION["username"])){
        echo   '<div class="flex space-x-4 mb-12">
        <a href="register.php" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
            Get Started
        </a>
        <a href="login.php" class="border border-blue-600 text-blue-600 px-6 py-2 rounded-lg hover:bg-blue-50 transition">
            Login
        </a>
    </div>';
    }
    

    ?>


    <!-- Features Section -->
    <div class="grid md:grid-cols-3 gap-6 max-w-5xl">
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-2">Secure Authentication</h3>
            <p class="text-gray-600 text-sm">
                Your data is protected with password hashing and session management.
            </p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-2">User Dashboard</h3>
            <p class="text-gray-600 text-sm">
                Access your personal dashboard after logging in.
            </p>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-2">Easy to Use</h3>
            <p class="text-gray-600 text-sm">
                Simple and clean interface for a smooth user experience.
            </p>
        </div>

    </div>

</main>
<?php include '../includes/footer.php'; ?>