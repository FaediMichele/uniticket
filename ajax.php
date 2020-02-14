<?php
	require("db/database.php");
	$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

	$response = new \stdClass();
	$response->state = 'error';

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'addToCart':
                if($dbh->addEventToCart($_COOKIE["sessionId"], $_POST['eventId'])){
					$response->state = 'done';
				} else {
					$response->state = 'action failed';
				}
                break;

			case 'removeFromCart':
				if($dbh->removeTicketFromCart($_COOKIE["sessionId"], $_POST["eventId"])){
					$response->state = 'done';
				} else {
					$response->state = 'action failed';
				}
                break;

			case 'checkout':
				if($dbh->checkout($_COOKIE["sessionId"])){
					$response->state = 'done';
				} else {
					$response->state = 'action failed';
				}
                break;

			case 'getTicketsAvailable':
				$response->state = 'done';
				$response->quantity = $dbh->ticketAvailable(/*$_POST["eventId"]*/1);
				break;

			default:
				$response->state = 'Unknown request';
				break;
        }
    }

	$responseJSON = json_encode($response);
	echo $responseJSON;

	$dbh->close();
?>