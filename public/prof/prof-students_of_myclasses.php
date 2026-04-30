<?php

// 1. Vérification dyal l-Protections
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != 2) {
    echo "Unauthorized access";
    exit();
}

include("../includes/connection.php");
include("../includes/functions.php");
include("../prof/functions.php");

$prof_id = $_SESSION["userid"];
$classes = getClassesByProf($conn, $prof_id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Classes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="container mx-auto p-6 lg:p-10">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Gestion des Classes</h1>
            <p class="mt-2 text-gray-600">Consultez la liste de vos classes et la répartition des étudiants.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (empty($classes)): ?>
                <div class="col-span-full text-center py-10 bg-white rounded-xl border-2 border-dashed border-gray-300">
                    <p class="text-gray-500">Aucune classe n'est assignée à votre profil pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach($classes as $class): 
                    $students = getStudentsByClass($conn, $class["id"]);
                    $count = count($students);
                ?>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                        
                        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-white">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($class["name"]); ?></h3>
                                <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide mt-1">Section Académique</p>
                            </div>
                            <div class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-bold border border-blue-100">
                                <?= $count; ?> pers.
                            </div>
                        </div>

                        <div class="flex-grow">
                            <div class="px-5 py-3 bg-gray-50/50 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                                Liste des étudiants
                            </div>
                            
                            <ul class="divide-y divide-gray-100 max-h-[320px] overflow-y-auto">
                                <?php if($count > 0): ?>
                                    <?php foreach($students as $student): ?>
                                        <li class="px-5 py-4 flex items-center hover:bg-blue-50/30 transition-colors group">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold shadow-sm mr-4 group-hover:scale-110 transition-transform">
                                                <?= strtoupper(substr($student["firstname"] ?? 'E', 0, 1) . substr($student["lastname"] ?? 'T', 0, 1)); ?>
                                            </div>
                                            
                                            <div class="flex flex-col">
                                                <span class="text-sm font-semibold text-gray-700 group-hover:text-blue-700">
                                                    <?= htmlspecialchars($student["firstname"] . " " . $student["lastname"]); ?>
                                                </span>
                                                <span class="text-[11px] text-gray-400 font-mono italic">
                                                    ID: <?= htmlspecialchars($student["student_number"]); ?>
                                                </span>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="p-8 text-center text-gray-400 text-sm italic">
                                        Aucun étudiant inscrit.
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
                            <a href="attendance.php?class_id=<?= $class['id']; ?>" class="inline-block w-full py-2 px-4 bg-white border border-gray-300 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-100 hover:border-gray-400 transition-all shadow-sm">
                                Gérer l'appel
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>