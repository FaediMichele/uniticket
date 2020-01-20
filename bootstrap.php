<?php
session_start();

 require_once("db/database.php");
 $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

 if(!isset($forGuest) || !$forGuest){
     $res = $dbh->userIsLogged($_COOKIE["sessionId"])["0"]["0"]; // the ["0"]["0"] out of reason. just mysqli that do stuff
     if(!isset($_COOKIE["sessionId"]) || $res == 0){
        header("Location: login.php");
     } else {
	    $isUserAdmin = $dbh->getUserParam($_COOKIE["sessionId"])["manager"];
	    if($isUserAdmin > 0){
 		    $templateParams["advSidebar"] = "sidebarAdvanced.php";	//abilita la parte "avanzata" per gli organizzatori
        }
    }
 }

$templateParams["js"] = array("./js/sessionManager.js");
define("UPLOAD_DIR", "./upload/")
?>