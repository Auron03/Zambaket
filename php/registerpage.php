<?php
session_start();
require_once "dbConn.php";
$db = new dbConn();
$conn = $db->connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $rePassword = $_POST["re-password"];
    $role = $_POST["role"];

    if (empty($username) || empty($email) || empty($password) || empty($rePassword) || empty($role)) {
        echo "Ju lutemi plotesoni te gjitha fushat !";
    } else if ($password != $rePassword) {
        echo "Password nuk perputhen !";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username,email,password,role) VALUES (?,?,?,?)");
        $stmt->execute([$username, $email, $hashedPassword, $role]);

        echo "Regjistrimi u krye me sukses !";
        header("Location: loginpage1.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/loginpage.css">
    <script>
    setTimeout(() => {
        alert("Ju duhet të Kyceni në llogarinë tuaj per të rezervuar");
    }, 800);
    </script>
</head>
<body>
<div class="img1">
    <div class="register">
        <form id="registerForm" method="POST" action="">
            <a href="homepage.php">
            <img src="../images/logo.png" alt="Logo" height="200px">
            </a><br>
            <input type="text" id="firstname" name="username" placeholder="Username"><br>
            <input type="email" id="email" name="email" placeholder="Email"><br>
            <input type="password" id="password" name="password" placeholder="Password"><br>
            <input type="password" id="re-password" name="re-password" placeholder="Re-type Password"><br>
            <input type="text" id="phone" name="phone" placeholder="Phone number"><br><br>
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br><br>
            <button id="submit" type="submit">Regjistrohu</button>
            <div class="kycu">
                <a href="loginpage1.php">Keni llogari? Kyçuni</a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById("registerForm").addEventListener("submit", function(e) {
    const username = document.getElementById("firstname").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const rePassword = document.getElementById("re-password").value;
    const phone = document.getElementById("phone").value.trim();

    if (!username || !email || !password || !rePassword || !phone) {
        alert("Ju lutem plotesoni te gjitha fushat!");
        e.preventDefault();
    }
    if (password.length < 6) {
        alert("Password duhet te kete minimum 6 karaktere!");
        e.preventDefault();
    }
    if (password !== rePassword) {
        alert("Password nuk perputhen!");
        e.preventDefault();
    }
});
</script>
</body>
</html>