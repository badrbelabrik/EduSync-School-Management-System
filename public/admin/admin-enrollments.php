<?php
$students = getStudents($conn);
$courses = getCourses($conn);
?>

<h2 class="text-3xl font-bold mb-6">Enrollments</h2>

<form method="POST" action="admin-enrollments.php" class="space-y-4">

    <select name="student_id" class="p-3 w-full border rounded">
        <?php foreach($students as $s): ?>
            <option value="<?= $s['id'] ?>">
                <?= $s['firstName'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="course_id" class="p-3 w-full border rounded">
        <?php foreach($courses as $c): ?>
            <option value="<?= $c['id'] ?>">
                <?= $c['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="bg-blue-900 text-white px-4 py-2 rounded">
        Enroll
    </button>

</form>