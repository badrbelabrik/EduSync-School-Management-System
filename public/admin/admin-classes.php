<?php
define('BASE_URL', '/School-Management-System/public/');
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
if($_SESSION['role'] != 1){
    echo "unauthorized access";
    exit();
}


$classes = getClasses($conn);
?>



            <section class="p-10">

                <h2 class="text-4xl font-bold text-gray-900 mb-8">
                    Gestion des classes
                </h2>

                <!-- Search + Button -->
                <div class="flex justify-between items-center mb-6">
                    <div class="bg-blue-950 text-white rounded-lg px-5 py-4 w-72">
                        <input
                            type="text"
                            placeholder="Rechercher"
                            class="bg-transparent outline-none placeholder-gray-300 w-full">
                    </div>

                    <button onclick="openAddModal()" class="bg-blue-950 text-white px-6 py-4 rounded-lg hover:bg-blue-800 transition">
                        + Add a class
                    </button>
                </div>

                <!-- Table -->
                <div class="bg-blue-900 rounded-xl overflow-hidden shadow">
                    <table class="w-full text-white">
                        <thead class="bg-blue-950">
                            <tr>
                                <th class="text-left p-5">Class name</th>
                                <th class="text-left p-5">Classroom number</th>
                                <th class="text-left p-5">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($classes as $class): ?>
                                <tr class="border-t border-blue-800">
                                    <td class="p-5"><?php echo $class['name']; ?></td>
                                    <td class="p-5"><?php echo $class['classroom_number']; ?></td>

                                    <td class="p-5 space-x-3">
                                        <a href="#"><i class="fa-regular fa-pen-to-square"></i></a>

                                        <form action="../scripts/deleteUser.php" method="POST" class="inline">
                                           <i class="fa-solid fa-trash"></i>
                                            
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
    <?php include('./admin/add-class-modal.php') ?>
            </section>
