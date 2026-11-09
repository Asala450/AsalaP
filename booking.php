
<?php
include 'header.php';

$doctor = $_GET['doctor'] ?? '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $date = $_POST['date'] ?? '';

    if ($name === '' || $phone === '' || $date === '') {
        $message = 'Барлық өрістерді толтырыңыз!';
    } elseif ($date < date('Y-m-d')) {
        $message = 'Өткен күнге жазылуға болмайды!';
    } else {
        $message = 'Сіз дәрігер қабылдауына жазылу өтінімін жібердіңіз!';
    }
}
?>

<section class="booking-section">

    <div class="booking-box">

        <h1>Дәрігерге жазылу</h1>

        <?php if($message): ?>
            <p class="success"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST" action="booking.php?doctor=<?= urlencode($doctor) ?>">

            <label>Дәрігер</label>
            <input type="text" value="<?= htmlspecialchars($doctor) ?>"
                   placeholder="Дәрігер аты" readonly>

            <label>Аты-жөніңіз</label>
            <input type="text" name="name" required>

            <label>Телефон нөмірі</label>
            <input type="tel" name="phone" required>

            <label>Қабылдау күні</label>
            <input type="date" name="date"
                   min="<?= date('Y-m-d') ?>" required>

            <button type="submit" class="main-btn full-btn">
                Жазылуды растау →
            </button>

        </form>

    </div>

</section>

<?php include 'footer.php'; ?>
