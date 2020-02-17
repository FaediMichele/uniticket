<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
if(strlen($_POST["date"]) == 0){
    $day = (new DateTime())->format('Y-m-d');
    if(strlen($_POST["time"]) == 0){
        $time = (new DateTime())->format('H:i:s');
        $date = $day . " " . $time;
    } else{
        $date = $day . " " . $_POST["time"];
    }
} else{
    $date = explode(" ", $_POST["date"]);
    if(strlen($_POST["time"]) == 0){
        $time = (new DateTime())->format('H:i:s');
        $date = $date[0] . " " . $time;
    } else{
        $date = $date[0] . " " . $_POST["time"];
    }
}

$res = $dbh->createNotice($_COOKIE["sessionId"], $_POST["idEvent"], $_POST["message"], $date);
var_dump($res);
header("location: ../createNotice.php");
?>