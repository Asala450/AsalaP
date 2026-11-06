<?php 
include 'includes/header.php'; 

$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = trim($_POST['user_name'] ?? '');
    $userEmail = trim($_POST['user_email'] ?? '');
    $doctorSelect = trim($_POST['doctor_select'] ?? '');
    $appointmentDate = trim($_POST['appointment_date'] ?? '');

    // Серверлік валидация
    if (empty($userName)) {
        $errors[] = 'Аты-жөніңізді енгізіңіз!';
    }
    if (empty($userEmail) || !filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Дұрыс email мекенжайын енгізіңіз!';
    }
    if (empty($doctorSelect)) {
        $errors[] = 'Дәрігерді таңдаңыз!';
    }
    if (empty($appointmentDate)) {
        $errors[] = 'Қабылдау күнін таңдаңыз!';
    }

    if (empty($errors)) {
        $successMessage = "Рахмет, $userName! Сіздің өтiнішіңіз сәтті қабылданды.";
    }
}
?>

<h2>Дәрігерге жазылу формасы</h2>

<?php if (!empty($errors)): ?>
    <div class="error-box" style="color: red;">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if ($successMessage): ?>
    <div class="success-box" style="color: green;">
        <p><?= htmlspecialchars($successMessage) ?></p>
    </div>
<?php endif; ?>

<form action="appointment.php" method="POST" class="appointment-form">
    <label for="user_name">Аты-жөніңіз:</label><br>
    <input type="text" id="user_name" name="user_name" value="<?= htmlspecialchars($_POST['user_name'] ?? '') ?>"><br><br>

    <label for="user_email">Email:</label><br>
    <input type="email" id="user_email" name="user_email" value="<?= htmlspecialchars($_POST['user_email'] ?? '') ?>"><br><br>

    <label for="doctor_select">Дәрігерді таңдаңыз:</label><br>
    <select id="doctor_select" name="doctor_select">
        <option value="">-- Тізімнен таңдаңыз --</option>
        <option value="1">Ахметов Арман (Терапевт)</option>
        <option value="2">Оспанова Айна (Кардиолог)</option>
    </select><br><br>

    <label for="appointment_date">Қабылдау күні:</label><br>
    <input type="date" id="appointment_date" name="appointment_date"><br><br>

    <button type="submit">Жазылуды растау</button>
</form>

<?php include 'includes/footer.php'; ?>