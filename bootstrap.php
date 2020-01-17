<?php
session_start();

//require_once("db/database.php");
//$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

$templateParams["js"] = array("./js/sessionManager.js");
define("UPLOAD_DIR", "./upload/")
?>