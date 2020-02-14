<?php

require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
echo ($dbh->checkUsername($_POST["username"])[0][0]);
$dbh->close();

?>