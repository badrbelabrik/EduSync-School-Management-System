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
?>
