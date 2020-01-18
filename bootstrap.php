<?php
session_start();

function console_log( $data ){
    echo '<script> console.log("';
    echo $data;
    echo '");</script>';
  }

 require_once("db/database.php");
 $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

 if(!isset($notRedirect) || !$notRedirect){
     if(!isset($_COOKIE["sessionId"])){
         header("Location: login.php");
     }
 }

$templateParams["js"] = array("./js/sessionManager.js");
define("UPLOAD_DIR", "./upload/")
?>