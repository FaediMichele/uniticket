<?php
echo "lezzo";
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
echo "unzo";
$date = explode(" ", $_POST["eventDate"]);
$date = $date[0] . " " . $_POST["eventTime"];
var_dump($date);
$idEvent = $dbh->createEvent($_COOKIE["sessionId"], $_POST["eventTitle"], $_POST["eventDescription"],
    $_POST["eventArtist"], $_POST["eventPrice"], $date, $_POST["idRoom"]);
echo "il foco li fsciuuu";
echo $idEvent . "uudiu";
if($idEvent != 0){
    require_once("addImageToEvent.php");
}
header("location: ../index.php?eventCreated");
?>