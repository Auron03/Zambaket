<?php
session_start();
require_once "includes/dbConn.php";


if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: loginpage1.php");
    exit();
}

$db = new dbConn();
$conn = $db->connectDB();

$stmt = $conn->query("SELECT id, username, phone, reservation_date, status FROM reservations ORDER BY reservation_date DESC");
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menaxho Rezervimet</title>
    <link rel="stylesheet" href="admin.css"> <!-- css -->
</head>
<body>
    <h1>Menaxho Rezervimet</h1>
    <p>Lista e rezervimeve të bëra nga përdoruesit:</p>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Përdoruesi</th>
            <th>Telefoni</th>
            <th>Data e Rezervimit</th>
            <th>Statusi</th>
        </tr>
        <?php foreach ($reservations as $res): ?>
        <tr>
            <td><?php echo htmlspecialchars($res["id"]); ?></td>
            <td><?php echo htmlspecialchars($res["username"]); ?></td>
            <td><?php echo htmlspecialchars($res["phone"]); ?></td>
            <td><?php echo htmlspecialchars($res["reservation_date"]); ?></td>
            <td><?php echo htmlspecialchars($res["status"]); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="adminDashboard.php">← Kthehu tek Dashboard</a>
</body>
</html>