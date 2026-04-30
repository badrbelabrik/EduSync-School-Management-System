<?php

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] != 2) {
    echo "unauthorized access";
    exit();
}

include("../includes/connection.php");

include("../prof/functions.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $enroll_id = $_POST["enroll_id"];
    $status = $_POST["status"];

    $sql = "UPDATE enrollments SET status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$status,$enroll_id]);


}


$studentbyprof = getstundentsbyprof($conn);
?>

<!DOCTYPE html>
<html>
<head>
<title>Students</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="container mx-auto p-6">
    <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th class="px-6 py-3">Nom étudiant</th>
                    <th class="px-6 py-3">Cours</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3 text-center">Status</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($studentbyprof as $etu): ?>
                <tr class="bg-white border-b hover:bg-gray-50">

                    <td class="px-6 py-4 font-medium text-gray-900">
                        <?= htmlspecialchars($etu['nom_etu']); ?>
                    </td>

                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                            <?= htmlspecialchars($etu['nom_cours']); ?>
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <?= htmlspecialchars($etu['cour_des']); ?>
                    </td>

                    <td class="px-6 py-4 text-center">

                        <form method="POST" class="flex items-center justify-center gap-2">
                            
                            <input type="hidden" name="enroll_id" value="<?= $etu['enroll_id'] ?>">

                            <select name="status" class="text-xs border rounded px-2 py-1">
                                <option value="Actif" <?= $etu['status']=="Actif"?"selected":"" ?>>Actif</option>
                                <option value="Terminé" <?= $etu['status']=="Terminé"?"selected":"" ?>>Terminé</option>
                            </select>

                            <button class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                Update
                            </button>

                        </form>

                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>

</body>
</html>