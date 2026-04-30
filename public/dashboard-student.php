<?php
session_start();

if (!isset($_SESSION['userid']) || $_SESSION['role'] != 3) {
    header("Location: ../login.php");
    exit();
}

include("../includes/connection.php");
include("../admin/functions.php");

$page = $_GET['page'] ?? 'profil';

$allowedPages = ['mesCamarades', 'mesCours', 'profil', 'metiers'];
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f8fafc] font-sans antialiased">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include("../includes/sidebar-student.php"); ?>

    <div class="flex-1">

        <!-- Header -->
        <?php include("../includes/header-student.php"); ?>

        <!-- Dynamic Content -->
        <main class="p-10">

            <?php
            if (in_array($page, $allowedPages)) {
                include "student/student-" .$page . ".php";
            } else {
                echo "<h1>Page not found</h1>";
            }
            ?>

        </main>

    </div>

</div>

</body>
</html>