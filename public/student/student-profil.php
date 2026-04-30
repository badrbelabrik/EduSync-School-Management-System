<?php

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

include("../includes/connection.php");

$userId = $_SESSION['userid'];


$sql = "SELECT 
            users.firstname,
            users.lastname,
            users.email,
            classes.name AS class_name
        FROM users
LEFT JOIN students ON users.id = students.id
        LEFT JOIN classes ON students.id_classe = classes.id
        WHERE users.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $userId);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="p-10">

    <h2 class="text-3xl font-bold mb-6">Mon Profil Académique</h2>

    <div class="bg-white p-6 rounded-lg shadow space-y-4">

        <p><strong>Prénom :</strong> <?= $user['firstname']; ?></p>

<p><strong>Nom :</strong> <?= $user['lastname']; ?></p>

<p><strong>Email :</strong> <?= $user['email']; ?></p>

<p><strong>Classe :</strong> <?= $user['class_name'] ?? 'Non assignée'; ?></p>

    </div>

</div>

</body>
</html>






