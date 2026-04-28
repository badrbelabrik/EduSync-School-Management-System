<?php

// =======================
// 🔵 US17 - COURSES
// =======================


function getTeachers($conn) {
    $sql = "SELECT  firstname, lastname 
            FROM users 
            WHERE id_role = 2";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addCourse($conn, $name, $description, $hours, $teacher_id) {
    $sql = "INSERT INTO courses(title, description, total_hours, id_prof)
            VALUES(:name, :description, :hours, :teacher_id)";
    
    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'name' => $name,
        'description' => $description,
        'hours' => $hours,
        'teacher_id' => $teacher_id
    ]);
}

function getCoursesWithTeachers($conn) {
    $sql = "SELECT 
                courses.id,
                courses.name,
                courses.hours,
                users.firstName,
                users.lasttName
            FROM courses
            JOIN users ON courses.teacher_id = users.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// 🟡 US18 - ENROLLMENTS

function getStudents($conn) {
    $sql = "SELECT id, firstName, lasttName 
            FROM users 
            WHERE id_role = 3";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// courses
function getCourses($conn) {
    $sql = "SELECT id, name FROM courses";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//   register un etudiant dans un cours
function enrollStudent($conn, $student_id, $course_id) {
    $sql = "INSERT INTO enrollments(student_id, course_id)
            VALUES(:student_id, :course_id)";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'student_id' => $student_id,
        'course_id' => $course_id
    ]);
}


// 🔴 US19 - STATISTICS

// nombre des etudiants 
function countStudents($conn) {
    $sql = "SELECT COUNT(*) as total FROM users WHERE id_role = 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetch()['total'];
}

// nombres courses
function countCourses($conn) {
    $sql = "SELECT COUNT(*) as total FROM courses";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetch()['total'];
}

// nombres d'etudiant pour chaque  class
function studentsPerClass($conn) {
    $sql = "SELECT class_id, COUNT(*) as total
            FROM users
            WHERE id_role = 3
            GROUP BY class_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}