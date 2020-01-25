<?php
	require("db/database.php");
	$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");

	$response = new \stdClass();
	$response->state = 'error';

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'addToCart':
                $dbh->addEventToCart($_COOKIE["sessionId"], $_POST['eventId']);
				//echo 'done';
                break;
			case 'removeFromCart':
                $dbh->removeTicketFromCart($_COOKIE["sessionId"], $_POST["eventId"]);
				//echo 'done';
				//$response[] = 'done';
                break;
			case 'checkout':
                //echo 'done';
                break;
			default:
				//echo 'Unknown request';
				break;
        }
    }

	$responseJSON = json_encode($response);
	echo $responseJSON;

	$dbh->close();
?>