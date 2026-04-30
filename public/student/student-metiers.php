<?php


include("../includes/connection.php");
include("../student/functions.php"); // 👈 مهم

$userId = $_SESSION['userid'] ?? null;

if (!$userId) {
    die("User non connecté");
}


$studentId = getStudentId($conn, $userId);

if (!$studentId) {
    $courses = [];
} else {
    $courses = getStudentCoursesSimple($conn, $studentId);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Matières - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f0f9f4]"> 

<div class="p-6 md:p-12 max-w-6xl mx-auto">

    <div class="flex items-center justify-between mb-10">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">
                📚 Mes <span class="text-green-600">Matières</span>
            </h1>
            <p class="text-gray-500 mt-2 font-medium">Consultez vos programmes et volumes horaires.</p>
        </div>
        <div class="hidden md:block">
            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-2xl text-sm font-bold border border-green-200">
                <?= count($courses) ?> Matières au total
            </span>
        </div>
    </div>

    <?php if (empty($courses)): ?>
        <!-- Empty State -->
        <div class="bg-white p-12 rounded-3xl shadow-sm border border-dashed border-gray-300 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-50 rounded-full mb-4">
                <span class="text-3xl text-green-600">🍃</span>
            </div>
            <h3 class="text-lg font-bold text-gray-800">Aucun cours disponible</h3>
            <p class="text-gray-500">Vous n'êtes inscrit à aucune matière pour le moment.</p>
        </div>

    <?php else: ?>
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <?php foreach ($courses as $c): ?>
                <div class="group relative bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:shadow-green-900/5 transition-all duration-300 overflow-hidden">
                    
                    <!-- Decorative Gradient Corner -->
                    <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-green-50 to-transparent rounded-bl-full -mr-10 -mt-10 transition-colors group-hover:from-green-100"></div>

                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-2xl font-bold text-gray-800 group-hover:text-green-700 transition-colors">
                                <?= htmlspecialchars($c['title']) ?>
                            </h2>
                            <span class="p-2 bg-green-50 rounded-xl text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </span>
                        </div>

                        <p class="text-gray-500 leading-relaxed mb-6 line-clamp-2">
                            <?= htmlspecialchars($c['description']) ?>
                        </p>

                        <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                                    ⏱
                                </div>
                                <span class="text-sm font-bold text-gray-700">
                                    <?= htmlspecialchars($c['total_hours']) ?> Heures
                                </span>
                            </div>
                            
                            <button class="text-xs font-bold text-green-600 uppercase tracking-widest hover:text-green-700 flex items-center gap-1 group">
                                Détails 
                                <span class="group-hover:translate-x-1 transition-transform">→</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    <?php endif; ?>

</div>

</body>
</html>