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
        <div class="col-11 col-lg-10 col-xl-9 cart">
            <!--primo elemento-->
            <!--inizio prima row-->
            <a data-toggle="collapse" role="button" href="#event<?php echo $index;?>">
                <div class="row">
                    <div class="col-4 col-sm-3 col-md-2 col-xl-2 p-0 text-center">
                        <img class="cover-95" src="<?php echo $img[0]["img"] ?>" alt="immagine evento: <?php echo $event["name"]; ?>" />
                    </div>
                    <div class="col-5 col-md-6 col-xl-8">
                        <h3 class="noti-event-date mb-1 text-white"><?php echo $date->format('l d/m'); ?></h3>
                        <h4 class="noti-event-name text-truncate mb-0 text-gray "><?php echo $event["eventName"]; ?></h4>
                    </div>
                    <div class="col-3 col-sm-4 col-xl-2 text-right">
                        <p class="text-red font-size-red"><?php echo ($event["price"]); ?>€</p>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <p class="text-orange mb-0 text-center">Clicca per creare un messaggio</p>
                    </div>
                </div>
            </a>
            <div class="collapse cloud p-2 row" id="event<?php echo $index;?>">
                <div class="col-12">
                    <form id="form-<?php echo $index; ?>" action="phpFunctions/newNotice.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idEvent" value="<?php echo $eventsId[$index]["idEvent"]; ?>">
                        <div class="row text-center pr-0">
                            <div class="col-12">
                                <label for="text-<?php echo $index; ?>" id="lblText-<?php echo $index; ?>" class="text-uppercase ">*Messaggio</label>
                                <input type="text" id="text-<?php echo $index; ?>" name="message" class="input" required placeholder="Contenuto messaggio...">
                            </div>
                        </div>
                        <div class="row text-center pr-0">
                            <div class="col-6">
                                <label for="date-<?php echo $index; ?>" id="lblText-<?php echo $index; ?>" class="text-uppercase ">Data di visualizzazione</label>
                                <input type="date" id="date-<?php echo $index; ?>" name="date" class="input">
                            </div>
                            <div class="col-6">
                                <label for="time-<?php echo $index; ?>" id="lblText-<?php echo $index; ?>" class="text-uppercase ">Ora di visualizzazione</label>
                                <input type="time" id="time-<?php echo $index; ?>" name="time" class="input">
                            </div>
                        </div>
                        <div class="row text-center pr-0">
                            <input type="submit" class="button-orange text-uppercase" value="Pubblica">
                        </div>
                    </form>
                    <!-- <a href="">Modifica locale</a>
                <a href="">Modifica sala</a> -->
                </div>
            </div>
            <!--fine prima row-->
        </div>
    </div>
    <!-- FINE PRIMO PRODOTTO -->
    <?php }} ?>
</div>