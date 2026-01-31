<?php
    session_start();
    require_once "dbConn.php";
    $db = new dbConn();
    $conn = $db->connectDB();

   $email = '';
   $password = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = isset($_POST["email"]) ? strtolower(trim($_POST["email"])) : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";

        if(empty($email) || empty($password)){
            echo "Ju lutem plotesoni te gjitha fushat!";
        }
        else {
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($user && isset($user["PASSWORD"])) {
            if (password_verify($password, $user["PASSWORD"])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];

                if ($user["role"] == "admin") {
                    header("Location: adminDashboard.php");
                    exit();
                } else {
                    header("Location: reservationPage.php");
                    exit();
                }
            } else {
                echo "Email ose Password i pasakt";
            }
        } else {
            echo "Email ose Password i pasakt";
        }
        }
    }





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginpage.css">
</head>
<body>

<div class="img1">
    <div class="register">
        <form id="loginForm" method="POST" action="">
            <img src="images/logo.png" alt="Logo" height="200px"><br>

            <input type="email" id="email" name="email" placeholder="Email"><br><br>
            <input type="password" id="password" name="password" placeholder="Password"><br><br>

            <button id="submit" type="submit">Log in</button>
        </form>
    </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e) {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    if (!email || !password) {
        alert("Ju lutem plotësoni të gjitha fushat!");
        e.preventDefault();
    }
});

</script>


</body>
</html>
