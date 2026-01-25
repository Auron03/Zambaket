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
        <form id="loginForm">
            <img src="images/logo.png" alt="Logo" height="200px"><br>

            <input type="email" id="email" placeholder="Email"><br><br>
            <input type="password" id="password" placeholder="Password"><br><br>

            <button id="submit" type="submit">Log In</button>
        </form>
    </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    const savedUser = JSON.parse(localStorage.getItem("user"));

    if (!savedUser) {
        alert("Nuk ekziston asnjë llogari. Ju lutem regjistrohuni!");
        window.location.href = "loginpage.html";
        return;
    }

    if (email === savedUser.email && password === savedUser.password) {
        alert("Login i suksesshëm!");
        window.location.href = "reservationPage.html";
    } else {
        alert("Email ose Password i pasaktë!");
    }
});
</script>

</body>
</html>
