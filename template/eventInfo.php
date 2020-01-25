<div class="col-11">
    <div class="row contenuti">
        <div class="row">
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
            <article class="col-12 col-xl-3 mb-2 home-post">
                <div class="row">
                    <header class="col-12 p-0 pl-xl-2 pr-xl-2">
                        <div id="event-<?php echo $index; ?>" class="carousel slide " data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#event-<?php echo $index; ?>" data-slide-to="0" class="active">
                                </li>
                                <?php for ($i = 1; $i < count($img); $i++) { ?>
                                <li data-target="#event-<?php echo $index; ?>" data-slide-to="<?php echo $i ?>">
                                </li>
                                <?php } ?>
                            </ol>
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
                    <section class="row mt-2 mb-2 pb-2 border-bottom">
                        <div class="col-12 text-post">
                            <h2><?php echo $date->format('l d m'); ?></h2>
                            <h4><?php echo $event["locationName"]; ?> -
                                <span><?php echo $event["roomName"]; ?></span>
                            </h4>
                            <h3><?php echo $event["eventName"]; ?> <span><?php echo $event["artist"]; ?></span></h3>
                        </div>
                    </section>
                </a>
                <footer class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-11">
                                <p class="mb-0 text-uppercase">Orario di appertura : <span
                                        class="text-gray"><?php echo $date->format('H:i'); ?></span>
                                </p>
                                <p class="text-uppercase">Descrizione : <span
                                        class="text-gray"><?php echo $event["description"]; ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center pb-2 border-bottom">
                            <div class="col-8">
                                <button class="button-orange" type="submit" id="addToCart" name="addToCart"
                                    value="<?php echo $eventId ?>">AGGIUNGI AL CARRELLO</button>
                            </div>
                        </div>
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
</div>


<!-- AJAX -->
<script>
$(document).ready(function() {
    $('.button-orange').click(function() {
        var clickBtnValue = $(this).val();
        var clickBtnAction = $(this).attr('name');
        var ajaxurl = 'ajax.php',
            data = {
                'action': clickBtnAction,
                'eventId': clickBtnValue,
                'quantity': 1
            };

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                'action': clickBtnAction,
                'eventId': clickBtnValue
            },
            dataType: "json",
            done: function($msg) {
                console.log($msg);
                alert("aggiunto");
                window.location.href = "./cart.php";
            }
        });
    });
});
</script>