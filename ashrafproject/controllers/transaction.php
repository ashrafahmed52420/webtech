<?php
// controllers/transaction.php

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    add_transaction($pdo, $user_id, $type, $amount, $category, $description, $date);
    header("Location: index.php?controller=dashboard&action=index");
    exit;
}
?>
