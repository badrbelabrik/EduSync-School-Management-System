<?php
require_once(__DIR__ . "/../../includes/connection.php");
require_once(__DIR__ . "/../../admin/functions.php");

$students = getStudents($conn);
$courses = getCourses($conn);
$enrollments = getenrollStudent($conn);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = $_POST['student_id'];
    $course = $_POST['course_id'];
    $status = $_POST['status'];

    if (!empty($student) && !empty($course) && !empty($status)) {

        $result = enrollStudent($conn, $status, $student, $course);

        if ($result == "exists") {
            $_SESSION['error'] = "❌ Had student deja kayn f had course";
        } else {
            $_SESSION['success'] = "✅ Enrollment ajouté";
        }

        header("Location: dashboard-admin.php?page=enrollments");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student = $_POST['student_id'];
    $course = $_POST['course_id'];
    $status = $_POST['status'];

    if (!empty($student) && !empty($course) && !empty($status)) {
        enrollStudent($conn, $status, $student, $course);
        header("Location: dashboard-admin.php?page=enrollments");
        exit();
    }
}
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-4">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Enroll Student</h2>
            <?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <?= $_SESSION['error']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        <?= $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Student</label>
                    <select name="student_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all bg-white">
                      <option value="">Choose Student</option>
                      <?php foreach ($students as $s): ?>
                        <option value="<?= $s['id']; ?>"><?= $s['firstname'] . ' ' . $s['lastname']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Course</label>
                    <select name="course_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all bg-white">
                      <option value="">Choose Course</option>
                      <?php foreach ($courses as $c): ?>
                        <option value="<?= $c['id']; ?>"><?= $c['title']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all bg-white">
                      <option value="">Choose Status</option>
                      <option value="En cours">En cours</option>
                      <option value="Approuvée">Approuvée</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95">
                  Enroll Now
                </button>
            </form>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Enrolled At</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">IDs (S/C)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    <?php foreach ($enrollments as $e): ?>
                    <tr class="hover:bg-gray-50 transition-colors text-gray-600">
                        <td class="px-6 py-4"><?= date('M d, Y', strtotime($e['enrolled_at'])); ?></td>
                        <td class="px-6 py-4">
                            <?php if($e['status'] == 'active'): ?>
                                <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-tight">En cours</span>
                            <?php else: ?>
                                <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-tight">Approuvée</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-center">
                             <span class="bg-gray-100 px-2 py-1 rounded text-xs">S: <?= $e['id_student'] ?></span>
                             <span class="bg-gray-100 px-2 py-1 rounded text-xs ml-1">C: <?= $e['id_course'] ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>