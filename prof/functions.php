<?php
function getProfcourses($conn){
$prof_id = $_SESSION["userid"];


$sql = "SELECT * FROM courses WHERE id_prof = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$prof_id]);
$resultcourses = $stmt->fetchAll(PDO::FETCH_ASSOC);

return $resultcourses;
}
function getstundentsbyprof($conn){
    try {
$prof_id = $_SESSION["userid"];
$requete = "SELECT 
u.firstname AS nom_etu,
c.title AS nom_cours,
c.description AS cour_des,
e.status
FROM enrollments e
JOIN students s ON e.id_student = s.id
JOIN users u ON s.id_user = u.id
JOIN courses c ON e.id_course = c.id
WHERE c.id_prof = :prof_id";

$stm = $conn->prepare($requete);
$stm->execute([
':prof_id' => $prof_id
]);

$mes_etu = $stm->fetchAll(PDO::FETCH_ASSOC);
return $mes_etu;

} catch (PDOException $e) {
echo $e->getMessage();
$mes_etu = [];
}
}