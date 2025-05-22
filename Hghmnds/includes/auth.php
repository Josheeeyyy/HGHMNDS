<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['register'])) {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Email and password are required for registration.";
            header("Location: ../index.php");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = "Email already registered.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
            if ($stmt->execute([$email, $hashedPassword])) {
                $_SESSION['user_email'] = $email;
                $_SESSION['success'] = "Registration successful. You are now logged in.";
            } else {
                $_SESSION['error'] = "Registration failed. Try again.";
            }
        }

        header("Location: ../index.php");
        exit;
    }

    if (isset($_POST['login'])) {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Email and password are required for login.";
            header("Location: ../index.php");
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['success'] = "Login successful.";
        } else {
            $_SESSION['error'] = "Invalid email or password.";
        }

        header("Location: ../index.php");
        exit;
    }
}
?>
