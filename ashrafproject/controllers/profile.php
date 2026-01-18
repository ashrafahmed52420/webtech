<?php
// controllers/profile.php

if (!isset($_SESSION['user_id'])) header("Location: index.php");

$user_id = $_SESSION['user_id'];

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    if (update_profile($pdo, $user_id, $username, $password)) {
        $_SESSION['username'] = $username;
    }
    header("Location: index.php?controller=dashboard&action=index");
    exit;

} elseif ($action === 'set_budget' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $limit = $_POST['limit'];

    set_budget($pdo, $user_id, $category, $limit);
    header("Location: index.php?controller=dashboard&action=index");
    exit;
}
?>
