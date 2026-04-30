<?php
session_start();

if (!isset($_SESSION['userid']) || $_SESSION['role'] != 2) {
    header("Location: ../login.php");
    exit();
}

include("../includes/connection.php");
include("../admin/functions.php");

$page = $_GET['page'] ?? 'courses';

$allowedPages = ['students_of_myclasses', 'students_of_mycoursses', 'courses'];
?>

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f8fafc] font-sans antialiased">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include("../includes/asside-prof.php"); ?>

    <div class="flex-1">

        <!-- Header -->
        <?php include("../includes/header-prof.php"); ?>

        <!-- Dynamic Content -->
        <main class="p-10">

            <?php
            if (in_array($page, $allowedPages)) {
                include "prof/prof-" .$page . ".php";
            } else {
                echo "<h1>Page not found</h1>";
            }
            ?>

        </main>

    </div>

</div>

</body>
</html>
