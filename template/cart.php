
<div class="col-12 contenuti">
    <!-- HEADER -->
    <div class="row">
        <div class="col-12 sfondo-grigio">
            <div class="row">
                <div class="col-12 mt-2">
                    <p class="text-center" id="subTotale">
                        Totale : EUR ??? da fare
                    </P>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3">
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
			/*foreach ($event as $key => $value) {	//FOR DEBUG PURPOSES
				echo "Key: $key; Value: $value\n";
			}*/
		?>

        <!--PRODOTTO -->
        <div class="row justify-content-center">
            <div class="col-11 col-lg-10 col-xl-9 cart">
                <!--primo elemento-->
                <!--inizio prima row-->
                <div class="row">
                    <div class="col-4 col-sm-3 col-md-2 col-xl-2 p-0 text-center">
                        <img class="cover-95" src="<?php echo $img[0]["img"] ?>"
                            alt="immagine evento: <?php echo $event["name"]; ?>" />
                    </div>
                    <div class="col-5 col-md-6 col-xl-8">
                        <h3 class="noti-event-date mb-1"><?php echo $date->format('l d/m'); ?></h3>
                        <h4 class="noti-event-name text-truncate mb-0"><?php echo $event["eventName"]; ?></h4>
                    </div>
                    <div class="col-3 col-sm-4 col-xl-2 text-right">
                        <p id="price-<?php echo $evento ?>" class="text-red font-size-red"><?php echo $event["price"]; ?>€</p>
                    </div>
                </div>
                <!--fine prima row-->
                <!--inizio seconda row-->
                <div class="row mt-2">
                    <div class="col-4 col-sm-3 col-md-2 col-xl-2 reset mx-auto">
                        <div class="row justify-content-center">
                            <button type="button" class="dec-<?php echo $evento ?> select-quantity-cart-left text-white"
                                onclick="decrement('qt-<?php echo $evento ?>')">
                                -
                            </button>
                            <div class="select-quantity-cart-center ">
                                <input type="text" id="qt-<?php echo $evento ?>"
                                    class="quantity reset text-center text-orange" placeholder="1"
                                    value="<?php echo $quantity ?>" disabled>
                            </div>
                            <button type="button"
                                class="inc-<?php echo $evento ?> select-quantity-cart-right text-white"
                                onclick="increment('qt-<?php echo $evento ?>')">+</button>
                        </div>
                    </div>
                    <div class="col-8 col-sm-9 col-md-10 col-xl-10">
                        <button type="button"
                            class="button-red text-white text-uppercase delete-button-cart float-right" onclick="remove('rm-<?php echo $evento ?>')" >Rimuovi</button>
                    </div>
                </div>
                <!--fine seconda row-->
            </div>
        </div>
        <!-- FINE PRODOTTO -->

        <?php 
			endforeach; 
		?>

    </div>
</div>



<!---------------------------------------------------------------------------------------------------------------->
<script>
//initialize
var tmp = document.getElementsByClassName("quantity");
var ordersQuantity = tmp.length;
var orders = [];
for(var x=0; x<tmp.length; x++){
	var id = tmp[x].id;
    id = id.replace('qt-', 'price-');
	orders.push({ 
		'eventId': parseInt(tmp[x].id.replace('qt-', '')),
		'price': parseInt(document.getElementById(id).innerHTML),
		'quantity': tmp[x].value
		});
}
updateSubtotal();


//////////////////////////
//AJAX
var itemCount;
var ackItems;
var ajaxurl = 'ajax.php';

function checkout() {
    //raccogli id evento e quantità associata
    //il server controlla di avere abbastanza biglietti disponibili, in caso affermativo acquista
    itemCount = 0;
    ackItems = 0;

    //var ajaxurl = 'ajax.php';
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

function postFunction(packet){
	/*
		var packet = [];
		packet.push({
            'actionId': "azione",
            'dati': ... ,
        });
	*/
	//var ajaxurl = 'ajax.php';

	console.log(packet["actionId"]);
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            'action': packet["actionId"],
            'json': JSON.stringify(packet)
        },
        dataType: "json",
        done: function($msg) {
            console.log($msg);
        }
    });
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
		if(response.state == "done"){
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

		for(var x=0; x<orders.length; x++){
			if(orders[x].eventId == idEvento){
				orders[x].quantity++;
				break;
			}
		}

        $.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				'action': "modifyQuantity",
				'eventId': idEvento,
				'quantity': 1
			},
			dataType: "json",
			done: function($msg) {
				//console.log($msg);
			}
		});
		updateSubtotal();
	}
    document.getElementById(id).value = input;
	//console.log(ticketsAvailable(idEvento));
}

function decrement(id) {
    //console.log(id);
    var input = document.getElementById(id).value;
	var idEvento = parseInt(id.replace('qt-', ''));
    if (input > 1) {
		input--;

		for(var x=0; x<orders.length; x++){
			if(orders[x].eventId == idEvento){
				orders[x].quantity--;
				break;
			}
		}

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				'action': "modifyQuantity",
				'eventId': idEvento,
				'quantity': -1
			},
			dataType: "json",
			done: function($msg) {
				//console.log($msg);
			}
		});
		updateSubtotal();
	}
    document.getElementById(id).value = input;
}

function remove(idEvento){
	idEvento = idEvento.replace('rm-', ''); 
	var qti;
	for(var x=0; x<orders.length; x++){
		if(orders[x].eventId == idEvento){
			qti = orders[x].quantity;
			break;
		}
	}

	$.ajax({
		url: ajaxurl,
		type: 'POST',
		data: {
			'action': "modifyQuantity",
			'eventId': idEvento,
			'quantity': -qti
		},
		dataType: "json",
		done: function($msg) {
			//console.log($msg);
		}
	});
	//location.reload();
}

function updateSubtotal(){
	var result = 0;
	var nElements = 0;
	for(var x=0; x<orders.length; x++){
		result += (orders[x].price * orders[x].quantity);
		nElements += parseInt(orders[x].quantity);
	}

	document.getElementById("subTotale").innerHTML = "Totale (" + nElements +" articoli): " + result +"EUR";
}

</script>

