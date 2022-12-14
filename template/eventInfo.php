<!-- inizio pagina infoevent -->
<div class="col-12">
    <div class="row contenuti">

        <?php 
				$eventId = $templateParams["evento"];
                $event = $dbh->getEventInfo($eventId)[0];
                $ticketAvaliable = $dbh->getTicketAvaliable($_GET["ID"])[0];
				//var_dump($event);
				$location = $dbh->getRoomData($eventId)[0];
				$img = $dbh->getEventImages($eventId);
				$date = new Datetime($event["date"]);
				//var_dump($img);
				/*foreach ($event as $key => $value) {
					echo "Key: $key; Value: $value\n";
				}*/
			?>
        <article class="col-12 home-post">
            <div class="row">
                <header class="col-12 p-0">
                    <div id="event" class="carousel slide" data-ride="carousel">
                        <?php if(count($img) > 1){ ?>
                        <ol class="carousel-indicators">
                            <li data-target="#event" data-slide-to="0" class="active">
                            </li>
                            <?php for ($i = 1; $i < count($img); $i++) { ?>
                            <li data-target="#event" data-slide-to="<?php echo $i ?>">
                            </li>
                            <?php } ?>
                        </ol>
                        <?php } ?>
                        <div class="carousel-inner">
                            <div class="carousel-item active height-500">
                                <img src="<?php echo $img[0]["img"] ?>" alt="immagine evento: <?php echo $event["eventName"]; ?>" class="cover-100-percent height-500" />
                            </div>
                            <?php
                                
								for ($i = 1; $i < count($img); $i++) {
									
									$value = $img[$i]; ?>
                            <div class="carousel-item height-500">
                                <img src="<?php echo $value["img"] ?>" alt="immagine evento: <?php echo $event["eventName"]; ?>" class="cover-100-percent height-500" />
                            </div>
                            <?php } ?>
                        </div>
                        <?php if(count($img) > 1){ ?>
                        <a class="carousel-control-prev" href="#event" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#event" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <?php } ?>
                    </div>
                </header>
            </div>
            <section class="row mt-2 mb-2 pb-2 border-bottom">
                <div class="col-12 text-post">
                    <h2><?php echo $date->format('l d m'); ?></h2>
                    <h3><?php echo $event["locationName"]; ?> -
                        <span><?php echo $event["roomName"]; ?></span>
                    </h3>
                    <h4><?php echo $event["eventName"]; ?> <span><?php echo $event["artist"]; ?></span></h4>
                </div>
            </section>
            <footer class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col-11">
                            <p class="mb-0 text-uppercase">Orario di apertura : <span class="text-gray"><?php echo $date->format('H:i'); ?></span></p>
                            <p class="mb-0 text-uppercase">Descrizione : <span class="text-gray"><?php echo $event["description"]; ?></span></p>
                            <p class="text-uppercase">Prezzo : <span class="text-orange"><?php echo $event["price"]; ?></span></p>
                            <p class="text-uppercase">Posti disponibili : <span class="text-orange"><?php echo $ticketAvaliable["Capacity"]-$ticketAvaliable["TicketAcquired"] . '/' .  $ticketAvaliable["Capacity"]; ?></span></p>
                            <div id="ticketAvaliable" class="hidden"><?php echo $ticketAvaliable["TicketAcquired"]; ?></div>
                        </div>
                    </div>
                    <a data-toggle="collapse">
                        <div class="border-bottom">
                            <div class="row d-flex justify-content-center pb-2">
                                <div class="col-8 col-sm-6 col-md-4 col-xl-3">
                                    <?php 
                                    if($userIsLogged == 0){
                                        echo '<button id="addBtn" class="button-disable text-uppercase" type="button" onclick="goToLogin()">logIn</button>';
                                    } else{
                                    $dDiff = $date->diff(new DateTime("now"));
										if($dDiff->format("%r%a") > 0){
											echo '<button id="addBtn" class="button-disable" type="button" disabled>AGGIUNGI AL CARRELLO</button>';
										} else if(isset($_COOKIE["sessionId"])){
											echo '<button id="addBtn" class="button-orange" type="button" onclick="addToCart(1)">AGGIUNGI AL CARRELLO</button>';
                                        } 
                                    }
									?>
                                </div>
                            </div>
                            <div id="collapse" class="row justify-content-center pb-2 collapse">
                                <div class="col-8 col-sm-6 col-md-4 col-xl-3">
                                    <p id="addExecutedP" class="text-orange text-center"></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </footer>
        </article>
    </div>
</div>



<!-- AJAX -->
<script>
var ticketInCart = 0;
var onStartup = true;
var thisEventTicket = 0;

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function tryParse(str, defaultValue) {
    var retValue = defaultValue;
    if (str !== null) {
        if (str.length > 0) {
            if (!isNaN(str)) {
                retValue = parseInt(str);
            }
        }
    }
    return retValue;
}

function addToCart(n) {
    $.post("phpFunctions/addToCart.php", {
        idEvent: (new URLSearchParams(window.location.search)).get("ID"),
        quantity: n
    }, function(data) {
        if (data > 0) {
            //window.location.href = "./cart.php";
            $("#addExecutedP").empty();
            $("#addExecutedP").html("Questo evento e' presente con " + data + " biglietto/i nel carrello");
            $("#addExecutedP").removeClass("text-red");
            $("#addExecutedP").addClass("text-white");
            if (onStartup) {
                thisEventTicket = data;
                onStartup = false;
                ticketInCart = ticketInCart - thisEventTicket + 1;
            }
            $("#numCartElem").removeClass("hidden");
            $("#numCartElem > p").html(parseInt(ticketInCart) + parseInt(data));
            $("#numCartElemCart").removeClass("hidden");
            $("#numCartElemCart > p").html(parseInt(ticketInCart) + parseInt(data));
        } else if (data < 0) {
            $("#addExecutedP").html("Non sono presenti ulteriori biglietti");
            $("#addExecutedP").removeClass("text-white");
            $("#addExecutedP").addClass("text-red");


            $("#addBtn").removeClass("button-orange");
            $("#addBtn").addClass("button-orange");
            document.getElementById("addBtn").setAttribute('onclick', '')
        }
        if (data != 0) {
            $("#collapse").collapse('show');
        }
    });
}

function goToLogin() {
    window.location.href = "login.php?nextPage=eventInfo.php?" + window.location.search;
}


$(document).ready(function() {
    ticketInCart = $("#numCartElem > p").html();
    addToCart(0); //controllo eventuali biglietti nel carrello
});
</script>