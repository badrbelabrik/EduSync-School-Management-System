<?php
$teachers = getTeachers($conn);
$courses = getCoursesWithTeachers($conn);
?>

<h2 class="text-3xl font-bold mb-6">Courses</h2>

<!-- Form -->
<form method="POST" action="admin-courses.php" class="mb-6 space-y-4">

    <input type="text" name="name" placeholder="Course Name" class="p-3 w-full border rounded">

    <input type="number" name="hours" placeholder="Hours" class="p-3 w-full border rounded">

    <select name="teacher_id" class="p-3 w-full border rounded">
        <?php foreach($teachers as $t): ?>
            <option value="<?= $t['id'] ?>">
                <?= $t['firstName'] . ' ' . $t['lasttName'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button class="bg-blue-900 text-white px-4 py-2 rounded">
        Add Course
    </button>
</form>

<!-- Table -->
<table class="w-full bg-blue-900 text-white rounded">
    <thead>
        <tr>
            <th class="p-4">Course</th>
            <th class="p-4">Teacher</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($courses as $c): ?>
            <tr>
                <td class="p-4"><?= $c['name'] ?></td>
                <td class="p-4"><?= $c['firstName'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>