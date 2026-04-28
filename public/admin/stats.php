<?php
$totalStudents = countStudents($conn);
$totalCourses = countCourses($conn);
?>

<h2 class="text-3xl font-bold mb-6">Statistics</h2>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-blue-900 text-white p-6 rounded">
        Students: <?= $totalStudents ?>
    </div>

    <div class="bg-blue-900 text-white p-6 rounded">
        Courses: <?= $totalCourses ?>
    </div>

</div>