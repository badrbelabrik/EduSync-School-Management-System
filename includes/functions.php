<?php

function emptyInputSignup($firstname,$lastname,$email,$password,$confirmpassword){
    $result = null;
    if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirmpassword)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidFirstname($firstname){
    $result = null;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$firstname)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidLastname($lastname){
    $result = null;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$lastname)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = null;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function passwordMisMatch($pwd,$pwdRepeat){
    $result = null;
    if($pwd !== $pwdRepeat){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}


function userExists($conn, $email) {
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);

    try {
        $stmt->execute([
            ':email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        } else {
            return false;
        }

    } catch (PDOException $e) {
        header("location: ../public/register.php?error=stmtfailed");
        exit();
    }
}


function createUser($conn, $firstname, $lastname, $email, $password, $role) {

    $query = "INSERT INTO users (firstname, lastname, email, password, id_role)
              VALUES (:firstname, :lastname, :email, :password, :role)";

    $stmt = $conn->prepare($query);

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt->execute([
            ':firstname' => $firstname,
            ':lastname'  => $lastname,
            ':email'     => $email,
            ':password'  => $hashedPwd,
            ':role'      => $role
        ]);

        header("Location: ../public/login.php?message=registersuccess");
        exit();

    } catch (PDOException $e) {
        header("Location: ../public/register.php?error=stmtfailed");
        exit();
    }
}

function emptyInputLogin($email,$password){
    $result = null;
    if(empty($email) || empty($password)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($con,$email,$password){
    $userExist = userExists($con,$email);
    if($userExist === false){
        header("location: ../public/login.php?error=invalidcredentials");
        exit();
    }
    $pwdHashed = $userExist["password"];
    $checkpwd = password_verify($password,$pwdHashed);

    if($checkpwd === false){
        header("location: ../public/login.php?error=invalidcredentials");
        exit();
    } 

        session_regenerate_id(true);
        $_SESSION["userid"] = $userExist["id"];
        $_SESSION["firstname"] = $userExist["firstname"];
        $_SESSION["lastname"] = $userExist["lastname"];
        $_SESSION["username"] = $userExist["firstname"]. ' '.$userExist["lastname"];
        $_SESSION["email"] = $userExist["email"];
        $_SESSION["role"] = $userExist["id_role"];

        if($_SESSION["role"] == 1){
            header("location: ../public/dashboard-admin.php");
            exit();
        } else if($_SESSION["role"] == 2){
            header("location: ../public/dashboard-prof.php");
            exit();
        } else if($_SESSION["role"] == 3){
            header("location: ../public/dashboard-student.php");
            exit();
        }
        
    
}

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

function updateUser($conn,$firstname,$lastname,$email,$role,$id){
    $stmt = $conn->prepare("
        UPDATE users 
        SET firstname = :firstname,
            lastname = :lastname,
            email = :email,
            id_role = :role
        WHERE id = :id
    ");

    $stmt->execute([
        ':firstname' => $firstname,
        ':lastname' => $lastname,
        ':email' => $email,
        ':role' => $role,
        ':id' => $id
    ]);

    header("Location: ../public/dashboard-admin.php?page=users");
    exit();
}

function deleteUser($conn,$userid){
    $stmt = $conn->prepare("delete from users where id = :id");

    $stmt->execute([':id' => $userid]);
    header("Location: ../public/dashboard-admin.php?page=users");
    exit();
}

function createClass($conn,$classname,$classroom){
        $query = "INSERT INTO classes (name, classroom_number)
              VALUES (:name, :classroom_number)";

    $stmt = $conn->prepare($query);

    try {
        $stmt->execute([
            ':name' => $classname,
            ':classroom_number'  => $classroom
        ]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();

    } catch (PDOException $e) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

function addStudent($conn,$dateofbirth,$student_number,$id_classe,$id_user) {

    $query = "INSERT INTO students (dateofbirth, student_number, id_classe, id_user)
              VALUES (:dateofbirth, :student_number, :id_classe, :id_user)";

    $stmt = $conn->prepare($query);

    try {
        $stmt->execute([
            ':dateofbirth' => $dateofbirth,
            ':student_number' => $student_number,
            ':id_classe' => $id_classe,
            ':id_user' => $id_user
        ]);

    } catch (PDOException $e) {
        die("Error adding student: " . $e->getMessage());
    }
}

function createUserAdmin($conn, $firstname, $lastname, $email, $password, $role) {

    $query = "INSERT INTO users (firstname, lastname, email, password, id_role)
              VALUES (:firstname, :lastname, :email, :password, :role)";

    $stmt = $conn->prepare($query);

    $stmt->execute([
        ':firstname' => $firstname,
        ':lastname'  => $lastname,
        ':email'     => $email,
        ':password'  => password_hash($password, PASSWORD_DEFAULT),
        ':role'      => $role
    ]);

    return $conn->lastInsertId();
}