<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="kk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedBlue — Дәрігерге жазылу жүйесі</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="logo">
            <h2>💙 Med<span class="highlight">Blue</span></h2>
        </div>
        <nav class="nav-links">
            <a href="index.php">Басты бет</a>
            <a href="doctors.php">Дәрігерлер</a>
            <a href="appointment.php">Қабылдауға жазылу</a>
            
            <?php if (isset($_SESSION['user'])): ?>
                <span class="welcome-user">👤 <?= htmlspecialchars($_SESSION['user']) ?></span>
                <a href="logout.php" class="nav-btn-logout">Шығу</a>
            <?php else: ?>
                <a href="login.php" class="nav-btn">Кіру</a>
            <?php endif; ?>
        </nav>
    </header>
    <main class="container">