<?php function loginUser($conn, $email, $password) {

    session_start();

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password == $user['password']) {

        // 🔥 أهم سطر
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['firstname'];

        header("Location: ../public/dashboard.php");
        exit();

    } else {
        header("Location: ../public/login.php?error=invalidcredentials");
        exit();
    }
}
?>