<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Management System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add Modal styles directly here since we removed JS toggling of classes */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 100; }
        .modal:target { display: flex; justify-content: center; align-items: center; }
        .modal-content { background: var(--glass-bg); padding: 2rem; border-radius: 1rem; width: 400px; backdrop-filter: blur(16px); position: relative; }
        .close-btn { position: absolute; top: 10px; right: 10px; color: white; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<?php if (isset($_GET['success'])): ?>
    <div style="position:fixed; top:20px; right:20px; background:green; color:white; padding:10px; border-radius:5px; z-index:200;">
        Success!
    </div>
<?php endif; ?>
