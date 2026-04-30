<?php
require_once(__DIR__ . "/../../includes/connection.php");
require_once(__DIR__ . "/../../admin/functions.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $hours = $_POST['total_hours'];
    $teacher = $_POST['id_prof'];

    if (!empty($title) && !empty($hours) && !empty($teacher)) {
        addCourse($conn, $title, $description, $hours, $teacher);
        header("Location: dashboard-admin.php?page=courses");
        exit();
    }
}
$teachers = getTeachers($conn);
$courses = getCoursesWithTeachers($conn);
?>

<div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Courses Management</h1>
    <button onclick="openModal()" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-xl transition-all shadow-md active:scale-95">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        Add Course
    </button>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 uppercase text-xs font-bold tracking-wider">
            <tr>
                <th class="px-6 py-4">Course Title</th>
                <th class="px-6 py-4 text-center">Duration</th>
                <th class="px-6 py-4">Teacher</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($courses as $c): ?>
            <tr class="hover:bg-blue-50/30 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-700"><?= $c['title']; ?></td>
                <td class="px-6 py-4 text-center">
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                        <?= $c['total_hours']; ?> Hours
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-600 font-medium italic">
                    <?= $c['firstname'] . ' ' . $c['lastname']; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="modal" class="hidden fixed inset-0 z-50 overflow-auto bg-gray-900/60 backdrop-blur-sm flex justify-center items-center p-4">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Create New Course</h2>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                <input type="text" name="title" placeholder="e.g. Master React JS" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Total Hours</label>
                <input type="number" name="total_hours" placeholder="40" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" placeholder="Describe the course content..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Assign Teacher</label>
                <select name="id_prof" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all bg-white">
                    <option value="">Choose Teacher</option>
                    <?php foreach ($teachers as $t): ?>
                      <option value="<?= $t['id']; ?>"><?= $t['firstname'] . ' ' . $t['lastname']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-green-200 transition-all active:scale-95">Save Course</button>
                <button type="button" onclick="closeModal()" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition-all">Cancel</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
function openModal(){ document.getElementById("modal").classList.remove("hidden"); }
function closeModal(){ document.getElementById("modal").classList.add("hidden"); }
</script>