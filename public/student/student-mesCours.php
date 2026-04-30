<?php

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

include("../includes/connection.php");
include("../student/functions.php"); 

$userId = $_SESSION['userid'];


$studentId = getStudentId($conn, $userId);

if (!$studentId) {
    $courses = [];
} else {
    $courses = getStudentCourses($conn, $studentId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8fafc]">

<div class="flex min-h-screen">
    <div class="flex-1">

        <section class="p-6 md:p-10 max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        Mes Cours <span class="text-blue-600">Académiques</span>
                    </h2>
                    <p class="text-gray-500 mt-1">Gérez et consultez vos supports de cours en un seul endroit.</p>
                </div>
                
                <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100 w-fit">
                    <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                    <span class="text-gray-700 font-bold text-sm">
                        <?= count($courses) ?> Cours Disponibles
                    </span>
                </div>
            </div>

            <?php if (empty($courses)): ?>
                <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-dashed border-gray-300">
                    <div class="bg-yellow-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-4xl">📚</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Aucun cours trouvé</h3>
                    <p class="text-gray-500 max-w-sm mx-auto mt-2">Votre liste de cours est vide pour le moment. Contactez l'administration si c'est une erreur.</p>
                </div>

            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <?php foreach ($courses as $course): ?>
                        <div class="group bg-white rounded-3xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col">
                            
                            <div class="relative h-24 bg-gradient-to-br from-blue-600 to-indigo-700 p-6">
                                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white relative z-10 line-clamp-1">
                                    <?= htmlspecialchars($course['title']) ?>
                                </h3>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="bg-white/20 backdrop-blur-md text-white text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wider">
                                        Support Inclus
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6 flex flex-col flex-1">
                                <div class="text-gray-500 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                                    <?php if (!empty($course['description'])): ?>
                                        <?= htmlspecialchars($course['description']) ?>
                                    <?php else: ?>
                                        <span class="italic opacity-60">Aucune description détaillée n'a été fournie pour ce cours.</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Durée</p>
                                        <p class="text-sm font-bold text-gray-700 flex items-center gap-1">
                                            <span class="text-blue-500">⏱</span> <?= htmlspecialchars($course['total_hours']) ?> Heures
                                        </p>
                                    </div>
                                    <div class="bg-gray-50 p-3 rounded-2xl border border-gray-100">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Professeur</p>
                                        <p class="text-sm font-bold text-gray-700 truncate flex items-center gap-1">
                                            <span class="text-blue-500">👤</span>
                                            <?= !empty($course['firstname']) ? htmlspecialchars($course['firstname']) : 'Non assigné' ?>
                                        </p>
                                    </div>
                                </div>
                                
                                <a href="cours_details.php?id=<?= $course['id'] ?>" 
                                   class="flex items-center justify-center gap-2 w-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-bold py-3.5 rounded-2xl transition-all duration-300 group-hover:shadow-lg group-hover:shadow-blue-100">
                                    Accéder au cours
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>

        </section>

    </div>
</div>

</body>
</html>