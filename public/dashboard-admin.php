<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
if($_SESSION['role'] != 1){
    echo "unauthorized access";
    exit();
}

include("../includes/connection.php");
include("../admin/functions.php");

$page = $_GET['page'] ?? 'users';

$allowedPages = ['users', 'courses', 'enrollments', 'stats', 'classes'];
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include("../includes/sidebar-admin.php"); ?>

    <div class="flex-1">

        <!-- Header -->
        <?php include("../includes/header-admin.php"); ?>

        <!-- Dynamic Content -->
        <main class="p-10">

            <?php
            if (in_array($page, $allowedPages)) {
                include './admin/admin-'.$page . ".php";
            } else {
                echo "<h1>Page not found</h1>";
            }
            ?>

        </main>

    </div>

</div>

</body>
</html>