<div class="col-11">
    <div class="row contenuti">
        <div class="row">

            <?php 
			$eventi = $templateParams["eventi"];
			//$eventi[] = 4;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			for($index=0; $index < count($eventi); $index++){
				$evento = $eventi[$index];
				$event = $dbh->getEventInfo($evento[0])[0];
				$location = $dbh->getRoomData($evento[0])[0];
				$img = $dbh->getEventImages($evento[0]);
				$date = new Datetime($event["date"]);
				/*foreach ($event as $key => $value) {
					echo "Key: $key; Value: $value\n";
				}*/
				?>

            <div class="col-12 col-xl-3 home-post">
                <article>
                    <header>
                        <div id="event-<?php echo $index; ?>" class="carousel slide col-12" data-ride="carousel">
                            <div class="carousel-inner">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <?php for ($i = 1; $i < count($img); $i++) { ?>
                                    <li data-target="#event-<?php echo $index; ?>" data-slide-to="<?php echo $i ?>">
                                    </li>
                                    <?php } ?>
                                </ol>
                                <div class="carousel-item active">
                                    <img src="<?php echo $img[0]["img"] ?>"
                                        alt="immagine evento: <?php echo $event["name"]; ?>" />
                                </div>
                                <?php
								for ($i = 1; $i < count($img); $i++) {
									$value = $img[$i]; ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $value["img"] ?>"
                                        alt="immagine evento: <?php echo $event["name"]; ?>" />
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

                        <h2><?php echo $date->format('l d/m'); ?> - <?php echo $event["name"]; ?></h2>
                        <h4><?php echo $location["locationName"]; ?> - <span><?php $location["roomName"]; ?></span></h4>
                        <h3><?php echo $event["name"]; ?> - <span><?php echo $event["artist"]; ?></span></h3>
                    </header>

                    <footer>
                        <a href="eventInfo.php?ID=<?php echo $evento ?>">Leggi tutto</a>
                        <!-- Aggiungere il link relativo all'evento-->
                    </footer>
                </article>
            </div>

            <?php } ?>

        </div>
    </div>
</div>