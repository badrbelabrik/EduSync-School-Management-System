<?php
define('BASE_URL', '/School-Management-System/public/');
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
if ($_SESSION['role'] != 1) {
    echo "unauthorized access";
    exit();
}

$users = getUsers($conn);
$classes = getClasses($conn);
$courses = getCourses($conn);
?>



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

        <button onclick="openModal()" class="bg-blue-950 text-white px-6 py-4 rounded-lg hover:bg-blue-800 transition">
            + Add a user
</button>
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
                    <th class="text-left p-5">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr class="border-t border-blue-800">
                        <td class="p-5"><?php echo $user['firstname']; ?></td>
                        <td class="p-5"><?php echo $user['lastname']; ?></td>
                        <td class="p-5"><?php echo $user['email']; ?></td>
                        <td class="p-5"><?php if($user['id_role'] == 1){
                            echo "<span class='text-red-500'>Admin</span>";
                        } else if($user['id_role'] == 2){
                            echo "<span class='text-green-500'>Teacher</span>";
                        } else{
                            echo "<span class='text-blue-500'>Student</span>";
                        } ; ?></td>

                        <td class="p-5 space-x-3">
                            <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>

                            <form action="../scripts/deleteUser.php" method="POST" class="inline">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" name="delete-user"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include('./admin/addmodal.php')?>
</section>