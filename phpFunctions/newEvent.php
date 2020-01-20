<?php

require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
$idEvent = $dbh->createEvent($_COOKIE["sessionId"], $_POST["eventTitle"], $_POST["eventDescription"],
    $_POST["eventArtist"], $_POST["eventPrice"], $_POST["eventDate"], $_POST["idRoom"]);
echo $idEvent;
if($idEvent != 0){
    require_once("addImageToEvent.php");
}
header("location: ../index.php");
?>