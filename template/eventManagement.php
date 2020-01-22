<div class="col-12 contenuti border-bottom-son">

    <?php 
		$eventi = $templateParams["eventi"];
		//$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
		foreach($eventi as $evento): 
			$evento = $evento[0];
			$event = $dbh->getEventInfo($evento)[0];
			$location = $dbh->getRoomData($evento)[0];
			$img = $dbh->getEventImages($evento);
			$date = new Datetime($event["date"]);
	?>
		<!-- EVENT -->
		<div class="row justify-content-center">
			<div class="col-11">
				<!--primo elemento-->
				<!--inizio prima row-->
				<div class="row">
				<div class="col-2 font-size-red text-vertical-center-father height-100 p-0"> </div>
					<div class="col-8 height-100 text-vertical-center-father p-0">
						<p class="text-vertical-center-son text-center">
							<img src="<?php echo $img[0]["img"] ?>"
                                    alt="immagine evento: <?php echo $event["name"]; ?>" />
						</p>
					</div>
					<div class="col-2 text-vertical-center-father height-100 p-0">
						<p class="text-red font-size-red text-vertical-center-son text-center"><?php echo $event["price"]; ?>€</p>
					</div>
				</div>
				<!--fine prima row-->
				<!--inizio seconda row-->
				<div class="row mt-2">
					<div class="col-12 reset mx-auto post">
						<h2><?php echo $date->format('l d/m'); ?></h2>
						<h4><?php echo $location["locationName"]; ?> <span><?php $location["roomName"]; ?></span></h4>
						<h3><?php echo $event["eventName"]; ?> <span><?php echo $event["artist"]; ?></span></h3>
					</div>
				</div>
				<!--fine seconda row-->
			</div>
		</div>
	<?php 
		endforeach; 
	?>


	<!-- PRIMO PRODOTTO - ->
    <div class="row justify-content-center">
        <div class="col-11">
            <!--primo elemento-->
            <!--inizio prima row--><!--
            <div class="row">
                <div class="col-2 font-size-red text-vertical-center-father height-100 p-0">
                    <p class="text-vertical-center-son text-white text-center">x1</p>
                </div>
                <div class="col-8 height-100 text-vertical-center-father p-0">
                    <p class="text-vertical-center-son text-center">
                        <img class="image image-pay " src="./img/locandina.jpg">
                    </p>
                </div>
                <div class="col-2 text-vertical-center-father height-100 p-0">
                    <p class="text-red font-size-red text-vertical-center-son text-center">8€</p>
                </div>
            </div>
            <!--fine prima row-->
            <!--inizio seconda row--><!--
            <div class="row mt-2">
                <div class="col-12 reset mx-auto post">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </div>
            </div>
            <!--fine seconda row--><!--
        </div>
    </div>
    <!-- FINE PRIMO PRODOTTO -->

</div>

