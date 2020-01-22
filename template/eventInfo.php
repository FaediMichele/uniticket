<div class="col-11">
    <div class="row contenuti">
        <div class="row">

            <?php 
				$eventId = $templateParams["evento"];

				$event = $dbh->getEventInfo($eventId)[0];
				var_dump($event);
				$location = $dbh->getRoomData($eventId)[0];
				$img = $dbh->getEventImages($eventId);
				$date = new Datetime($event["date"]);
				var_dump($img);
				/*foreach ($event as $key => $value) {
					echo "Key: $key; Value: $value\n";
				}*/
			?>

            <div class="col-12 col-xl-3 home-post">
                <article>
                    <header>
                        <div id="event" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#event" data-slide-to="0" class="active">
                                </li>
                                <?php for ($i = 1; $i < count($img); $i++) { ?>
                                <li data-target="#event" data-slide-to="<?php echo $i ?>">
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
                        <h2><?php echo $date->format('d/m'); ?> - <?php echo $event["eventName"]; ?></h2>
                        <h4><?php echo $location["locationName"]; ?> - <span><?php $location["roomName"]; ?></span></h4>
                        <h3><?php echo $event["eventName"]; ?> - <span><?php echo $event["artist"]; ?></span></h3>
                        <p><?php echo $event["description"]; ?></p>
                        <h3><span>APERTURA ORE </span><?php echo $date->format('h:i'); ?> </h3>
                        <h3><span>PREVENDITA </span><?php echo $event["price"] ?></h3>
                    </header>

                    <body>
                        <div class="row d-flex justify-content-center">
                            <div class="col-10">
                                <button class="button-orange" type="submit" id="addToCart" name="addToCart"
                                    value="<?php echo $eventId ?>">AGGIUNGI AL CARRELLO</button>
                            </div>
                        </div>

                    </body>

                </article>
            </div>
            <?php ?>
        </div>
    </div>
</div>



<!-- AJAX -->
<script>
$(document).ready(function() {
    $('.button-orange').click(function() {
        var clickBtnValue = $(this).val();
        var ajaxurl = 'ajax.php',
            data = {
                'eventId': clickBtnValue,
                'quantity': 1
            };
        $.post(ajaxurl, data, function(response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    });
});
</script>