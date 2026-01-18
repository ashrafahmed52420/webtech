<?php
// controllers/auth.php

if ($action === 'login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $user = login_user($pdo, $email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        } else {
            $error = "Invalid credentials";
            include 'views/auth/login.php';
        }
    } else {
        include 'views/auth/login.php';
    }

} elseif ($action === 'register') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        if (register_user($pdo, $username, $email, $password, $role)) {
            header("Location: index.php?controller=auth&action=login&success=registered");
            exit;
        } else {
            $error = "Registration failed. Username/Email may exist.";
            include 'views/auth/register.php';
        }
    } else {
        include 'views/auth/register.php';
    }

} elseif ($action === 'logout') {
    session_destroy();
    header("Location: index.php?controller=auth&action=login");
    exit;
} else {
    // Default to login
    include 'views/auth/login.php';
}
?>
