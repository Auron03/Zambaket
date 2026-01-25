<?php
    session_start();

    if(!isset($_SESSION["user_id"]) || $_SESSION["role"] !="admin"){
      header("Location: loginpage1.php");
      exit();
    }

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
  <p>Ketu mund te shtosh , ndryshosh ose fshis te dhena sipas rolit te administratorit</p>
</body>
</html>