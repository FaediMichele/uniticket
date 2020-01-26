<div class="col-12 contenuti">
    <!-- HEADER -->
    <div class="row">
        <div class="col-12 sfondo-grigio">
            <div class="row">
                <div class="col-12 mt-2">
                    <p class="text-center">
                        Totale provvisorio( 3 articoli): EUR 24,00
                    </P>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" id="checkout" name="checkout" value="checkout" onclick="checkout()"
                        class="button-orange text-uppercase">Procedi con l'ordine</button>
                </div>
            </div>
        </div>
    </div><!-- FINE HEADER -->

    <div class="border-bottom-son">

        <?php 
		$eventi = $templateParams["cart"];
		//$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
		foreach($eventi as $evento): 
			$quantity = $evento[1];
			$evento = $evento[0];
			$event = $dbh->getEventInfo($evento)[0];
			//$location = $dbh->getRoomData($evento)[0];
			$img = $dbh->getEventImages($evento);
			$date = new Datetime($event["date"]);

		?>


        <!-- PRIMO PRODOTTO -->
        <div class="row justify-content-center">
            <div class="col-11 cart">
                <!--primo elemento-->
                <!--inizio prima row-->
                <div class="row">
                    <div class="col-4 p-0 text-center">
                        <img class="cover-95" src="<?php echo $img[0]["img"] ?>"
                            alt="immagine evento: <?php echo $event["name"]; ?>" />
                    </div>
                    <div class="col-6">
                        <h3 class="noti-event-date mb-1"><?php echo $date->format('l d/m'); ?></h3>
                        <h4 class="noti-event-name text-truncate mb-0"><?php echo $event["eventName"]; ?></h4>
                    </div>
                    <div class="col-1">
                        <p class="text-red font-size-red"><?php echo $event["price"]; ?>€</p>
                    </div>
                </div>
                <!--fine prima row-->
                <!--inizio seconda row-->
                <div class="row mt-2">
                    <div class="col-4 reset mx-auto">
                        <div class="row justify-content-center">
                            <button type="button" class="dec-<?php echo $evento ?> select-quantity-cart-left text-white"
                                onclick="decrement('qt-<?php echo $evento ?>')">
                                <div class="minus"></div>
                            </button>
                            <div class="select-quantity-cart-center ">
                                <input type="quantity" id="qt-<?php echo $evento ?>"
                                    class="quantity reset text-center text-orange" placeholder="1"
                                    value="<?php echo $quantity ?>" disabled>
                            </div>
                            <button type="button"
                                class="inc-<?php echo $evento ?> select-quantity-cart-right text-white"
                                onclick="increment('qt-<?php echo $evento ?>')">+</button>
                        </div>
                    </div>
                    <div class="col-8">
                        <button type="button"
                            class="button-red text-white text-uppercase delete-button-cart float-right">Rimuovi</button>
                    </div>
                </div>
                <!--fine seconda row-->
            </div>
        </div>
        <!-- FINE PRIMO PRODOTTO -->

        <?php 
			endforeach; 
		?>

    </div>
</div>



<!-- AJAX -->
<script>
var itemCount;
var ackItems;

function checkout() {
    //raccogli id evento e quantità associata
    //il server controlla di avere abbastanza biglietti disponibili, in caso affermativo acquista
    itemCount = 0;
    ackItems = 0;

    var ajaxurl = 'ajax.php';
    var data = [];

    var tmp = document.getElementsByClassName("quantity");
    itemcount = tmp.length;
    for (var x = 0; x < tmp.length; x++) {
        var id = tmp[x].id;
        id = id.replace('qt-', '');
        var value = tmp[x].value;

        data.push({
            'eventId': "checkout",
            'requestedEvent': id,
            'quantity': value
        });
        /*$.post(ajaxurl, data, function(response) {
        	// Response div goes here.
        	if(response == "done"){
        		ackItems++;
        		if(itemCount == ackItems){
        			alert("Acquisto effettuato con successo");
        		}
        	} else {
        		//acquisto fallito
        		alert("Attenzione, cè stato un problema con un ordine");
        	}
        });*/
    }

    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            'action': 'checkout',
            'json': JSON.stringify({
                tickets: data
            })
        },
        dataType: "json",
        done: function($msg) {
            console.log($msg);
        }
    });
}
/*
$(document).ready(function() {
    $(document).getElementById("checkout").click(function() {
        var clickBtnValue = $(this).val();
        var ajaxurl = 'ajax.php',
            data = {
                'eventId': clickBtnValue,
				'requestedEvent': 1,
				'quantity': 1
            };
        $.post(ajaxurl, data, function(response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    });
});*/

function ticketsAvailable(idEvento) {
    var ajaxurl = 'ajax.php',
        data = {
            'eventId': "getTicketsAvailable",
        };
    $.post(ajaxurl, data, function(response) {
        // Response div goes here.
        nAvailableTickets = response;
        console.log(nAvailableTickets);
        alert("action performed successfully");
    });
}


//<!-- Page dynamics -->

function increment(id) {
    //console.log(id);
    var input = document.getElementById(id).value;
    var idEvento = id.replace('qt-', '');
    if (input < 99) input++;
    document.getElementById(id).value = input;
}

function decrement(id) {
    //console.log(id);
    var input = document.getElementById(id).value;
    if (input > 1) input--;
    document.getElementById(id).value = input;
}
</script>





<!--roba di cri -->

<!-- PRIMO PRODOTTO - ->
        <div class="row justify-content-center">
            <div class="col-11 cart">
                <!- -primo elemento- ->
                <!- -inizio prima row- ->
                <div class="row">
                    <div class="col-4 p-0 text-center">
                        <img class="image image-cart" src="./img/locandina.jpg">
                    </div>
                    <div class="col-6">
                        <h3 class="noti-event-date mb-1">GIO. 12. DIC</h3>
                        <h4 class="noti-event-name text-truncate mb-0">HAPPY NEW YEAR 2020</h4>
                    </div>
                    <div class="col-1">
                        <p class="text-red font-size-red">
                            8€
                        </p>
                    </div>
                </div>
                <!- -fine prima row- ->
                <!- -inizio seconda row- ->
                <div class="row mt-2">
                    <div class="col-4 reset mx-auto">
                        <div class="row justify-content-center">
                            <button type="button" class="p-0 select-quantity-cart-left text-white">
                                <div class="minus"></div>
                            </button>
                            <div class="p-0 select-quantity-cart-center ">
                                <input type="quantity" class="quantity reset text-center text-orange" placeholder="1">
                            </div>
                            <button type="button" class="p-0 select-quantity-cart-right text-white">+</button>
                        </div>
                    </div>
                    <div class="col-8">
                        <button type="button"
                            class="button-red text-white text-uppercase delete-button-cart float-right">Rimuovi</button>
                    </div>
                </div>
                <!- -fine seconda row- ->
            </div>
        </div>
        <!- - FINE PRIMO PRODOTTO -->