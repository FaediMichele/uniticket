<?php
$notRedirect = true;
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - SignUp";
$templateParams["nome"] = "signUp.php";

require_once("template/baseLogin.php");
$dbh->close();
?>