<?php
if (isset($_SESSION['userid'])) {
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
session_start();
require_once("../includes/connection.php");
require_once("../includes/functions.php");
function sanitize($data) {
    return htmlspecialchars((trim($data)));
}

if(isset($_POST['registration'])){
    $firstname = sanitize($_POST['firstname'] ?? '');
    $lastname = sanitize($_POST['lastname'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmpassword'] ?? '';

    if (emptyInputSignup($firstname,$lastname,$email,$password,$confirmPassword)) {
        header("location: ../public/register.php?error=emptyinput");
        exit();
    }

    if(invalidFirstname($firstname)){
        header("location: ../public/register.php?error=invalidfirstname");
        exit();
    }
    if(invalidLastname($lastname)){
        header("location: ../public/register.php?error=invalidlastname");
        exit();
    }

    if(invalidEmail($email)){
        header("location: ../public/register.php?error=invalidemail");
        exit();
    }

    if(passwordMisMatch($password,$confirmPassword)){
        header("location: ../public/register.php?error=passwordconfirmationmismatch");
        exit();
    }

    if(userExists($conn,$email) !== false){
        header("location: ../public/register.php?error=useralreadyexist");
        exit();
    } else{
        createUser($conn,$firstname,$lastname,$email,$password,3);
        exit();
    }
}

if(isset($_POST['login'])){
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'];

    if(emptyInputLogin($email,$password)){
        header("location: ../public/login.php?error=emptyinput");
        exit();
    }
    loginUser($conn,$email,$password);
} 

if(isset($_POST['add-user'])){
    $firstname = sanitize($_POST['firstname'] ?? '');
    $lastname = sanitize($_POST['lastname'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($role)) {
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=emptyfield');
        exit;
    }
        if(invalidFirstname($firstname)){
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=invalidfirstname');
        exit();
    }
    if(invalidLastname($lastname)){
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=invalidlastname');
        exit();
    }

    if(invalidEmail($email)){
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=invalidemail');
        exit();
    }
    if(userExists($conn,$email) !== false){
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=useralreadyexist');
        exit();
    }
        createUser($conn,$firstname,$lastname,$email,$password,$role);
        header("Location: ../public/dashboard-admin.php?page=users");
        exit();

}

if (isset($_POST['update-user'])) {
    $firstname = sanitize($_POST['firstname'] ?? '');
    $lastname = sanitize($_POST['lastname'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $role = $_POST['role'] ?? '';
    $id = $_POST['user_id'];

    if (empty($firstname) || empty($lastname) || empty($email) || empty($role)) {
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=emptyfield');
        exit;
    }
        if(invalidFirstname($firstname)){
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=invalidfirstname');
        exit();
    }
    if(invalidLastname($lastname)){
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=invalidlastname');
        exit();
    }

    if(invalidEmail($email)){
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=invalidemail');
        exit();
    }
    updateUser($conn,$firstname,$lastname,$email,$role,$id);
}

if(isset($_POST['delete-user'])){
    $userid = $_POST['user_id'];
    if ($userid == $_SESSION['userid']) {
    die("You cannot delete your own account");
    }
    deleteUser($conn,$userid);
}

if(isset($_POST['add-class'])){
    $classname = sanitize($_POST['classname'] ?? '');
    $classroom_number = sanitize($_POST['classroom_number'] ?? '');


    if (empty($classname) || empty($classroom_number)) {
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=emptyfield');
        exit;
    }
        if(!preg_match("/^[a-zA-Z0-9]*$/",$classname)){
        header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=invalidclassname');
        exit();
    }
        createClass($conn,$classname,$classroom_number);
        header("Location: ../public/dashboard-admin.php?page=users");
        exit();
}
?>