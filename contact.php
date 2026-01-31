<?php
require_once "dbConn.php";
$db = new dbConn();
$conn = $db->connectDB();

$feedback = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        $feedback = "Ju lutem plotësoni fushat e detyrueshme!";
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)");
        $stmt->execute([$name,$email,$subject,$message]);
        $feedback = "Mesazhi u dërgua me sukses!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
  <link rel="stylesheet" href="header.css">
  <link rel="stylesheet" href="contact.css">

</head>
<body>


  <div class="header">
    <div class="left-section">
      <img src="images/logo.png" alt="Logo" height="150px" width="150px">
    </div>
    <div class="middle-section">
      <a href="homepage.php">Home</a>
      <a href="homepage.php#eatdrink">Eat & Drink</a>
      <a href="contact.php">Contact</a>
      <a href="homepage.php#about">About</a>
    </div>
    <div class="right-section">
      <button class="rezervo">
        <a href="register.php" id="link">Reserve Now</a>
      </button>
    </div>
  </div>


  <div class="img">
    <div class="bg"></div>


    <div class="box">
      <div class="titulli">
        <h1 id="h1"><strong>Na kontaktoni</strong></h1>
        <?php if (!empty($feedback)) echo "<p style='color:white;'>$feedback</p>"; ?>
      </div>

           <form method="POST" action="">
        <div class="form-group">
          <input type="text" name="name" placeholder="Emri" required>
        </div>
        <div class="form-group">
          <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
          <input type="text" name="subject" placeholder="Subjekti">
        </div>
        <div class="form-group">
          <textarea name="message" placeholder="Mesazhi" required></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="submit">Dërgo</button>
        </div>
      </form>


    </div>
  </div>

</body>
</html>
