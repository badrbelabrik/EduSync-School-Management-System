<?php
session_start();
define('BASE_URL', '/School-Management-System/public/');
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
$users = getUsers($conn);
$classes = getClasses($conn);
$courses = getCourses($conn);
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
                <a href="dashboard-admin.php" class="block hover:bg-blue-800 px-4 py-3 rounded-lg font-medium">
                    Dashboard
                </a>
                
                <a href="admin-users.php" class="block bg-blue-500 px-4 py-3 rounded-lg font-medium">
                    Users
                </a>

                <a href="admin-courses.php" class="block px-4 py-3 rounded-lg hover:bg-blue-800 transition">
                    Courses
                </a>

                <a href="admin-classes.php" class="block px-4 py-3 rounded-lg hover:bg-blue-800 transition">
                    Classes
                </a>

                <a href="admin-enrollments.php" class="block px-4 py-3 rounded-lg hover:bg-blue-800 transition">
                    Enrollments
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
            <section class="p-10">

                <h2 class="text-4xl font-bold text-gray-900 mb-8">
                    Gestion des étudiants
                </h2>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

                    <div class="bg-blue-900 text-white rounded-lg p-8 shadow">
                        <h3 class="text-3xl font-bold mb-4">Total Étudiants</h3>
                        <p class="text-4xl font-bold">20</p>
                    </div>

                    <div class="bg-blue-900 text-white rounded-lg p-8 shadow">
                        <h3 class="text-3xl font-bold mb-4">Étudiants Actifs</h3>
                        <p class="text-4xl font-bold">16</p>
                    </div>

                    <div class="bg-blue-900 text-white rounded-lg p-8 shadow">
                        <h3 class="text-3xl font-bold mb-4">Étudiants Inactifs</h3>
                        <p class="text-4xl font-bold">4</p>
                    </div>

                </div>

                <!-- Search + Button -->
                <div class="flex justify-between items-center mb-6">
                    <div class="bg-blue-950 text-white rounded-lg px-5 py-4 w-72">
                        <input
                            type="text"
                            placeholder="Rechercher"
                            class="bg-transparent outline-none placeholder-gray-300 w-full">
                    </div>

                    <a href="#" class="bg-blue-950 text-white px-6 py-4 rounded-lg hover:bg-blue-800 transition">
                        + Ajouter un étudiant
                    </a>
                </div>

                <!-- Table -->
                <div class="bg-blue-900 rounded-xl overflow-hidden shadow">
                    <table class="w-full text-white">
                        <thead class="bg-blue-950">
                            <tr>
                                <th class="text-left p-5">Nom</th>
                                <th class="text-left p-5">Prénom</th>
                                <th class="text-left p-5">Email</th>
                                <th class="text-left p-5">Group</th>
                                <th class="text-left p-5">Statut</th>
                                <th class="text-left p-5">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr class="border-t border-blue-800">
                                    <td class="p-5"><?php echo $user['firstname']; ?></td>
                                    <td class="p-5"><?php echo $user['lastname']; ?></td>
                                    <td class="p-5"><?php echo $user['email']; ?></td>
                                    <td class="p-5"><?php echo $user['class']; ?></td>

                                    <td class="p-5">
                                        <span class="bg-green-500 px-4 py-1 rounded-full">Active</span>
                                    </td>

                                    <td class="p-5 space-x-3">
                                        <a href="#">Edit</a>

                                        <form action="../scripts/deleteUser.php" method="POST" class="inline">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                            <button type="submit" name="delete-user">Delete</button>
                                        </form>
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