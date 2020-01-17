<?php
require_once("bootstrap.php");

if(isset($_COOKIE["sessionId"])){
    header("Location: home.php") ;
}

$templateParams["titolo"] = "UniTicket - Login";
$templateParams["nome"] = "login.php";
//$templateParams["css"] = array("./css/checbox.css");


require_once("template/baseLogin.php");
?>