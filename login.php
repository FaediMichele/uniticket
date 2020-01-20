<?php
$forGuest = true;
require_once("bootstrap.php");

if(isset($_COOKIE["sessionId"]) && $dbh->userIsLogged($_COOKIE["sessionId"])["0"]["0"] != 0){
    header("Location: index.php") ;
}

$templateParams["titolo"] = "UniTicket - Login";
$templateParams["nome"] = "login.php";


require_once("template/baseLogin.php");

$dbh->close();
?>