<?php
session_start();
require_once "dbConn.php";
require_once "Product.php";

$db = new dbConn();
$conn = $db->connectDB();
$productObj = new Product($conn);

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: loginpage1.php");
    exit();
}

// CREATE 
if (isset($_POST["add"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $fileName = null;
    if (!empty($_FILES["file"]["name"])) {
        $fileName = time() . "_" . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/" . $fileName);
    }
    $productObj->add($title, $description, $fileName, $_SESSION["user_id"]);
}

// UPDATE 
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $productObj->update($id, $title, $description);
}

// DELETE 
if (isset($_POST["delete"])) {
    $id = $_POST["delete_id"];
    $productObj->delete($id);
}

$products = $productObj->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
  <h1>Admin Dashboard</h1>

  <nav>
    <ul>
        <li><a href="manageUsers.php">Përdoruesit</a></li>
        <li><a href="manageReservations.php">Rezervimet</a></li>
        <li><a href="adminDashboard.php">Produktet</a></li>
        <li><a href="manageStaff.php">Staff-i</a></li> 
        <li><a href="logout.php">Log out</a></li>
    </ul>
  </nav>

  <h2>Shto Produkt</h2>
  <form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Titulli" required><br>
    <textarea name="description" placeholder="Përshkrimi" required></textarea><br>
    <input type="file" name="file"><br>
    <button type="submit" name="add">Shto</button>
  </form>

  <h2>Lista e Produkteve</h2>
  <div class="product-container">
    <?php foreach ($products as $p): ?>
      <div class="product-box">
        <h3><?= htmlspecialchars($p['title']) ?></h3>
        <p><?= htmlspecialchars($p['description']) ?></p>
        <?php if ($p['image']): ?>
          <img src="../uploads/<?= htmlspecialchars($p['image']) ?>" alt="Produkt" />
        <?php endif; ?>

        <form method="POST">
          <input type="hidden" name="id" value="<?= $p['id'] ?>">
          <input type="text" name="title" value="<?= htmlspecialchars($p['title']) ?>">
          <textarea name="description"><?= htmlspecialchars($p['description']) ?></textarea>
          <button type="submit" name="update">Edito</button>
        </form>

        <form method="POST">
          <input type="hidden" name="delete_id" value="<?= $p['id'] ?>">
          <button type="submit" name="delete">Fshij</button>
        </form>
      </div>
    <?php endforeach; ?>
  </div>

  <h2>Mesazhet e kontaktit</h2>
  <div class="message-container">
    <?php
    $stmt = $conn->query("SELECT * FROM messages ORDER BY id DESC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($messages as $m): ?>
      <div class="message-box">
        <p><strong>Emri:</strong> <?= htmlspecialchars($m['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($m['email']) ?></p>
        <p><strong>Subjekti:</strong> <?= htmlspecialchars($m['subject']) ?></p>
        <p><strong>Mesazhi:</strong><br><?= nl2br(htmlspecialchars($m['message'])) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>