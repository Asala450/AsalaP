<?php
include 'db.php';

// 1. CREATE (Жаңа дәрігер қосу)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_doctor'])) {
    $name = trim($_POST['name']);
    $specialty = trim($_POST['specialty']);
    $image = trim($_POST['image']);

    if (!empty($name) && !empty($specialty)) {
        // Prepared statements арқылы SQL инъекциясынан қорғану
        $stmt = $pdo->prepare("INSERT INTO doctors (name, specialty, image) VALUES (?, ?, ?)");
        $stmt->execute([$name, $specialty, $image]);
        header("Location: admin.php");
        exit;
    }
}

// 2. DELETE (Жою)
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM doctors WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php");
    exit;
}

// 3. READ (Барлық дәрігерлерді көрсету)
$stmt = $pdo->query("SELECT * FROM doctors ORDER BY id DESC");
$doctors = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>MedBlue — Дәрігерлерді басқару (CRUD)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f4f7fb; }
        .container { max-width: 900px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #143d73; color: white; }
        input, button { padding: 8px; margin: 5px 0; width: 100%; box-sizing: border-box; }
        button { background: #1d5bbf; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
        button:hover { background: #154591; }
        .btn-delete { background: #d32f2f; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
<div class="container">
    <h2>🩺 Дәрігерлерді басқару (CRUD - 12-апта)</h2>

    <!-- Жаңа дәрігер қосу формасы (Create) -->
    <form method="POST" style="background: #f1f5f9; padding: 15px; border-radius: 6px; margin-bottom: 20px;">
        <h3>Жаңа дәрігер қосу</h3>
        <input type="text" name="name" placeholder="Дәрігердің аты-жөні" required>
        <input type="text" name="specialty" placeholder="Мамандығы (мысалы: Кардиолог, Терапевт)" required>
        <input type="text" name="image" placeholder="Сурет жолы (мысалы: Доктор.png немесе images/doc1.jpg)" required>
        <button type="submit" name="add_doctor">Қосу</button>
    </form>

    <!-- Дәрігерлер тізімі (Read) -->
    <h3>Дәрігерлер тізімі</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Сурет</th>
            <th>Аты-жөні</th>
            <th>Мамандығы</th>
            <th>Әрекет</th>
        </tr>
        <?php foreach ($doctors as $doctor): ?>
        <tr>
            <td><?php echo (int)$doctor['id']; ?></td>
            <td><img src="<?php echo htmlspecialchars($doctor['image']); ?>" width="50" style="border-radius: 4px;"></td>
            <td><?php echo htmlspecialchars($doctor['name']); ?></td>
            <td><?php echo htmlspecialchars($doctor['specialty']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo (int)$doctor['id']; ?>" style="color: #1976d2; margin-right: 10px; text-decoration: none; font-weight: bold;">Өңдеу</a>
                <a href="admin.php?delete=<?php echo (int)$doctor['id']; ?>" class="btn-delete" onclick="return confirm('Шын мәнінде жойғыңыз келе ме?')">Жою</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>