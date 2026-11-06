<?php 
include 'header.php'; 

$errors = [];
$successMessage = '';

// 10-апта талабы: $_POST арқылы форманы өңдеу және серверде тексеру
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = trim($_POST['user_name'] ?? '');
    $userEmail = trim($_POST['user_email'] ?? '');
    $doctorSelect = trim($_POST['doctor_select'] ?? '');
    $appointmentDate = trim($_POST['appointment_date'] ?? '');

    // Серверлік валидация (тексеру)
    if (empty($userName)) {
        $errors[] = 'Толық аты-жөніңізді енгізіңіз!';
    }
    if (empty($userEmail) || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Дұрыс email мекенжайын көрсетіңіз!';
    }
    if (empty($doctorSelect)) {
        $errors[] = 'Дәрігерді таңдаңыз!';
    }
    if (empty($appointmentDate)) {
        $errors[] = 'Қабылдау күнін таңдаңыз!';
    }

    if (empty($errors)) {
        $successMessage = "Құттықтаймыз, $userName! Сіздің өтінішіңіз сәтті қабылданды.";
    }
}
?>

<div class="form-container">
    <h2>Дәрігерге онлайн жазылу формасы</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert-error">
            <?php foreach ($errors as $error): ?>
                <p>⚠️ <?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($successMessage): ?>
        <div class="alert-success">
            <p>✅ <?= htmlspecialchars($successMessage) ?></p>
        </div>
    <?php endif; ?>

    <form action="appointment.php" method="POST" class="appointment-form">
        <div class="form-group">
            <label for="user_name">Аты-жөніңіз:</label>
            <input type="text" id="user_name" name="user_name" value="<?= htmlspecialchars($_POST['user_name'] ?? '') ?>" placeholder="Мысалы: Иван Иванов">
        </div>

        <div class="form-group">
            <label for="user_email">Электрондық пошта (Email):</label>
            <input type="email" id="user_email" name="user_email" value="<?= htmlspecialchars($_POST['user_email'] ?? '') ?>" placeholder="mail@example.com">
        </div>

        <div class="form-group">
            <label for="doctor_select">Дәрігерді таңдаңыз:</label>
            <select id="doctor_select" name="doctor_select">
                <option value="">-- Тізімнен таңдаңыз --</option>
                <option value="1" <?= (($_POST['doctor_select'] ?? '') == '1') ? 'selected' : '' ?>>Ахметов Арман (Терапевт)</option>
                <option value="2" <?= (($_POST['doctor_select'] ?? '') == '2') ? 'selected' : '' ?>>Оспанова Айна (Кардиолог)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="appointment_date">Қабылдау күні:</label>
            <input type="date" id="appointment_date" name="appointment_date" value="<?= htmlspecialchars($_POST['appointment_date'] ?? '') ?>">
        </div>

        <button type="submit" class="btn-primary">Жазылуды растау</button>
    </form>
</div>

<?php include 'footer.php'; ?>