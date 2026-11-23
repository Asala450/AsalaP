<?php
require_once "database.php";

// CREATE (Қосу)
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "create") {
    $stmt = $pdo->prepare(
        "INSERT INTO bookings (patient_name, doctor_name, appointment_date) VALUES (:patient, :doctor, :bdate)"
    );
    $stmt->execute([
        ":patient" => trim($_POST["patient_name"]),
        ":doctor"  => trim($_POST["doctor_name"]),
        ":bdate"   => $_POST["appointment_date"]
    ]);
}

// UPDATE (Өңдеу)
if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "update") {
    $stmt = $pdo->prepare(
        "UPDATE bookings SET patient_name = :patient, doctor_name = :doctor, appointment_date = :bdate WHERE id = :id"
    );
    $stmt->execute([
        ":patient" => trim($_POST["patient_name"]),
        ":doctor"  => trim($_POST["doctor_name"]),
        ":bdate"   => $_POST["appointment_date"],
        ":id"      => (int)$_POST["id"]
    ]);
}

// DELETE (Жою)
if (isset($_GET["delete"])) {
    $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = :id");
    $stmt->execute([":id" => (int)$_GET["delete"]]);
}

// Өңдеу үшін бір жазбаны алу
$editRow = null;
if (isset($_GET["edit"])) {
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE id = :id");
    $stmt->execute([":id" => (int)$_GET["edit"]]);
    $editRow = $stmt->fetch();
}

// READ (Барлық жазбаны оқу)
$stmt = $pdo->prepare("SELECT * FROM bookings ORDER BY id DESC");
$stmt->execute();
$bookings = $stmt->fetchAll();
?>

<form method="POST">
    <input type="hidden" name="action" value="<?= $editRow ? "update" : "create" ?>">
    <?php if ($editRow): ?>
        <input type="hidden" name="id" value="<?= (int)$editRow["id"] ?>">
    <?php endif; ?>

    <input type="text" name="patient_name" placeholder="Науқас аты-жөні" required
           value="<?= htmlspecialchars($editRow["patient_name"] ?? "") ?>">
    <input type="text" name="doctor_name" placeholder="Дәрігер" required
           value="<?= htmlspecialchars($editRow["doctor_name"] ?? "") ?>">
    <input type="date" name="appointment_date" required
           value="<?= htmlspecialchars($editRow["appointment_date"] ?? "") ?>">
    <button type="submit"><?= $editRow ? "Сақтау" : "Қосу" ?></button>
</form>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Науқас</th>
        <th>Дәрігер</th>
        <th>Күні</th>
        <th>Әрекет</th>
    </tr>
    <?php foreach ($bookings as $row): ?>
        <tr>
            <td><?= (int)$row["id"] ?></td>
            <td><?= htmlspecialchars($row["patient_name"]) ?></td>
            <td><?= htmlspecialchars($row["doctor_name"]) ?></td>
            <td><?= htmlspecialchars($row["appointment_date"]) ?></td>
            <td>
                <a href="?edit=<?= (int)$row["id"] ?>">Өңдеу</a> |
                <a href="?delete=<?= (int)$row["id"] ?>" onclick="return confirm('Жойылсын ба?')">Жою</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>