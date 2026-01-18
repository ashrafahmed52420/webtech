<?php
session_start();
require_once 'config/db.php';
require_once 'config/functions.php'; // Load global functions

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Redirect protection
if (!isset($_SESSION['user_id']) && $controller !== 'auth') {
    header("Location: index.php?controller=auth&action=login");
    exit;
}

// Simple Script Inclusion based on controller name
switch ($controller) {
    case 'auth':
        include 'controllers/auth.php';
        break;

    case 'dashboard':
        include 'controllers/dashboard.php';
        break;

    case 'transaction':
        include 'controllers/transaction.php';
        break;

    case 'profile':
    case 'budget':
        // Map 'budget' controller requests to profile.php logic (simplified)
        // Ensure action name matches what profile.php expects
        if ($controller === 'budget' && $action === 'set') $action = 'set_budget'; 
        include 'controllers/profile.php';
        break;

    default:
        include 'controllers/auth.php';
        break;
}
?>
