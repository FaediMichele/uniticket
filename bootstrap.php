<?php
session_start();

require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
$templateParams["sidebar"] = "sidebar.php";

if(!isset($forGuest) || !$forGuest){
   $res = $dbh->userIsLogged($_COOKIE["sessionId"])["0"]["0"]; // the ["0"]["0"] out of reason. just mysqli that do stuff
   if(!isset($_COOKIE["sessionId"]) || $res == 0){
      header("Location: login.php");
   } else {
      $userParam = $dbh->getUserParam($_COOKIE["sessionId"]);
      $userPermission = $userParam["manager"] + $userParam["admin"] * 10;
      if($userPermission > 0 && $userPermission < 10){
      $templateParams["advSidebar"] = "sidebarAdvanced.php";	//abilita la parte "avanzata" per gli organizzatori
      } else if($userPermission >= 10){
         $templateParams["sidebar"] = "sidebarAdmin.php";
      }
   }
}

$templateParams["js"] = array("./js/sessionManager.js");
define("UPLOAD_DIR", "./upload/")
?>