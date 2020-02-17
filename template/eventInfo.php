<!-- inizio pagina infoevent -->
<div class="col-12">
    <div class="row contenuti">

        <?php 
				$eventId = $templateParams["evento"];
				$event = $dbh->getEventInfo($eventId)[0];
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
                    <h4><?php echo $event["locationName"]; ?> -
                        <span><?php echo $event["roomName"]; ?></span>
                    </h4>
                    <h3><?php echo $event["eventName"]; ?> <span><?php echo $event["artist"]; ?></span></h3>
                </div>
            </section>
            <footer class="row d-flex justify-content-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col-11">
                            <p class="mb-0 text-uppercase">Orario di appertura : <span class="text-gray"><?php echo $date->format('H:i'); ?></span>
                            </p>
                            <p class="text-uppercase">Descrizione : <span class="text-gray"><?php echo $event["description"]; ?></span>
                            </p>
                        </div>
                    </div>
                    <a data-toggle="collapse">
                        <div class="border-bottom">
                            <div class="row d-flex justify-content-center pb-2">
                                <div class="col-8 col-sm-6 col-md-4 col-xl-3">
                                    <?php 
									var_dump(new DateTime("now"));
										if(new DateTime("now") > $date){
											echo '<button id="addBtn" class="button-disable" type="button" disabled>AGGIUNGI AL CARRELLO</button>';
										} else{
											echo '<button id="addBtn" class="button-orange" type="button" onclick="addToCart(1)">AGGIUNGI AL CARRELLO</button>';
										} 
									?>
                                </div>
                            </div>
                            <div id="collapse" class="row justify-content-center pb-2 collapse">
                                <div class="col-8 col-sm-6 col-md-4 col-xl-3">
                                    <p id="addExecutedP" class="text-orange text-center">ciao</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="row d-flex justify-content-center border-bottom">
                        <div class="col-8 text-orange text-center">
                            <i class="fas fa-share-alt fa-lg mb-3 mt-3"></i>
                        </div>
                    </div>
                </div>
            </footer>
        </article>
    </div>
</div>



<!-- AJAX -->
<script>
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
        //var p = tryParse(data, false)
        //if (p != false) {
        if (data > 0) {
            //alert("Ci sono " + data + " biglietti nel carrello di questo evento");
            //window.location.href = "./cart.php";
            //segnalare aggiunta al carrello eseguita
            document.getElementById("addExecutedP").innerHTML = "Questo evento e' presente con " + data + " biglietto/i nel carrello";
            document.getElementById("addExecutedP").style.color = "white";
        } else {
            console.log(data);
            document.getElementById("addExecutedP").innerHTML = "Non sono presenti ulteriori biglietti";
            document.getElementById("addExecutedP").style.color = "red";
			
			document.getElementById("addBtn").classList.remove('button-orange');
			document.getElementById("addBtn").classList.add('button-disable');
			document.getElementById("addBtn").setAttribute('onclick','')
        }
        if (data != 0) $(".collapse").collapse('show');
    });
}

addToCart(0); //controllo eventuali biglietti nel carrello
</script>