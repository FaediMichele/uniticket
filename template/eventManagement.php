<div class="col-12 contenuti">
    <?php 
			$eventsId = $templateParams["events"];
			//$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			if(count($eventsId) <=  0){	
                echo '<h2 class="text-center">Non hai creato eventi</h2>';
            }else {
                echo '<h2 class="text-center text-uppercase">Eventi creati</h2>';
				for($index=0; $index < count($eventsId); $index++){
					$event = $dbh->getEventInfo($eventsId[$index]["idEvent"])[0];
					$img = $dbh->getEventImages($eventsId[$index]["idEvent"]);
					$date = new Datetime($event["date"]);

					/*foreach ($event as $key => $value) {	//FOR DEBUG PURPOSES
						echo "Key: $key; Value: $value\n";
					}*/

					//fare un ciclo di merge degli eventi uguali, incrementando il contatore quantità
			?>
    <!-- PRIMO PRODOTTO -->
    <div class="row justify-content-center">
        <div class="col-11 cart">
            <!--primo elemento-->
            <!--inizio prima row-->
            <a href="eventInfo.php?ID=<?php echo $eventsId[$index]["idEvent"];?>">
                <div class="row">
                    <div class="col-4 p-0 text-center">
                        <img class="cover-95" src="<?php echo $img[0]["img"] ?>" alt="immagine evento: <?php echo $event["name"]; ?>" />
                    </div>
                    <div class="col-5">
                        <h3 class="noti-event-date mb-1 text-white"><?php echo $date->format('l d/m'); ?></h3>
                        <h4 class="noti-event-name text-truncate mb-0 text-gray "><?php echo $event["eventName"]; ?></h4>
                    </div>
                    <div class="col-3">
                        <p class="text-red font-size-red"><?php echo ($event["price"]); ?>€</p>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <p class="text-orange mb-0">Biglietti acquistati : <?php echo $eventsId[$index]["AcquiredTicket"]; ?></p>

                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <p class="text-orange mb-0">Biglietti disponibili : <?php echo $eventsId[$index]["TotalSpace"] - $eventsId[$index]["AcquiredTicket"]; ?></p>
                    </div>
                </div>
            </a>
            <!--fine prima row-->
        </div>
    </div>
    <!-- FINE PRIMO PRODOTTO -->
    <?php }} ?>
</div>