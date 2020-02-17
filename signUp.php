<?php
$forGuest = true;
$templateParams["nome"] = "signUp.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - SignUp";


require_once("template/baseLogin.php");

$dbh->close();
?>