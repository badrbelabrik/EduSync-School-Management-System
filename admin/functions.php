<?php
function getUsers($conn) {
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getClasses($conn) {
    $stmt = $conn->prepare("SELECT * FROM classes");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCourses($conn) {
    $stmt = $conn->prepare("SELECT * FROM courses");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStudents($conn) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id_role = 3");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

