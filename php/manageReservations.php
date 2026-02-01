<?php
session_start();
require_once "dbConn.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: loginpage1.php");
    exit();
}

$db = new dbConn();
$conn = $db->connectDB();

// DELETE 
if (isset($_POST["delete"])) {
    $id = $_POST["delete_id"];
    $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
    $stmt->execute([$id]);
}

// UPDATE 
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $capacity = $_POST["capacity"];
    $date = $_POST["date"];
    $request = $_POST["request"];

    $stmt = $conn->prepare("UPDATE reservations SET name=?, capacity=?, date=?, request=? WHERE id=?");
    $stmt->execute([$name, $capacity, $date, $request, $id]);
}

// READ 
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
            <th>Veprime</th>
        </tr>
        <?php foreach ($reservations as $res): ?>
        <tr>
            <form method="POST">
                <td><?= htmlspecialchars($res["id"]) ?></td>
                <td><input type="text" name="name" value="<?= htmlspecialchars($res["name"]) ?>"></td>
                <td><input type="number" name="capacity" value="<?= htmlspecialchars($res["capacity"]) ?>"></td>
                <td><input type="date" name="date" value="<?= htmlspecialchars($res["date"]) ?>"></td>
                <td><textarea name="request"><?= htmlspecialchars($res["request"]) ?></textarea></td>
                <td>
                    <input type="hidden" name="id" value="<?= $res["id"] ?>">
                    <button type="submit" name="update">Edito</button>
                    <button type="submit" name="delete" onclick="return confirm('A je i sigurt që do ta fshish këtë rezervim?')">Fshij</button>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>

    <a class="back-link" href="adminDashboard.php">← Kthehu tek Dashboard</a>
</body>
</html>
