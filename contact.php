<?php
require_once "dbConn.php";
$db = new dbConn();
$conn = $db->connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($message)) {
        echo "Ju lutem plotësoni fushat e detyrueshme!";
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)");
        $stmt->execute([$name,$email,$subject,$message]);
        echo "Mesazhi u dërgua me sukses!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us</title>
</head>
<body>
  <h1>Na kontaktoni</h1>
  <form method="POST" action="">
    <input type="text" name="name" placeholder="Emri" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="subject" placeholder="Subjekti"><br>
    <textarea name="message" placeholder="Mesazhi" required></textarea><br>
    <button type="submit">Dërgo</button>
  </form>
</body>
</html>


<script>
document.querySelector("form").addEventListener("submit", function(e) {
  const name = document.querySelector("[name='name']").value.trim();
  const email = document.querySelector("[name='email']").value.trim();
  const message = document.querySelector("[name='message']").value.trim();

  if (!name || !email || !message) {
    alert("Ju lutem plotësoni fushat e detyrueshme!");
    e.preventDefault();
  }
});
</script>