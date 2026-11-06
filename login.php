
<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Email немесе құпиясөз дұрыс толтырылмады!';
    } else {
        $error = 'Мәліметтер қабылданды. Жүйеге кіру үшін тіркелген аккаунт қажет.';
    }
}

include 'includes/header.php';
?>

<section class="auth-section">

    <div class="auth-info">
        <div class="heart-logo">♡</div>
        <h1>MedBlue-ға<br>қош келдіңіз!</h1>
        <p>Денсаулығыңыз біз үшін маңызды!</p>
        <span class="medical-icon">🩺</span>
    </div>

    <div class="auth-box">

        <h2>Жүйеге кіру</h2>

        <?php if($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php">

            <input type="email" name="email"
                   placeholder="Email" required>

            <input type="password" name="password"
                   placeholder="Құпиясөз" required>

            <button type="submit" class="main-btn full-btn">
                Кіру →
            </button>

        </form>

        <p>Аккаунтыңыз жоқ па?
            <a href="register.php">Тіркелу</a>
        </p>

    </div>

</section>

<?php include 'includes/footer.php'; ?>
