<?php

require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
echo ($dbh->checkEmail($_POST["email"])[0][0]);
$dbh->close();

?>