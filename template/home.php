<div class="col-11">
    <div class="row contenuti">
        <div class="row">
		
			<?php 
			$eventi = $templateParams["eventi"];
			$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			foreach($eventi as $evento): 
				$event = $dbh->getEventInfo($evento)[0];
				$location = $dbh->getRoomData($evento)[0];
				$img = $dbh->getEventImages($evento);
				$date = new Datetime($event["date"]);
				/*foreach ($event as $key => $value) {
					echo "Key: $key; Value: $value\n";
				}*/
				?>

				<div class="col-12 col-xl-3 home-post">
					<article>
						<header>
							<?php foreach($img as $image): ?>
								<div>
									<img src="<?php echo $image ?>" alt="" />
								</div>
							<?php endforeach; ?>
							<h2><?php echo $date->format('l d/m'); ?> - <?php echo $event["name"]; ?></h2>
							<h4><?php echo $location["locationName"]; ?> - <span><?php $location["roomName"]; ?></span></h4>
							<h3><?php echo $event["name"]; ?> - <span><?php echo $event["artist"]; ?></span></h3>
						</header>
					
						<footer>
							<a href="eventInfo.php?ID=<?php echo $evento ?>">Leggi tutto</a>	<!-- Aggiungere il link relativo all'evento-->
						</footer>
					</article>
				</div>
				
			<?php endforeach; ?> 
			
        </div>
    </div>
</div>