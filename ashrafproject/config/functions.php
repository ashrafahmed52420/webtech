<?php
// functions.php - All database logic here

function register_user($pdo, $username, $email, $password, $role) {
    try {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $hashed, $role]);
    } catch (PDOException $e) {
        return false;
    }
}

function login_user($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
}

function get_transactions($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM transactions WHERE user_id = ? ORDER BY transaction_date DESC, id DESC LIMIT 10");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

function add_transaction($pdo, $user_id, $type, $amount, $category, $description, $date) {
    $stmt = $pdo->prepare("INSERT INTO transactions (user_id, type, amount, category, description, transaction_date) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$user_id, $type, $amount, $category, $description, $date]);
}

function update_profile($pdo, $user_id, $username, $password = null) {
    try {
        if ($password) {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
            $stmt->execute([$username, $hashed, $user_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
            $stmt->execute([$username, $user_id]);
        }
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function set_budget($pdo, $user_id, $category, $limit) {
    // Check existing
    $stmt = $pdo->prepare("SELECT id FROM budgets WHERE user_id = ? AND category = ?");
    $stmt->execute([$user_id, $category]);
    $existing = $stmt->fetch();

    if ($existing) {
        $stmt = $pdo->prepare("UPDATE budgets SET limit_amount = ? WHERE id = ?");
        return $stmt->execute([$limit, $existing['id']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO budgets (user_id, category, limit_amount) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $category, $limit]);
    }
}

function get_budget_total($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT SUM(limit_amount) as total FROM budgets WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $row = $stmt->fetch();
    return isset($row['total']) ? (float)$row['total'] : 0;
}

function get_summary_stats($pdo, $user_id, $role) {
    $stmt = $pdo->prepare("SELECT type, SUM(amount) as total FROM transactions WHERE user_id = ? GROUP BY type");
    $stmt->execute([$user_id]);
    $totals = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $income = isset($totals['income']) ? (float)$totals['income'] : 0;
    $expense = isset($totals['expense']) ? (float)$totals['expense'] : 0;
    
    $summary = [];

    if ($role === 'personal') {
        $savings = $income - $expense;
        $summary = [
            ['label' => 'Total Savings', 'value' => '$' . number_format($savings, 2)],
            ['label' => 'Total Expenses', 'value' => '$' . number_format($expense, 2)],
            ['label' => 'Total Income', 'value' => '$' . number_format($income, 2)]
        ];
    } elseif ($role === 'business') {
        $net_profit = $income - $expense;
        $summary = [
            ['label' => 'Net Profit', 'value' => '$' . number_format($net_profit, 2)],
            ['label' => 'Total Revenue', 'value' => '$' . number_format($income, 2)],
            ['label' => 'Operating Expenses', 'value' => '$' . number_format($expense, 2)]
        ];
    } elseif ($role === 'homeowner') {
         $summary = [
            ['label' => 'Total Expenses', 'value' => '$' . number_format($expense, 2)],
            // Budget logic added in controller
        ];
    }
    
    return ['income' => $income, 'expense' => $expense, 'widgets' => $summary];
}
?>
