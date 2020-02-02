<?php
var_dump($_POST["imageNumbers"]);
asort($_POST["imageNumbers"]);
var_dump($_POST["imageNumbers"]);
foreach($_POST["imageNumbers"] as $key => $val){
/*for($num = 0; $num < count($_POST["imageNumbers"]); $num++) {*/
/*    $i = $_POST["imageNumbers"][$num];*/

    if (strlen($_POST["image" . ($key+1)]) < 500000) {
         list($imageFileType, $base) = explode(",", $_POST["image" . ($key+1)]);
        $imageFileType = explode(";", explode("/", $imageFileType)[1])[0];
        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif" ) {
            $result = $dbh->addImageToEvent($_COOKIE["sessionId"], $idEvent, $val, $_POST["image" . ($key+1)]);
            var_dump($result);
        } else {
            echo "i'm here";
        }
    } else{
        echo "i'm here1";
    }
}
?>