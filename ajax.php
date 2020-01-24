<?php
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'addToCart':
                addTicketToCart($_COOKIE["sessionId"], $_GET["eventId"], $_GET["quantity"]);
                break;
			case 'removeFromCart':
                removeTicketFromCart($_COOKIE["sessionId"], $_GET["eventId"], $_GET["quantity"]);
                break;
			case 'checkout':
                
                break;
        }
    }
?>