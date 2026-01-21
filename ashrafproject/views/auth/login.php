<?php include 'views/layout/header.php'; ?>

<div class="auth-container">
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p style="color: red; text-align: center; margin-bottom: 1rem;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="index.php?controller=auth&action=login" method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Enter your password">
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
    <a href="index.php?controller=auth&action=register" class="toggle-link">Create an account</a>
</div>

<?php include 'views/layout/footer.php'; ?> 
