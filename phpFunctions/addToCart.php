<?php

if(isset($_COOKIE["sessionId"])){
    require_once("../db/database.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
    echo $dbh->addTicketToCart($_COOKIE["sessionId"], $_POST["idEvent"], $_POST["quantity"])["TotalTicket"];
    $dbh->close();
} else{
    echo '0';
}
?>