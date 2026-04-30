<?php

include("../includes/connection.php");
include("../student/functions.php"); 

$userId = $_SESSION['userid'] ?? null;

if (!$userId) {
    die("User non connecté");
}


$classeId = getStudentClasseId($conn, $userId);

if (!$classeId) {
    $students = [];
} else {
    $students = getClassmates($conn, $classeId);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Camarades</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

<h1 class="text-3xl font-bold text-blue-900 mb-8">
👥 Mes Camarades
</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">

<?php if (empty($students)): ?>

    <div class="p-6 text-gray-600">
        Aucun étudiant trouvé dans cette classe.
    </div>

<?php else: ?>

    <?php foreach ($students as $s): ?>

        <div class="flex justify-between items-center p-5 border-b hover:bg-gray-50">

            <div>
                <p class="text-lg font-semibold text-gray-800">
                    <?= htmlspecialchars($s['firstname'] . " " . $s['lastname']) ?>
                </p>

                <p class="text-sm text-gray-500">
                    <?= htmlspecialchars($s['email']) ?>
                </p>
            </div>

            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                Étudiant
            </span>

        </div>

    <?php endforeach; ?>

<?php endif; ?>

</div>

</body>
</html>
