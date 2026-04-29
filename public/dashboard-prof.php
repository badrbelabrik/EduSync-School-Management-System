<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != 2) {
    echo "unauthorized access";
    exit();
}

include("../includes/connection.php");
include("../includes/functions.php");
include("../prof/functions.php");
$profcourses=getProfcourses($conn);
$studentbyprof=getstundentsbyprof($conn);



?>
 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EduSync Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white p-6">
            <h1 class="text-2xl font-bold mb-10">EduSync</h1>

            <nav class="space-y-4">
                <a href="dashboard.php" class="block bg-blue-500 px-4 py-3 rounded-lg font-medium">
                    Dashboard
                </a>

                <a href="#" class="block px-4 py-3 rounded-lg hover:bg-blue-800 transition">
                    Students
                </a>

                <a href="#" class="block px-4 py-3 rounded-lg hover:bg-blue-800 transition">
                    Presence
                </a>

                <a href="#" class="block px-4 py-3 rounded-lg hover:bg-blue-800 transition">
                    History
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">

            <!-- Topbar -->
            <header class="bg-blue-900 text-white px-8 py-5 flex justify-end items-center">
                <div class="flex items-center gap-4">
                    <span>
                        <?php echo htmlspecialchars($_SESSION['firstname'] ?? 'User'); ?>
                    </span>

                    <a href="../scripts/logout.php" class="bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700">
                        Log out
                    </a>
                </div>
            </header>

            <!-- Content -->
<table border="1">
<tr>
<th>Nom étudiant</th>
<th>Cours</th>
<th>Description</th>
<th>Status</th>
</tr>

<?php foreach($studentbyprof as $etu): ?>
    
<tr>
<td><?= $etu['nom_etu']; ?></td>
<td><?= $etu['nom_cours']; ?></td>
<td><?= $etu['cour_des']; ?></td>
<td><?= $etu['status']; ?></td>
</tr>
<?php endforeach; ?>

</table>

</table>
        

                <!-- Table -->
                <div class="bg-blue-900 rounded-xl overflow-hidden shadow mt-[30px]">
                    <table class="w-full text-white">
<thead class="bg-blue-950">
<tr>
<th class="text-left p-5">Course Name</th>
<th class="text-left p-5">Description</th>
<th class="text-left p-5">total hour</th>
<th class="text-left p-5">Actions</th>
</tr>
</thead>

                      <tbody>
<?php foreach($profcourses as $course): ?>
<tr class="border-t border-blue-800">
    <td class="p-5"><?php echo  $course['title']; ?></td>
    <td class="p-5"><?php echo  $course['description']; ?></td>
    <td class="p-5"><?php echo $course['total_hours']; ?></td>

    <td class="p-5 space-x-3">
        <a>View</a>
        <a>Edit</a>
        <a>Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
                    </table>
                </div>

            </section>

        </main>

    </div>

</body>

</html>