<?php
	require("db/database.php");
	$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

	$response = new \stdClass();
	$response->state = 'error';

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'modifyQuantity':
                if($dbh->addTicketToCart($_COOKIE["sessionId"], $_POST['eventId'], $_POST['quantity'])){
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
				$response->quantity = $dbh->ticketAvailable($_POST["eventId"]);
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