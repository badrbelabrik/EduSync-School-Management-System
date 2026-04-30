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
    $prof_id = $_SESSION["userid"];

    $requete = "SELECT 
    e.id as enroll_id,
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
    $stm->execute([':prof_id' => $prof_id]);

    return $stm->fetchAll(PDO::FETCH_ASSOC);
}
function getClassesByProf($conn, $prof_id) {
    $sql = "SELECT DISTINCT classes.id, classes.name
            FROM classes JOIN students ON students.id_classe = classes.id
            JOIN enrollments ON enrollments.id_student = students.id
            JOIN courses ON courses.id = enrollments.id_course
            WHERE courses.id_prof = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$prof_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStudentsByClass($conn, $class_id) {
    $sql = "SELECT users.firstname, users.lastname, students.student_number
            FROM students
            JOIN users ON users.id = students.id_user
            WHERE students.id_classe = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
