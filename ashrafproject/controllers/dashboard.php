<?php
// controllers/dashboard.php

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?controller=auth&action=login");
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$username = $_SESSION['username'];

// Get Stats
$stats = get_summary_stats($pdo, $user_id, $role);
$widgets = $stats['widgets'];

// Homeowner specific budget merge
if ($role === 'homeowner') {
     $total_budget = get_budget_total($pdo, $user_id);
     $expense = $stats['expense'];
     
     $status = ($total_budget > 0 && $expense > $total_budget) ? 'Over Budget!' : 'On Track';
     
     $widgets = [
        ['label' => 'Total Expenses', 'value' => '$' . number_format($expense, 2)],
        ['label' => 'Total Budget Limit', 'value' => '$' . number_format($total_budget, 2)],
        ['label' => 'Budget Status', 'value' => $status]
    ];
}

// Get Transactions
$transactions = get_transactions($pdo, $user_id);

// Load View
include 'views/dashboard/index.php';
?>
