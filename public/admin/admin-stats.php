<?php
require_once(__DIR__ . "/../../includes/connection.php");
require_once(__DIR__ . "/../../admin/functions.php");

$totalStudents = countStudents($conn);
$totalCourses = countCourses($conn);
$totalStudentActive = countStudentsActive($conn);
$totalTeachers = countTeachers($conn);

$teachersCourses = coursesPerTeacher($conn);
$coursesStats = studentsPerCourse($conn);
?>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-2xl shadow-lg shadow-blue-200 transition-transform hover:scale-[1.02]">
        <div class="relative z-10">
            <h2 class="text-blue-100 text-sm font-semibold uppercase tracking-wider">Total Students</h2>
            <p class="text-4xl font-bold text-white mt-2"><?= $totalStudents; ?></p>
        </div>
    </div>

    <div class="relative overflow-hidden bg-gradient-to-br from-green-600 to-green-700 p-6 rounded-2xl shadow-lg shadow-green-200 transition-transform hover:scale-[1.02]">
        <div class="relative z-10">
            <h2 class="text-green-100 text-sm font-semibold uppercase tracking-wider">Total Courses</h2>
            <p class="text-4xl font-bold text-white mt-2"><?= $totalCourses; ?></p>
        </div>
    </div>

    <div class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-700 p-6 rounded-2xl shadow-lg shadow-blue-200 transition-transform hover:scale-[1.02]">
        <div class="relative z-10">
            <h2 class="text-blue-100 text-sm font-semibold uppercase tracking-wider">Total Students Active</h2>
            <p class="text-4xl font-bold text-white mt-2"><?= $totalStudentActive; ?></p>
        </div>
    </div>

    <div class="relative overflow-hidden bg-gradient-to-br from-purple-600 to-purple-700 p-6 rounded-2xl shadow-lg shadow-purple-200 transition-transform hover:scale-[1.02]">
        <div class="relative z-10">
            <h2 class="text-purple-100 text-sm font-semibold uppercase tracking-wider">Total Teachers</h2>
            <p class="text-4xl font-bold text-white mt-2"><?= $totalTeachers; ?></p>
        </div>
    </div>

</div>

<div class="bg-white mt-8 p-6 rounded-2xl shadow-sm border border-gray-100">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Courses per Teacher</h2>

    <?php foreach ($teachersCourses as $t): ?>
        <div class="flex justify-between border-b py-2 text-gray-700">
            <span><?= $t['firstname'] . ' ' . $t['lastname']; ?></span>
            <span class="font-bold"><?= $t['total_courses']; ?></span>
        </div>
    <?php endforeach; ?>
</div>

<div class="bg-white mt-8 p-6 rounded-2xl shadow-sm border border-gray-100">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Students per Course</h2>

    <?php foreach ($coursesStats as $c): ?>
        <div class="flex justify-between border-b py-2 text-gray-700">
            <span><?= $c['title']; ?></span>
            <span class="font-bold"><?= $c['total_students']; ?></span>
        </div>
    <?php endforeach; ?>
</div>