<?php


if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

include("../includes/connection.php");

$studentId = $_SESSION['userid'];

$sql = "SELECT 
            courses.id,
            courses.title,
            courses.description,
            courses.total_hours,
            users.firstname,
            users.lastname,
            users.email
        FROM courses
        LEFT JOIN users ON courses.id_prof = users.id
        ORDER BY courses.title";

$stmt = $conn->prepare($sql);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">



    <!-- Main content -->
    <div class="flex-1">

     

        <!-- Section -->
        <section class="p-10">

            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-bold text-gray-900">
                    📚 Liste des Cours
                </h2>
                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">
                    Total: <?= count($courses) ?> cours
                </span>
            </div>

            <?php if (empty($courses)): ?>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-6 rounded-lg shadow" role="alert">
                    <p class="font-bold text-lg">⚠️ Pas de cours</p>
                    <p class="mt-2">Aucun cours n'est disponible pour le moment.</p>
                </div>

            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <?php foreach ($courses as $course): ?>
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                            
                            <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-5">
                                <h3 class="text-xl font-bold text-white">
                                    <?= htmlspecialchars($course['title']) ?>
                                </h3>
                            </div>
                            
                            <div class="p-5 space-y-4">
                                
                                <div class="text-gray-600 text-sm">
                                    <?php if (!empty($course['description'])): ?>
                                        <p><?= htmlspecialchars($course['description']) ?></p>
                                    <?php else: ?>
                                        <p class="text-gray-400 italic">Aucune description</p>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <span class="font-semibold">⏱️ Heures:</span>
                                    <span><?= htmlspecialchars($course['total_hours']) ?> h</span>
                                </div>
                                
                                <div class="border-t pt-3">
                                    <div class="flex items-start gap-2">
                                        <span class="text-blue-600 text-lg">👨‍🏫</span>
                                        <div>
                                            <p class="font-semibold text-gray-800">Professeur:</p>
                                            <p class="text-gray-700">
                                                <?php if (!empty($course['firstname'])): ?>
                                                    <?= htmlspecialchars($course['firstname'] . ' ' . $course['lastname']) ?>
                                                <?php else: ?>
                                                    <span class="text-gray-400 italic">Non assigné</span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="cours_details.php?id=<?= $course['id'] ?>" 
                                   class="block text-center mt-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition text-sm font-medium">
                                    Voir le cours →
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