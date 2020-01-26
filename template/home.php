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
        <article class="col-12 col-xl-3 mb-2 home-post">
            <div class="row">
                <header class="col-12 p-0 pl-xl-2 pr-xl-2">
                    <div id="event-<?php echo $index; ?>" class="carousel slide " data-ride="carousel">
                        <?php if(count($img) > 1){ ?>
                        <ol class="carousel-indicators">
                            <li data-target="#event-<?php echo $index; ?>" data-slide-to="0" class="active">
                            </li>
                            <?php for ($i = 1; $i < count($img); $i++) { ?>
                            <li data-target="#event-<?php echo $index; ?>" data-slide-to="<?php echo $i ?>">
                            </li>
                            <?php } ?>
                        </ol>
                        <?php } ?>
                        <div class="carousel-inner height-300">
                            <div class="carousel-item active">
                                <a href="eventInfo.php?ID=<?php echo $evento ?>">
                                    <img src="<?php echo $img[0]["img"] ?>"
                                        alt="immagine evento: <?php echo $event["eventName"]; ?>"
                                        class="cover-100-percent" />
                                </a>
                            </div>
                            <?php
								for ($i = 1; $i < count($img); $i++) {
									
									$value = $img[$i]; ?>
                            <div class="carousel-item">
                                <a href="eventInfo.php?ID=<?php echo $evento ?>">
                                    <img src="<?php echo $value["img"] ?>"
                                        alt="immagine evento: <?php echo $event["eventName"]; ?>"
                                        class="cover-100-percent" />
                                </a>
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
                </header>
            </div>
            <a href="eventInfo.php?ID=<?php echo $evento ?>">
                <section class="row mt-2">
                    <div class="col-12 text-post">
                        <h2><?php echo $date->format('l d m'); ?></h2>
                        <h4><?php echo $event["locationName"]; ?> -
                            <span><?php echo $event["roomName"]; ?></span>
                        </h4>
                        <h3><?php echo $event["eventName"]; ?> <span><?php echo $event["artist"]; ?></span></h3>
                    </div>
                </section>
            </a>
        </article>
        <?php } ?>
    </div>
</div>