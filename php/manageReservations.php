<?php
session_start();
require_once "dbConn.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: loginpage1.php");
    exit();
}

$db = new dbConn();
$conn = $db->connectDB();

$stmt = $conn->query("
    SELECT id, name, capacity, date, request
    FROM reservations
    ORDER BY date DESC
");
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menaxho Rezervimet</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <h1>Menaxho Rezervimet</h1>
    <p class="center-text">Lista e rezervimeve të bëra nga përdoruesit:</p>

    <table class="reservation-table">
        <tr>
            <th>ID</th>
            <th>Emri</th>
            <th>Kapaciteti</th>
            <th>Data</th>
            <th>Kërkesa</th>
        </tr>
        <?php foreach ($reservations as $res): ?>
        <tr>
            <td><?= htmlspecialchars($res["id"]) ?></td>
            <td><?= htmlspecialchars($res["name"]) ?></td>
            <td><?= htmlspecialchars($res["capacity"]) ?></td>
            <td><?= htmlspecialchars($res["date"]) ?></td>
            <td><?= nl2br(htmlspecialchars($res["request"])) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a class="back-link" href="adminDashboard.php">← Kthehu tek Dashboard</a>
</body>
</html>