<?php
session_start();
require_once 'includes/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $_SESSION['register_error'] = 'Email and password are required.';
        header("Location: index.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['register_error'] = 'Email already registered.';
            header("Location: index.php");
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $hashedPassword]);

        $_SESSION['user_email'] = $email;
        unset($_SESSION['register_error']); 
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['register_error'] = 'Registration failed. Please try again.';
        header("Location: index.php");
        exit;
    }
}
?>
