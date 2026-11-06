<?php 
include 'header.php'; 

$reg_errors = [];
$reg_success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'register') {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $reg_email = trim($_POST['reg_email'] ?? '');
    $reg_pass = trim($_POST['reg_pass'] ?? '');

    if (empty($firstname)) $reg_errors[] = "Атыңызды енгізіңіз.";
    if (empty($lastname)) $reg_errors[] = "Тегіңізді енгізіңіз.";
    if (empty($reg_email) || !filter_var($reg_email, FILTER_VALIDATE_EMAIL)) $reg_errors[] = "Дұрыс email енгізіңіз.";
    if (empty($reg_pass) || strlen($reg_pass) < 6) $reg_errors[] = "Құпия сөз кемінде 6 символ болуы керек.";

    if (empty($reg_errors)) {
        $reg_success = "Құттықтаймыз, " . htmlspecialchars($firstname) . "! Тіркеу сәтті аяқталды.";
    }
}
?>

<div class="content-section" style="max-width: 500px; margin: 0 auto;">
    <h2>Жаңа қолданушыны тіркеу</h2>

    <?php if (!empty($reg_success)): ?>
        <div class="alert alert-success"><?php echo $reg_success; ?></div>
    <?php endif; ?>

    <?php if (!empty($reg_errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($reg_errors as $err): ?>
                    <li><?php echo $err; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="registerForm" action="register.php" method="POST" novalidate>
        <input type="hidden" name="action" value="register">
        
        <div class="form-group">
            <label style="font-size: 13px; font-weight: bold; display: block; margin-bottom: 5px;">Аты:</label>
            <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($_POST['firstname'] ?? ''); ?>">
            <div class="error-text" id="fnameError">Атыңызды жазыңыз</div>
        </div>

        <div class="form-group">
            <label style="font-size: 13px; font-weight: bold; display: block; margin-bottom: 5px;">Тегі:</label>
            <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($_POST['lastname'] ?? ''); ?>">
            <div class="error-text" id="lnameError">Тегіңізді жазыңыз</div>
        </div>

        <div class="form-group">
            <label style="font-size: 13px; font-weight: bold; display: block; margin-bottom: 5px;">Email:</label>
            <input type="email" id="reg_email" name="reg_email" value="<?php echo htmlspecialchars($_POST['reg_email'] ?? ''); ?>">
            <div class="error-text" id="regEmailError">Қате немесе бос email</div>
        </div>

        <div class="form-group">
            <label style="font-size: 13px; font-weight: bold; display: block; margin-bottom: 5px;">Құпия сөз:</label>
            <input type="password" id="reg_pass" name="reg_pass">
            <div class="error-text" id="regPassError">Құпия сөз кемінде 6 символ болуы тиіс</div>
        </div>

        <button type="submit" class="btn">Тіркелу</button>
    </form>
</div>

<?php include 'footer.php'; ?>