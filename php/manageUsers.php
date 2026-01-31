<?php
session_start();
require_once "dbConn.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: loginpage1.php");
    exit();
}

$db = new dbConn();
$conn = $db->connectDB();

$stmt = $conn->query("SELECT id, username, email, role FROM users ORDER BY id ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menaxho Përdoruesit</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <h1>Menaxho Përdoruesit</h1>
    <p class="center-text">Lista e përdoruesve të regjistruar:</p>

    <table class="reservation-table">
        <tr>
            <th>ID</th>
            <th>Emri</th>
            <th>Email</th>
            <th>Roli</th>
        </tr>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?= htmlspecialchars($u["id"]) ?></td>
            <td><?= htmlspecialchars($u["username"]) ?></td>
            <td><?= htmlspecialchars($u["email"]) ?></td>
            <td><?= htmlspecialchars($u["role"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a class="back-link" href="adminDashboard.php">← Kthehu tek Dashboard</a>
</body>
</html>