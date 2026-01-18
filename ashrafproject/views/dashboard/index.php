<?php include 'views/layout/header.php'; ?>

<div class="dashboard-container">
    <header class="header">
        <div>
            <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
            <p>Role: <span style="text-transform: capitalize; color: var(--primary-color);"><?php echo $role; ?></span></p>
        </div>
        <div>
            <a href="#add-modal" class="btn" style="text-decoration:none; display:inline-block; width:auto; background-color: var(--secondary-color);">+ Add Transaction</a>
            <a href="#profile-modal" class="btn" style="text-decoration:none; display:inline-block; width:auto; background-color: var(--secondary-color); margin-left:10px;">Profile</a>
            <?php if ($role === 'homeowner'): ?>
                <a href="#budget-modal" class="btn" style="text-decoration:none; display:inline-block; width:auto; background-color: var(--primary-color); margin-left:10px;">Set Budget</a>
            <?php endif; ?>
            <a href="index.php?controller=auth&action=logout" class="btn" style="text-decoration:none; display:inline-block; width:auto; margin-left:10px;">Logout</a>
        </div>
    </header>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <?php foreach ($widgets as $widget): ?>
        <div class="card">
            <h3><?php echo $widget['label']; ?></h3>
            <div class="value"><?php echo $widget['value']; ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Activity Table -->
    <div class="card">
        <h3>Recent Activity</h3>
        <table style="width: 100%; border-collapse: collapse; color: var(--text-color); margin-top: 1rem;">
            <thead>
                <tr style="text-align: left; border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 10px;">Date</th>
                    <th style="padding: 10px;">Type</th>
                    <th style="padding: 10px;">Category</th>
                    <th style="padding: 10px;">Description</th>
                    <th style="padding: 10px; text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($transactions) > 0): ?>
                    <?php foreach ($transactions as $t): ?>
                        <?php 
                            $color = $t['type'] === 'income' ? '#4ade80' : '#f87171';
                            $sign = $t['type'] === 'income' ? '+' : '-';
                        ?>
                        <tr style="border-bottom: 1px solid var(--glass-border);">
                            <td style="padding: 10px;"><?php echo $t['transaction_date']; ?></td>
                            <td style="padding: 10px; text-transform: capitalize;"><?php echo $t['type']; ?></td>
                            <td style="padding: 10px;"><?php echo $t['category']; ?></td>
                            <td style="padding: 10px;"><?php echo $t['description']; ?></td>
                            <td style="padding: 10px; text-align: right; color: <?php echo $color; ?>; font-weight: bold;">
                                <?php echo $sign . '$' . number_format($t['amount'], 2); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="padding:20px; text-align:center;">No transactions found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Transaction Modal -->
<div id="add-modal" class="modal">
    <div class="modal-content">
        <a href="#" class="close-btn">X</a>
        <h2>Add Transaction</h2>
        <form action="index.php?controller=transaction&action=store" method="POST">
            <div class="form-group">
                <label>Type</label>
                <select name="type">
                    <option value="expense">Expense</option>
                    <option value="income">Income</option>
                </select>
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" step="0.01" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" placeholder="e.g. Groceries" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" placeholder="Optional details">
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
            </div>
            <button type="submit" class="btn">Save</button>
        </form>
    </div>
</div>

<!-- Profile Modal -->
<div id="profile-modal" class="modal">
    <div class="modal-content">
        <a href="#" class="close-btn">X</a>
        <h2>Update Profile</h2>
        <form action="index.php?controller=profile&action=update" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current">
            </div>
            <button type="submit" class="btn">Update</button>
        </form>
    </div>
</div>

<!-- Budget Modal -->
<div id="budget-modal" class="modal">
    <div class="modal-content">
        <a href="#" class="close-btn">X</a>
        <h2>Set Budget</h2>
        <form action="index.php?controller=budget&action=set" method="POST">
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" placeholder="e.g. Overall" required>
            </div>
            <div class="form-group">
                <label>Limit Amount</label>
                <input type="text" name="limit" step="0.01" required>
            </div>
            <button type="submit" class="btn">Set Budget</button>
        </form>
    </div>
</div>

<?php include 'views/layout/footer.php'; ?>
