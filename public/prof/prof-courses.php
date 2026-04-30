<?php

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



?>
 




    <script src="https://cdn.tailwindcss.com"></script>

        
<div class="container mx-auto p-6">
    <div class="overflow-hidden shadow-md sm:rounded-lg border border-gray-200">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-4 font-bold">Course Name</th>
                    <th scope="col" class="px-6 py-4 font-bold">Description</th>
                    <th scope="col" class="px-6 py-4 font-bold">Total Hours</th>
                </tr>
            </thead>
            
            <tbody class="divide-y divide-gray-100">
                <?php foreach($profcourses as $course): ?>
                <tr class="bg-white hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-gray-900">
                        <?= htmlspecialchars($course['title']); ?>
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        <?= htmlspecialchars($course['description']); ?>
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-medium border border-blue-100">
                            <?= htmlspecialchars($course['total_hours']); ?>h
                        </span>
                    </td>
      
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>