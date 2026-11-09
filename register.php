
<?php
include 'header.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)
        || strlen($password) < 8) {

        $message = 'Барлық ақпаратты дұрыс толтырыңыз. Құпиясөз кемінде 8 таңба болуы керек.';

    } else {
        $message = 'Тіркелу деректері тексеруден өтті!';
    }
}
?>

<section class="auth-section">

    <div class="auth-info">
        <div class="heart-logo">♡</div>
        <h1>MedBlue</h1>
        <p>Өз денсаулығыңызға қамқорлық жасаңыз!</p>
    </div>

    <div class="auth-box">

        <h2>Тіркелу</h2>

        <?php if($message): ?>
            <p class="success"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST" action="register.php">

            <input type="text" name="name"
                   placeholder="Аты-жөніңіз" required>

            <input type="email" name="email"
                   placeholder="Email" required>

            <input type="password" name="password"
                   placeholder="Құпиясөз (кемінде 8 таңба)" required>

            <button type="submit" class="main-btn full-btn">
                Тіркелу →
            </button>

        </form>

        <p>Аккаунтыңыз бар ма?
            <a href="login.php">Кіру</a>
        </p>

    </div>

</section>

<?php include 'footer.php'; ?>
