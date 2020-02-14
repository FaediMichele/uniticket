<?php
require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
echo $dbh->addTicketToCart($_COOKIE["sessionId"], $_POST["idEvent"], -1)["TotalTicket"];
$dbh->close();
?>