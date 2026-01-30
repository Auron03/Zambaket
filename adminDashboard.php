<?php
session_start();
require_once "dbConn.php";
$db = new dbConn();
$conn = $db->connectDB();

require_once "Product.php";
$productObj = new Product($conn);

// Kontrolli i sesionit
if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !="admin"){
  header("Location: loginpage1.php");
  exit();
}

// Shtim produkti
if (isset($_POST["add"])) {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $created_by = $_SESSION["user_id"];

    $imageName = null;
    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imageName);
    }

    $productObj->add($title, $description, $imageName, $created_by);
}

// Update produkti
if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $productObj->update($id, $title, $description);
}

// Delete produkti
if (isset($_POST["delete"])) {
    $id = $_POST["delete_id"];
    $productObj->delete($id);
}

// Lista e produkteve
$products = $productObj->getAll();


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href=""> <!-- css -->
</head>
<body>
  <h1>Mire se erdhe ne Admin Dashboard,
     <?php echo htmlspecialchars($_SESSION["username"]); ?> !
  </h1>
  
  <nav>
    <ul>
        <li>
          <a href="manageUsers.php">Menaxho Perdoruesit</a>
        </li>
            <li>
              <a href="manageReservations.php">Menaxho Rezervimet</a>
            </li>
                <li>
                  <a href="">Menaxho Produktet</a>
                </li>
                    <li>
                      <a href="logout.php">Log out</a>
                    </li>
    </ul>
  </nav>
  <p>Ketu mund te shtosh , ndryshosh ose fshish te dhena sipas rolit te administratorit</p>
  <h2>Shto Produkt</h2>
  <form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Titulli" required><br>
    <textarea name="description" placeholder="Përshkrimi" required></textarea><br>
    <input type="file" name="image"><br>
    <button type="submit" name="add">Shto Produkt</button>
  </form>


  <h2>Lista e Produkteve</h2>
  <?php
  $products = $productObj->getAll();


foreach ($products as $p): ?>
  <div style="border:1px solid gray; margin:10px; padding:10px;">
    <h3><?= htmlspecialchars($p['title']) ?></h3>
    <p><?= htmlspecialchars($p['description']) ?></p>
    <?php if ($p['image']): ?>
      <img src="uploads/<?= htmlspecialchars($p['image']) ?>" width="150"><br>
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


<h2>Mesazhet e kontaktit</h2>
<?php
$stmt = $conn->query("SELECT * FROM messages ORDER BY id DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($messages as $m): ?>
  <div style="border:1px solid #ccc; margin:10px; padding:10px;">
    <p><strong>Emri:</strong> <?= htmlspecialchars($m['name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($m['email']) ?></p>
    <p><strong>Subjekti:</strong> <?= htmlspecialchars($m['subject']) ?></p>
    <p><strong>Mesazhi:</strong><br><?= nl2br(htmlspecialchars($m['message'])) ?></p>
  </div>
<?php endforeach; ?>


      
</body>
</html>