<?php
session_start();
require_once 'includes/db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            unset($_SESSION['login_error']); 
        } else {
            $_SESSION['login_error'] = "Invalid credentials.";
        }
    } else {
        $_SESSION['login_error'] = "Email and password are required.";
    }

    header("Location: index.php");
    exit;
}
?>

