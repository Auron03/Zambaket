<?php
require_once "dbConn.php";

$db = new dbConn();
$conn = $db->connectDB();

if ($conn) {
    echo "Lidhja me databazen funksionon";
} else {
    echo "Lidhja deshtoj";
}
?>