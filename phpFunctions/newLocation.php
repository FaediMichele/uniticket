<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
var_dump($_POST["email"]);
$res = $dbh->addLocation($_COOKIE["sessionId"], $_POST["name"], $_POST["address"],
    $_POST["cap"], $_POST["tel"], $_POST["email"]); 
    var_dump($res);
header("location: ../index.php");
?>