<?php
session_start();
session_unset();
session_destroy();
header("Location: loginpage1.php");
exit();
?>