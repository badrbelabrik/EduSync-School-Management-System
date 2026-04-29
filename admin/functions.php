<?php
function getTeachers($conn)
{
    $sql = "SELECT id, firstname, lastname 
            FROM users 
            WHERE id_role = 2";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addCourse($conn, $title, $description, $total_hours, $id_prof)
{
    $sql = "INSERT INTO courses(title, description, total_hours, id_prof)
            VALUES(:title, :description, :total_hours, :id_prof)";

    $stmt = $conn->prepare($sql);

    return $stmt->execute([
        'title' => $title,
        'description' => $description,
        'total_hours' => $total_hours,
        'id_prof' => $id_prof
    ]);
}

function getCoursesWithTeachers($conn)
{
    $sql = "SELECT 
                courses.title,
                courses.total_hours,
                users.firstname,
                users.lastname
            FROM courses
            JOIN users ON courses.id_prof = users.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getStudents($conn)
{
    $sql = "SELECT id, firstname, lastname 
            FROM users 
            WHERE id_role = 3";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// courses
function getCourses($conn)
{
    $sql = "SELECT id, title 
            FROM courses";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getenrollStudent($conn)
{
    $sql = "SELECT * FROM enrollments";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//   register un etudiant dans un cours
function enrollStudent($conn, $status, $student_id, $course_id)
{
    // 1️⃣ check ila kayn deja
    $checkSql = "SELECT * FROM enrollments 
                 WHERE id_student = :id_student 
                 AND id_course = :id_course";

    $stmt = $conn->prepare($checkSql);
    $stmt->execute([
        'id_student' => $student_id,
        'id_course' => $course_id
    ]);

    $exists = $stmt->fetch();

    if ($exists) {
        return "exists"; // already enrolled
    }
$sql = "INSERT INTO enrollments(status, id_student, id_course)
            VALUES(:status, :id_student, :id_course)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        'status' => $status,
        'id_student' => $student_id,
        'id_course' => $course_id
    ]);

    return "success";
}
    

?>
