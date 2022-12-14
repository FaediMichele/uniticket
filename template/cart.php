<?php
	$eventi = $templateParams["cart"];
?>

<div class="col-12 contenuti">
    <!-- HEADER -->
    <div class="row">
        <div class="col-12 sfondo-grigio">
            <div class="row">
                <div class="col-12 mt-2">
                    <p class="text-center" id="subTotale">
                        Totale (0 articoli): 0 EUR
                    </P>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3">
                    <button type="submit" id="checkout" name="checkout" value="checkout" <?php if(count($eventi) > 0){ echo 'onclick="checkout()"'; }?> class="<?php if(count($eventi) <= 0){ echo 'button-disable'; } else { echo 'button-orange'; }?> text-uppercase ">Procedi con l'ordine</button>
                </div>
            </div>

            <div id="collapse" class="row justify-content-center pb-2 collapse">
                <div class="col-8 col-sm-6 col-md-4 col-xl-3">
                    <p id="addExecutedP" class="text-orange text-center">Stiamo acquistando i biglietti, un'attimo di pazienza</p>
                </div>
            </div>
        </div>
    </div><!-- FINE HEADER -->
    <div class="border-bottom-son">

        <?php 
		if(count($eventi) > 0){
			foreach($eventi as $evento): 
				$quantity = $evento[1];
				$evento = $evento[0];
				$event = $dbh->getEventInfo($evento)[0];
				//$location = $dbh->getRoomData($evento)[0];
				$img = $dbh->getEventImages($evento);
				$date = new Datetime($event["date"]);
				/*foreach ($event as $key => $value) {	//FOR DEBUG PURPOSES
					echo "Key: $key; Value: $value\n";
				}*/
		?>

        <!--PRODOTTO -->
        <div class="row justify-content-center">
            <div class="col-11 col-lg-10 col-xl-9 cart">
                <!--primo elemento-->
                <a href="eventInfo.php?ID=<?php echo $evento;?>">
                    <!--inizio prima row-->
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-2 col-xl-2 p-0 text-center">
                            <img class="cover-95" src="<?php echo $img[0]["img"] ?>" alt="immagine evento: <?php echo $event["name"]; ?>" />
                        </div>
                        <div class="col-5 col-md-6 col-xl-8">
                            <h3 class="noti-event-date text-white mb-1"><?php echo $date->format('l d/m'); ?></h3>
                            <h4 class="noti-event-name text-gray text-truncate mb-0"><?php echo $event["eventName"]; ?></h4>
                        </div>
                        <div class="col-3 col-sm-4 col-xl-2 text-right">
                            <p id="price-<?php echo $evento ?>" class="text-red font-size-red"><?php echo $event["price"]; ?>???</p>
                        </div>
                    </div>
                </a>
                <!--fine prima row-->
                <!--inizio seconda row-->
                <div class="row mt-2">
                    <div class="col-4 col-sm-3 col-md-2 col-xl-2 reset mx-auto">
                        <div class="row justify-content-center">
                            <button type="button" class="dec-<?php echo $evento ?> select-quantity-cart-left text-white" onclick="decrement('qt-<?php echo $evento ?>')">
                                -
                            </button>
                            <div class="select-quantity-cart-center ">
                                <label for="qt-<?php echo $evento ?>" class="sr-only">Numero elementi carrello</label>
                                <input type="text" id="qt-<?php echo $evento ?>" class="quantity reset text-center text-orange" placeholder="1" value="<?php echo $quantity ?>" disabled>
                            </div>
                            <button type="button" class="inc-<?php echo $evento ?> select-quantity-cart-right text-white" onclick="increment('qt-<?php echo $evento ?>')">+</button>
                        </div>
                    </div>
                    <div class="col-8 col-sm-9 col-md-10 col-xl-10">
                        <button type="button" class="button-red text-white text-uppercase delete-button-cart float-right" onclick="remove('rm-<?php echo $evento ?>')">Rimuovi</button>
                    </div>
                </div>
                <!--fine seconda row-->

            </div>
        </div>
        <!-- FINE PRODOTTO -->

        <?php 
			endforeach; 
		} else {
		?>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <p class="text-red font-size-red text-uppercase">Non sono presenti elementi nel carrello</p>
            </div>
        </div>
        <?php
		}
		?>

    </div>
</div>

<script>
//initialize
var ordersQuantity;
var orders = [];
var checkoutDone = 0;
$(document).ready(function() {
    var tmp = document.getElementsByClassName("quantity");
    ordersQuantity = tmp.length;
    for (var x = 0; x < tmp.length; x++) {
        var id = tmp[x].id;
        id = id.replace('qt-', 'price-');
        orders.push({
            'eventId': parseInt(tmp[x].id.replace('qt-', '')),
            'price': parseInt(document.getElementById(id).innerHTML),
            'quantity': tmp[x].value
        });
    }
    updatePrices();
});


//////////////////////////
//AJAX
var itemCount;
var ackItems;
var ajaxurl = 'ajax.php';

function checkout() {
    $(".collapse").collapse('show');
    for (var x = 0; x < ordersQuantity; x++) {
        $.post(ajaxurl, {
            action: "buyTicket",
            eventId: orders[x].eventId
        }, function(data) {
            data = JSON.parse(data);
            if (data.state == "done") {
                //alert("Acquisto effettuato con successo");
            } else {
                //acquisto fallito
                //alert("Attenzione, c?? stato un problema con un ordine");
                alert(data.state);
            }
        }).done(function() {
            checkoutDone++;
            if (checkoutDone == ordersQuantity) {
                location.reload();
            }
        });
    }
}

function ticketsAvailable(idEvento) {
    var nAvailableTickets;
    //var ajaxurl = 'ajax.php',
    data = {
        'action': 'getTicketsAvailable',
        'idEvent': idEvento
    };
    $.post(ajaxurl, data, function(response) {
        // Response div goes here.
        if (response.state == "done") {
            nAvailableTickets = response.quantity;
            console.log(nAvailableTickets);
        } else {
            alert("An error has occurred");
        }
    });
    return nAvailableTickets;
}


//<!-- Page dynamics -->

function increment(id) {
    //console.log(id);
    var input = document.getElementById(id).value;
    var idEvento = parseInt(id.replace('qt-', ''));
    if (input < 99) {
        input++;
        if ($("#numCartElem > p").html() == 0) {
            $("#numCartElem").removeClass("hidden");
            $("#numCartElemCart").removeClass("hidden");
        }
        $("#numCartElem > p").html(parseInt($("#numCartElem > p").html()) + 1);
        $("#numCartElemCart > p").html(parseInt($("#numCartElemCart > p").html()) + 1);

        var x;
        for (x = 0; x < orders.length; x++) {
            if (orders[x].eventId == idEvento) {
                orders[x].quantity++;
                break;
            }
        }

        $.post(ajaxurl, {
            action: "modifyQuantity",
            eventId: idEvento,
            quantity: 1
        }, function(data) {
            //console.log($msg);
        });

        updatePrices();
    }
    document.getElementById(id).value = input;
    //console.log(ticketsAvailable(idEvento));
}

function decrement(id) {
    //console.log(id);


    var input = document.getElementById(id).value;
    var idEvento = parseInt(id.replace('qt-', ''));
    if (input > 1) {
        $("#numCartElem > p").html(parseInt($("#numCartElem > p").html()) - 1);
        $("#numCartElemCart > p").html(parseInt($("#numCartElemCart > p").html()) - 1);
        input--;
        var x;
        for (x = 0; x < orders.length; x++) {
            if (orders[x].eventId == idEvento) {
                orders[x].quantity--;
                break;
            }
        }

        document.getElementById("price-" + idEvento).innerHTML = (orders[x].quantity * orders[x].price) + "???";

        $.post(ajaxurl, {
            action: "modifyQuantity",
            eventId: idEvento,
            quantity: -1
        }, function(data) {
            //console.log($msg);
        });

        updatePrices();
    }
    document.getElementById(id).value = input;
}

function remove(idEvento) {
    idEvento = idEvento.replace('rm-', '');
    var qti;
    for (var x = 0; x < orders.length; x++) {
        if (orders[x].eventId == idEvento) {
            qti = orders[x].quantity;
            break;
        }
    }
    $("#numCartElem > p").html(parseInt($("#numCartElem > p").html()) - 1);
    $("#numCartElemCart > p").html(parseInt($("#numCartElemCart > p").html()) - 1);
    if ($("#numCartElem > p").html() == 0) {
        $("#numCartElem").addClass("hidden");
        $("#numCartElemCart").addClass("hidden");
    }

    $.post(ajaxurl, {
        action: "modifyQuantity",
        eventId: idEvento,
        quantity: -qti
    }, function(data) {
        //console.log($msg);
        location.reload(true);
    });

}

function updatePrices() {
    var result = 0;
    var nElements = 0;
    for (var x = 0; x < orders.length; x++) {
        result += (orders[x].price * orders[x].quantity);
        nElements += parseInt(orders[x].quantity);
        document.getElementById("price-" + orders[x].eventId).innerHTML = (orders[x].quantity * orders[x].price) + "???";
    }

    document.getElementById("subTotale").innerHTML = "Totale (" + nElements + " articoli): " + result + " EUR";
    //document.getElementById("numCartElem").innerHTML = nElements;
}
</script>