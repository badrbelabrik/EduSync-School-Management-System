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
    
    $check = $conn->prepare("SELECT * FROM courses WHERE title = :title");
    $check->execute(['title' => $title]);

    if ($check->rowCount() > 0) {
        return "exists"; 
    }


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

function getClasses($conn) {
    $stmt = $conn->prepare("SELECT * FROM classes");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function getStudents($conn)
{
    $sql = "SELECT students.id as studentId, users.firstname as firstname, users.lastname as lastname 
            FROM users 
            INNER JOIN students
            on students.id_user=users.id
            WHERE id_role = 3 ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// courses
function getCourses($conn)
{
    $sql = "SELECT * 
            FROM courses";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getenrollStudent($conn)
{
    $sql = "SELECT 
        enrollments.id,
        enrollments.enrolled_at,
        enrollments.status,
        enrollments.id_student,
        enrollments.id_course,
        users.firstname AS student,
        courses.title AS course
    FROM enrollments 
    JOIN students ON enrollments.id_student = students.id
    JOIN users ON students.id_user = users.id
    JOIN courses ON enrollments.id_course = courses.id";

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
$sql = "INSERT INTO enrollments(enrolled_at,status, id_student, id_course)
            VALUES(:date,:status, :id_student, :id_course)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        'date' => date("Y-m-d"),
        'status' => $status,
        'id_student' => $student_id,
        'id_course' => $course_id
    ]);

    return "success";
}
   
    




// nombre des etudiants 
function countStudents($conn)
{
    $sql = "SELECT COUNT(*) as total FROM users WHERE id_role = 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetch()['total'];
}

// nombres courses
function countCourses($conn)
{
    $sql = "SELECT COUNT(*) as total FROM courses";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetch()['total'];
}
function countStudentsActive($conn)
{
    $sql = "SELECT COUNT(DISTINCT u.id) as total
            FROM users u
            JOIN enrollments e ON e.id_student = u.id
            WHERE u.id_role = 3
            AND e.status = 'Approuvée'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetch()['total'];
}
// nombres d'etudiant pour chaque  class
function studentsPerClass($conn)
{
    $sql = "SELECT class_id, COUNT(*) as total
            FROM users
            WHERE id_role = 3
            GROUP BY class_id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countTeachers($conn)
{
    $sql = "SELECT COUNT(*) as total FROM users WHERE id_role = 2";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetch()['total'];
}
function coursesPerTeacher($conn)
{
    $sql = "SELECT 
                u.firstname,
                u.lastname,
                COUNT(c.id) as total_courses
            FROM users u
            LEFT JOIN courses c ON c.id_prof = u.id
            WHERE u.id_role = 2
            GROUP BY u.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function studentsPerCourse($conn)
{
    $sql = "SELECT 
                c.title,
                COUNT(e.id_student) as total_students
            FROM courses c
            LEFT JOIN enrollments e ON e.id_course = c.id
            GROUP BY c.id";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
