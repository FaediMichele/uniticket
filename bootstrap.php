<?php
session_start();

require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
$templateParams["sidebar"] = "sidebar.php";
if(!isset($_COOKIE["sessionId"])){
      $templateParams["sidebar"] = "sidebarGuest.php";
}else{
      $userIsLogged = $dbh->userIsLogged($_COOKIE["sessionId"])["0"]["0"]; // the ["0"]["0"] out of reason. just mysqli that do stuff
      if(isset($forGuest) && $forGuest && $userIsLogged == 0){
            $templateParams["sidebar"] = "sidebarGuest.php";
      } else if($userIsLogged == 0){
            header("Location: login.php?nextPage=" . $templateParams["nome"]);
      } else{
            $userParam = $dbh->getUserParam($_COOKIE["sessionId"]);
            if(!isset($userParam["manager"])){
                  $userPermission = 0;
            } else{
                  $userPermission = $userParam["manager"] + $userParam["admin"] * 10;
            }
            if($userPermission > 0 && $userPermission < 10){
                  $templateParams["advSidebar"] = "sidebarAdvanced.php";	//abilita la parte "avanzata" per gli organizzatori
            } else if($userPermission >= 10){
                  $templateParams["sidebar"] = "sidebarAdmin.php";
            } else if($userPermission == 0 && isset($forManager) && $forManager){
                  header("Location: index.php");
            } else if($userPermission < 10 && isset($forAdmin) && $forAdmin){
                  header("Location: index.php");
            }
      }
}

$templateParams["js"] = array("./js/sessionManager.js");
define("UPLOAD_DIR", "./upload/")
?>