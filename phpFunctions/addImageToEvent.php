<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

// Check file size
$num = 1;
while(isset($_POST["image" . $num])){
    if (strlen($_POST["image" . $num]) < 500000) {
         list($imageFileType, $base) = explode(",", $_POST["image" . $num]);
        $imageFileType = explode(";", explode("/", $imageFileType)[1])[0]   ;
        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
            $result = $dbh->addImageToEvent($_COOKIE["sessionId"], $idEvent, $num, $_POST["image" . $num]);
        }
    }
    $num++;
}
?>