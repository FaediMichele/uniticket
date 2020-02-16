<?php
$manager = (int) isset($_POST["manager"]);


require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
echo "lezzo";

if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $code = $dbh->createUser($_POST["username"], $_POST["password"], $_POST["email"], $manager);
    $dbh->close();
    $to_email = $_POST["email"];
    echo $to_email;
    $subject = 'Conferma mail per Uniticket';
    $message = 'Clicca su questo link per confermare la mail: http://localhost/repo/uniticket/confirmMail.php?code=' . $code;
    $headers = 'From: Uniticket noreply-uniticket@gmail.com';
    if(mail($to_email, $subject, $message, $headers)) {
        header("Location: ../message.php?name=" . "Creazione account"."&message="."Ti abbiamo inviato una mail di conferma") ;
    } else{
        header("Location: ../message.php?name=" . "Errore"."&message="."Abbiamo riscontrato un errore con la mail") ;
    }
} else{
    header("Location: ../message.php?name=" . "Errore"."&message="."Abbiamo riscontrato un errore con la mail") ;
}
?>