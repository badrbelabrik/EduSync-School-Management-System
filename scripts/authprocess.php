<?php
require_once("../includes/connection.php");
session_start();
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
} else{
    header("location: ../public/login.php");
    exit();
}

?>