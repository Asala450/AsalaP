
<?php include 'includes/header.php'; ?>

<section class="doctors-section">

    <div class="doctor-banner">
        <div>
            <h1>Біздің тәжірибелі дәрігерлер</h1>
            <p>Сіздің денсаулығыңыз үшін ең үздік мамандар командасы</p>
            <a href="#doctor-list" class="main-btn">Жазылу →</a>
        </div>

        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=500"
             alt="Дәрігер">
    </div>

    <h2 id="doctor-list">Дәрігерлер тізімі</h2>

    <form method="GET" class="search-form">
        <input type="text" name="search"
               placeholder="Дәрігерді іздеу..."
               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

        <select name="specialty">
            <option value="">Барлық мамандық</option>
            <option value="Терапевт">Терапевт</option>
            <option value="Кардиолог">Кардиолог</option>
            <option value="Педиатр">Педиатр</option>
            <option value="Невролог">Невролог</option>
        </select>

        <button type="submit">Іздеу</button>
    </form>

    <?php
    $doctors = [
        ["name"=>"Сәрсенбаева А.Е.", "job"=>"Терапевт", "rating"=>"4.9"],
        ["name"=>"Ибраев Н.Т.", "job"=>"Кардиолог", "rating"=>"4.8"],
        ["name"=>"Қасымова М.А.", "job"=>"Педиатр", "rating"=>"4.9"],
        ["name"=>"Төлегенов Д.Б.", "job"=>"Невропатолог", "rating"=>"4.8"]
    ];

    $search = trim($_GET['search'] ?? '');
    $specialty = $_GET['specialty'] ?? '';

    $filteredDoctors = array_filter($doctors, function($doctor) use ($search, $specialty) {
        return
            ($search === '' ||
             mb_stripos($doctor['name'], $search) !== false ||
             mb_stripos($doctor['job'], $search) !== false)
            &&
            ($specialty === '' || $doctor['job'] === $specialty);
    });
    ?>

    <div class="doctor-grid">

        <?php foreach($filteredDoctors as $doctor): ?>

        <div class="doctor-card">

            <div class="doctor-icon">👨‍⚕️</div>

            <h3><?= htmlspecialchars($doctor['name']) ?></h3>

            <p><?= htmlspecialchars($doctor['job']) ?></p>

            <p class="rating">⭐ <?= $doctor['rating'] ?> (124 пікір)</p>

            <a href="booking.php?doctor=<?= urlencode($doctor['name']) ?>"
               class="main-btn">Жазылу</a>

        </div>

        <?php endforeach; ?>

        <?php if(empty($filteredDoctors)): ?>
            <p>Дәрігер табылмады.</p>
        <?php endif; ?>

    </div>

</section>

<?php include 'includes/footer.php'; ?>
