<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
$date = explode(" ", $_POST["eventDate"]);
$date = $date[0] . " " . $_POST["eventTime"];
$idEvent = $dbh->createEvent($_COOKIE["sessionId"], $_POST["eventTitle"], $_POST["eventDescription"],
    $_POST["eventArtist"], $_POST["eventPrice"], $date, $_POST["idRoom"]);
if($idEvent != 0){
    require_once("addImageToEvent.php");
}
header("location: ../index.php?eventCreated");
?>