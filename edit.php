<?php
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$id) {
    header("Location: admin.php");
    exit;
}

// Егер форма жіберілсе (Өңдеуді сақтау)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $specialty = trim($_POST['specialty']);
    $image = trim($_POST['image']);

    if (!empty($name) && !empty($specialty)) {
        // Prepared statements қолданып жаңарту (SQL инъекциясынан қорғау)
        $stmt = $pdo->prepare("UPDATE doctors SET name = ?, specialty = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $specialty, $image, $id]);
        header("Location: admin.php");
        exit;
    }
}

// Базадан өңделетін дәрігердің мәліметін алу
$stmt = $pdo->prepare("SELECT * FROM doctors WHERE id = ?");
$stmt->execute([$id]);
$doctor = $stmt->fetch();

if (!$doctor) {
    echo "Дәрігер табылмады!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <title>Дәрігерді өңдеу</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; background: #f4f7fb; }
        .container { max-width: 400px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
        input, button { padding: 10px; margin: 8px 0; width: 100%; box-sizing: border-box; }
        button { background: #1976d2; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h2>Дәрігер мәліметін өңдеу</h2>
    <form method="POST">
        <label>Дәрігердің аты-жөні:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($doctor['name']); ?>" required>

        <label>Мамандығы:</label>
        <input type="text" name="specialty" value="<?php echo htmlspecialchars($doctor['specialty']); ?>" required>

        <label>Сурет жолы:</label>
        <input type="text" name="image" value="<?php echo htmlspecialchars($doctor['image']); ?>" required>

        <button type="submit">Өзгерістерді сақтау</button>
    </form>
    <br>
    <a href="admin.php">← Артқа қайту</a>
</div>
</body>
</html>