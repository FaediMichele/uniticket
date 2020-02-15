<?php
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Home";
$templateParams["nome"] = "home.php";


//$templateParams["eventi"] = $dbh->getEvents();
if(isset($_GET["search"])){
    $textSearch = "%" . wordwrap($_GET["search"], 1, "%", true) . "%";
    $templateParams["eventi"] = $dbh->searchEvent($textSearch);
}else{
    $templateParams["eventi"] = $dbh->getUpcomingEvents($_COOKIE["sessionId"]);
}
require("template/base.php");

$dbh->close();
?>