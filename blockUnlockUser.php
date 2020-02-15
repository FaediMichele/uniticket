<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Blocca o sblocca un utente";
$templateParams["nome"] = "blockUnlockUser.php";

//$templateParams["eventi"] = $dbh->getEvents();
require("template/base.php");

$dbh->close();
?>