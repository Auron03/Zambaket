<?php
session_start();
require_once "dbConn.php";

// a osht admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: loginpage1.php");
    exit();
}

$db = new dbConn();
$conn = $db->connectDB();

// C
if (isset($_POST["add_staff"])) {
    $name = $_POST["name"];
    $position = $_POST["position"];
    $shift = $_POST["shift"];

    $stmt = $conn->prepare("INSERT INTO staff (name, position, shift) VALUES (?, ?, ?)");
    $stmt->execute([$name, $position, $shift]);
}

// U
if (isset($_POST["update_staff"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $position = $_POST["position"];
    $shift = $_POST["shift"];

    $stmt = $conn->prepare("UPDATE staff SET name=?, position=?, shift=? WHERE id=?");
    $stmt->execute([$name, $position, $shift, $id]);
}

// D
if (isset($_POST["delete_staff"])) {
    $id = $_POST["id"];
    $stmt = $conn->prepare("DELETE FROM staff WHERE id=?");
    $stmt->execute([$id]);
}

// R
$stmt = $conn->query("SELECT * FROM staff ORDER BY id ASC");
$staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menaxho Staff-in</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <h1>Menaxho Staff-in</h1>

<!-- me shtu punetor -->
    <form method="POST">
        <input type="text" name="name" placeholder="Emri" required>
        <input type="text" name="position" placeholder="Pozicioni" required>
        <select name="shift" required>
            <option value="Paradite">Paradite</option>
            <option value="Mesndrrim">Mesndrrim</option>
            <option value="Pasdite">Pasdite</option>
        </select>
        <button type="submit" name="add_staff">Shto Punëtor</button>
    </form>

    <!-- tabela me punetor -->
    <table class="reservation-table">
        <tr>
            <th>ID</th>
            <th>Emri</th>
            <th>Pozicioni</th>
            <th>Orari</th>
            <th>Veprime</th>
        </tr>
        <?php foreach ($staff as $s): ?>
        <tr>
            <form method="POST">
                <td><?= htmlspecialchars($s["id"]) ?></td>
                <td><input type="text" name="name" value="<?= htmlspecialchars($s["name"]) ?>"></td>
                <td><input type="text" name="position" value="<?= htmlspecialchars($s["position"]) ?>"></td>
                <td>
                    <select name="shift">
                        <option value="Paradite" <?= $s["shift"]==="Paradite" ? "selected" : "" ?>>Paradite</option>
                        <option value="Mesndrrim" <?= $s["shift"]==="Mesndrrim" ? "selected" : "" ?>>Mesndrrim</option>
                        <option value="Pasdite" <?= $s["shift"]==="Pasdite" ? "selected" : "" ?>>Pasdite</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="id" value="<?= $s["id"] ?>">
                    <button type="submit" name="update_staff">Ruaj</button>
                    <button type="submit" name="delete_staff" onclick="return confirm('A je i sigurt?')">Fshij</button>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>

    <a class="back-link" href="adminDashboard.php">← Kthehu tek Dashboard</a>
</body>
</html>
