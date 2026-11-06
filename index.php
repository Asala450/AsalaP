<?php 
include 'includes/header.php'; 

$errors = [];
$successMessage = '';

// 10-апта талабы: $_POST арқылы форманы өңдеу және серверде тексеру[cite: 3]
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_submit'])) {
    $userName = trim($_POST['user_name'] ?? '');
    $userEmail = trim($_POST['user_email'] ?? '');
    $doctorSelect = trim($_POST['doctor_select'] ?? '');
    $appointmentDate = trim($_POST['appointment_date'] ?? '');

    if (empty($userName)) { $errors[] = 'Толық аты-жөніңізді енгізіңіз!'; }
    if (empty($userEmail) || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) { $errors[] = 'Дұрыс email мекенжайын көрсетіңіз!'; }
    if (empty($doctorSelect)) { $errors[] = 'Дәрігерді таңдаңыз!'; }
    if (empty($appointmentDate)) { $errors[] = 'Қабылдау күнін таңдаңыз!'; }

    if (empty($errors)) {
        $successMessage = "Құттықтаймыз, $userName! Сіздің өтінішіңіз сәтті қабылданды.";
    }
}
?>

<div class="hero-split-section">
    <!-- Сол жақта: Дәрігерге жазылу формасы -->
    <div class="hero-form-box">
        <h2>Дәрігерге онлайн жазылу</h2>
        <p class="form-desc">Керекті мәліметтерді толтырып, қабылдау уақытын бекітіңіз.</p>

        <?php if (!empty($errors)): ?>
            <div class="alert-error">
                <?php foreach ($errors as $error): ?><p>⚠️ <?= htmlspecialchars($error) ?></p><?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <div class="alert-success"><p>✅ <?= htmlspecialchars($successMessage) ?></p></div>
        <?php endif; ?>

        <form action="index.php" method="POST" class="appointment-form">
            <div class="form-group">
                <label>Аты-жөніңіз:</label>
                <input type="text" name="user_name" value="<?= htmlspecialchars($_POST['user_name'] ?? '') ?>" placeholder="Аты-жөніңіз">
            </div>
            <div class="form-group">
                <label>Электрондық пошта (Email):</label>
                <input type="email" name="user_email" value="<?= htmlspecialchars($_POST['user_email'] ?? '') ?>" placeholder="mail@example.com">
            </div>
            <div class="form-group">
                <label>Дәрігерді таңдаңыз:</label>
                <select name="doctor_select">
                    <option value="">-- Тізімнен таңдаңыз --</option>
                    <option value="1">Др. Ахметов Арман (Терапевт)</option>
                    <option value="2">Др. Оспанова Айна (Кардиолог)</option>
                    <option value="3">Др. Каримов Данияр (Невролог)</option>
                    <option value="4">Др. Сейтова Динара (Педиатр)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Қабылдау күні:</label>
                <input type="date" name="appointment_date" value="<?= htmlspecialchars($_POST['appointment_date'] ?? '') ?>">
            </div>
            <button type="submit" name="appointment_submit" class="btn-primary full-width">Жазылуды растау</button>
        </form>
    </div>

    <!-- Оң жақта: Креативті мәтін мен сурет -->
    <div class="hero-text-box">
        <h1>Заманауи медицина және сапалы қызмет</h1>
        <p>Сіздің денсаулығыңыз — біздің басты басымдығымыз. Тәжірибелі дәрігерлерге бір кликпен жазылыңыз.</p>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80" alt="Медициналық орталық">
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>