<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "user") {
    header("Location: loginpage1.php");
    exit();
}

require_once "dbConn.php";
$db = new dbConn();
$conn = $db->connectDB();

$feedback = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $capacity = trim($_POST["capacity"]);
    $date = trim($_POST["date"]);
    $request = trim($_POST["request"]);

    if (empty($name) || empty($capacity) || empty($date)) {
        $feedback = "Ju lutem plotësoni fushat e detyrueshme!";
    } else {
        $stmt = $conn->prepare("INSERT INTO reservations (name, capacity, date, request) VALUES (?,?,?,?)");
        $stmt->execute([$name, $capacity, $date, $request]);
        $feedback = "Rezervimi u krye me sukses!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rezervo</title>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/contact.css"> 
</head>
<body>
  <div class="header">
    <div class="left-section">
      <a href="homepage.php"><img src="../images/logo.png" alt="Logo" height="150px" width="150px"></a>
    </div>
    <div class="middle-section">
      <a href="homepage.php">Home</a>
      <a href="homepage.php#eatdrink">Eat & Drink</a>
      <a href="contact.php">Contact</a>
      <a href="homepage.php#about">About</a>
    </div>
    <div class="right-section">
      <img src="../images/icon.png" height="90px">
    </div>
  </div>

  <div class="img">
    <div class="bg"></div>
    <div class="box">
      <div class="titulli">
        <h1 id="h1"><strong>Mirë se erdhet në platformën për Reservime Online</strong></h1>
        <?php if (!empty($feedback)) echo "<p class='feedback'>$feedback</p>"; ?>
      </div>

      <form method="POST" action="">
        <div class="form-group">
          <input type="text" name="name" placeholder="Emri" required>
        </div>
        <div class="form-group">
          <input type="number" name="capacity" placeholder="Numri i personave në tavolinë" required>
        </div>
        <div class="form-group">
          <input type="date" name="date" required>
        </div>
        <div class="form-group">
          <textarea name="request" placeholder="Shënoni ndonjë kërkesë shtesë"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="submit">Dërgo</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>