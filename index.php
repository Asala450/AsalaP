<?php 
include 'header.php'; 

$login_error = "";
$login_success = "";

// Кіру формасын POST арқылы тексеру
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $login_error = "Барлық өрістерді толтырыңыз!";
    } else {
        $login_success = "Сәтті кірдіңіз, қош келдіңіз!";
    }
}
?>

<div class="main-container">
    <!-- Сол жақ: Кіру формасы -->
    <div class="login-section">
        <h3>Мұнда кіру</h3>

        <?php if (!empty($login_error)): ?>
            <div class="alert alert-danger"><?php echo $login_error; ?></div>
        <?php endif; ?>

        <?php if (!empty($login_success)): ?>
            <div class="alert alert-success"><?php echo $login_success; ?></div>
        <?php endif; ?>

        <form id="loginForm" action="index.php" method="POST" novalidate>
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <input type="text" id="login_email" name="email" placeholder="Телефон немесе email">
                <div class="error-text" id="loginEmailError">Өрісті толтырыңыз</div>
            </div>
            <div class="form-group">
                <input type="password" id="login_password" name="password" placeholder="Құпия сөз">
                <div class="error-text" id="loginPassError">Құпия сөзді енгізіңіз</div>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="remember">
                <label for="remember">Чужой компьютер</label>
            </div>
            <button type="submit" class="btn">Кіру</button>
            <a href="#" class="forgot-link">Забыли пароль?</a>
        </form>
    </div>

    <!-- Оң жақ: Сайт туралы ақпарат және жылдам тіркелу -->
    <div class="content-section">
        <h2>Қош келдіңіз!</h2>
        <p style="font-size: 14px; line-height: 1.5; color: #444;">
            Бұл жүйе — достармен, әріптестермен және сыныптастармен байланыста болуға арналған әмбебап платформа.
        </p>

        <div class="register-box">
            <h3>Моментальная регистрация (Жылдам тіркелу)</h3>
            <p style="font-size: 13px; color: #666; margin-bottom: 10px;">Бүгін тіркеліп, өз парақшаңызды ашыңыз.</p>
            <a href="register.php" style="display: inline-block; background-color: #5181b8; color: white; padding: 8px 15px; border-radius: 3px; text-decoration: none; font-size: 13px; font-weight: bold;">Тіркелуге өту</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>