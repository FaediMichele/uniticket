<?php
$forGuest = true;
$templateParams["nome"] = "home.php";
require_once("bootstrap.php");

$templateParams["titolo"] = "UniTicket - Home";



//$templateParams["eventi"] = $dbh->getEvents();
if(isset($_GET["search"])){
    $textSearch = "%" . wordwrap($_GET["search"], 1, "%", true) . "%";
    $templateParams["eventi"] = $dbh->searchEvent($textSearch);
}else if(isset($_COOKIE["sessionId"])){
    $templateParams["eventi"] = $dbh->getUpcomingEvents($_COOKIE["sessionId"]);
} else{
    $templateParams["eventi"] = $dbh->getUpcomingEvents(0);
}
require("template/base.php");

$dbh->close();
?>