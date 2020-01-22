<div class="col-12">
    <div class="row contenuti">

        <?php 
			$eventi = $templateParams["eventi"];
			//$eventi[] = 4;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			for($index=0; $index < count($eventi); $index++){
				$evento = $eventi[$index][0];
				$event = $dbh->getEventInfo($evento)[0];
				$img = $dbh->getEventImages($evento);
				$date = new Datetime($event["date"]);
				/*foreach ($event as $key => $value) {
					echo "Key: $key; Value: $value\n";
				}*/
		?>

        <div class="col-12 col-xl-3 home-post">
            <article class="row">
                <header class="col-12">
                    <div id="event-<?php echo $index; ?>" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#event-<?php echo $index; ?>" data-slide-to="0" class="active">
                            </li>
                            <?php for ($i = 1; $i < count($img); $i++) { ?>
                            <li data-target="#event-<?php echo $index; ?>" data-slide-to="<?php echo $i ?>">
                            </li>
                            <?php } ?>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo $img[0]["img"] ?>"
                                    alt="immagine evento: <?php echo $event["eventName"]; ?>" />
                            </div>
                            <?php
								for ($i = 1; $i < count($img); $i++) {
									
									$value = $img[$i]; ?>
                            <div class="carousel-item">
                                <img src="<?php echo $value["img"] ?>"
                                    alt="immagine evento: <?php echo $event["eventName"]; ?>" />
                            </div>
                            <?php } ?>
                        </div>
                        <?php if(count($img) > 1){ ?>
                        <a class="carousel-control-prev" href="#event-<?php echo $index; ?>" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#event-<?php echo $index; ?>" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <?php } ?>
                    </div>
                    <div class="info">
                        <h2><?php echo $date->format('l d/m'); ?></h2>
                        <h4><?php echo $event["locationName"]; ?> - <span><?php echo $event["roomName"]; ?></span>
                        </h4>
                        <h3><?php echo $event["eventName"]; ?> <span><?php echo $event["artist"]; ?></span></h3>
                    </div>
                </header>

                <footer>
					<a href="eventInfo.php?ID=<?php echo $evento ?>">Dettagli evento</a>
                </footer>
            </article>
        </div>

        <?php } ?>

    </div>
</div>