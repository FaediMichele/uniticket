<div class="col-11">
    <div class="row contenuti">
        <div class="row">
		
			<?php 
			$eventi = $templateParams["eventi"];
			//$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			if(count($eventi) > 0){
				foreach($eventi as $eventId): 
					$eventId = $eventId[0];
					$event = $dbh->getEventInfo($eventId)[0];
					$location = $dbh->getRoomData($eventId)[0];
					$img = $dbh->getEventImages($eventId);
					$date = new Datetime($event["date"]);
					?>

					<div class="col-12 col-xl-3 home-post">
						<article>
							<header>
								<div>
									<img src="<?php echo $img[0]["img"] ?>"
										alt="immagine evento: <?php echo $event["name"]; ?>" />
								</div>
								<h2><?php echo $date->format('l d/m'); ?></h2>
								<h4><?php echo $location["locationName"]; ?> - <span><?php $location["roomName"]; ?></span></h4>
								<h3><?php echo $event["eventName"]; ?> - <?php echo $event["artist"];?></h3>
							</header>
					
							<body>
								<p class="text-orange"><?php echo $event["price"]; ?>€</p>
							</body>
						</article>
					</div>
				
					<?php
				endforeach;
			} else {
				?>
				<h2>orders empty</h2>
				<?php
			}?> 
			
        </div>
    </div>
</div>




<!--
<div class="col-11">
	<div class="row">
		<!-- da eliminare quando la query funzionerà -->
		<!-- inizio post ordinati - ->
		<div class="col-12 col-xl-3 home-post">
			<header>
				<img src="./img/locandina.jpg">
				<h2>gio 12 dic</h2>
				<h4>energy <span>sala 2</span></h4>
				<h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
			</header>
			<body>
				<p class="text-orange">8€</p>
			</body>
		</div>

	</div>
</div>
-->
