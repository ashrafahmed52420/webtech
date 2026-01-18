<?php include 'views/layout/header.php'; ?>

<div class="auth-container">
    <h2>Register</h2>
    <?php if (isset($error)): ?>
        <p style="color: red; text-align: center; margin-bottom: 1rem;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="index.php?controller=auth&action=register" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required placeholder="Choose a username">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Create a password">
        </div>
        <div class="form-group">
            <label>I am a:</label>
            <select name="role">
                <option value="personal">Personal User</option>
                <option value="business">Business Owner</option>
                <option value="homeowner">Homeowner</option>
            </select>
        </div>
        <button type="submit" class="btn">Register</button>
    </form>
    <a href="index.php?controller=auth&action=login" class="toggle-link">Already have an account? Login</a>
</div>

<?php include 'views/layout/footer.php'; ?>
