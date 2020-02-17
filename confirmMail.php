<?php
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

$confirmResult = $dbh->confirmMail($_GET["code"]);

$name = "Conferma mail";
if($confirmResult == 0){
    $message = "C'è stato un problema con la richiesta";
} else{
    $message = "La mail è stata confermata";
}

header("Location: message.php?name=" . $name . "&message=" . $message . '&link=login.php&linkName=Vai alla home');

$dbh->close();
?>