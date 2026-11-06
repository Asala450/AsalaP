<?php 
include 'header.php'; 

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Қарапайым тексеру (кейінгі апталарда базамен жалғанады)
    if ($email === 'admin@mail.com' && $password === '12345') {
        $_SESSION['user'] = 'Әкімші (Admin)';
        header('Location: index.php');
        exit;
    } else {
        $error = 'Email немесе құпия сөз қате!';
    }
}
?>

<div class="form-container-wrapper">
    <div class="form-card">
        <h2>Жүйеге кіру</h2>
        <p class="form-desc">Акаунтқа кіру үшін деректеріңізді енгізіңіз</p>

        <?php if ($error): ?>
            <div class="alert-error"><p>⚠️ <?= htmlspecialchars($error) ?></p></div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="appointment-form">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" placeholder="admin@mail.com" required>
            </div>
            <div class="form-group">
                <label>Құпия сөз:</label>
                <input type="password" name="password" placeholder="12345" required>
            </div>
            <button type="submit" class="btn-primary full-width">Кіру</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>