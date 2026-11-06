<?php 
include 'includes/header.php'; 

$loginError = '';
$registerSuccess = '';

// Кіруді өңдеу ($_POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $email = trim($_POST['login_email'] ?? '');
    $password = trim($_POST['login_password'] ?? '');

    if ($email === 'admin@mail.com' && $password === '12345') {
        $_SESSION['user'] = 'Әкімші (Admin)';
        header('Location: index.php');
        exit;
    } else {
        $loginError = 'Email немесе құпия сөз қате!';
    }
}

// Тіркелуді өңдеу ($_POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_submit'])) {
    $regName = trim($_POST['reg_name'] ?? '');
    $regEmail = trim($_POST['reg_email'] ?? '');
    
    if (!empty($regName) && !empty($regEmail)) {
        $_SESSION['user'] = $regName;
        header('Location: index.php');
        exit;
    }
}
?>

<div class="auth-container">
    <!-- Кіру формасы -->
    <div class="form-card">
        <h2>Жүйеге кіру</h2>
        <p class="form-desc">Тіркелген пошта мен құпия сөзді енгізіңіз</p>

        <?php if ($loginError): ?>
            <div class="alert-error"><p>⚠️ <?= htmlspecialchars($loginError) ?></p></div>
        <?php endif; ?>

        <form action="auth.php" method="POST" class="appointment-form">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="login_email" placeholder="admin@mail.com" required>
            </div>
            <div class="form-group">
                <label>Құпия сөз:</label>
                <input type="password" name="login_password" placeholder="12345" required>
            </div>
            <button type="submit" name="login_submit" class="btn-primary full-width">Кіру</button>
        </form>
    </div>

    <!-- Тіркелу формасы -->
    <div class="form-card">
        <h2>Тіркелу</h2>
        <p class="form-desc">Жаңа аккаунт ашу үшін толтырыңыз</p>

        <form action="auth.php" method="POST" class="appointment-form">
            <div class="form-group">
                <label>Аты-жөніңіз:</label>
                <input type="text" name="reg_name" placeholder="Аты-жөніңіз" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="reg_email" placeholder="mail@example.com" required>
            </div>
            <div class="form-group">
                <label>Құпия сөз:</label>
                <input type="password" name="reg_password" placeholder="Құпия сөз құру" required>
            </div>
            <button type="submit" name="register_submit" class="btn-secondary full-width">Тіркелу</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>