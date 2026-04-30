<?php

function getStudentId($conn, $userId) {
    $stmt = $conn->prepare("
        SELECT id 
        FROM students 
        WHERE id_user = ?
    ");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}


function getStudentCourses($conn, $studentId) {
    $stmt = $conn->prepare("
        SELECT 
            c.id,
            c.title,
            c.description,
            c.total_hours,
            u.firstname,
            u.lastname,
            u.email
        FROM courses c
        JOIN enrollments e ON c.id = e.id_course
        LEFT JOIN users u ON c.id_prof = u.id
        WHERE e.id_student = ?
        ORDER BY c.title
    ");
    $stmt->execute([$studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getStudentClasseId($conn, $userId) {
    $stmt = $conn->prepare("
        SELECT id_classe 
        FROM students 
        WHERE id_user = ?
    ");
    $stmt->execute([$userId]);
    return $stmt->fetchColumn();
}


function getClassmates($conn, $classeId) {
    $stmt = $conn->prepare("
        SELECT 
            u.firstname,
            u.lastname,
            u.email
        FROM users u
        JOIN students s ON u.id = s.id_user
        WHERE s.id_classe = ?
    ");
    $stmt->execute([$classeId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}







function getStudentCoursesSimple($conn, $studentId) {
    $stmt = $conn->prepare("
        SELECT 
            c.title,
            c.description,
            c.total_hours
        FROM courses c
        JOIN enrollments e ON c.id = e.id_course
        WHERE e.id_student = ?
    ");
    $stmt->execute([$studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getUserProfile($conn, $userId) {
    $stmt = $conn->prepare("
        SELECT 
            u.firstname,
            u.lastname,
            u.email,
            c.name AS class_name
        FROM users u
        LEFT JOIN students s ON u.id = s.id_user
        LEFT JOIN classes c ON s.id_classe = c.id
        WHERE u.id = ?
    ");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>