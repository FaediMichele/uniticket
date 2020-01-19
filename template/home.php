<div class="col-11">
    <div class="row contenuti">
        <div class="row">
		
			<?php 
			$eventi = $templateParams["eventi"];
			$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			foreach($eventi as $evento): 
				$evT = $dbh->getEventInfo($evento);
				$luT = $dbh->getRoomData($evento);
				$ev = $evT[0];
				$luogo = $luT[0];
				/*foreach ($ev as $key => $value) {
					echo "Key: $key; Value: $value\n";
				}*/
				?>

				<div class="col-12 col-xl-3 home-post">
					<article>
						<header>
							<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $images['image'] ).'"/>'; ?>
							<h2><?php echo $ev["date"]; ?> - <?php echo $ev["name"]; ?></h2>
							<h4><?php echo $luogo["locationName"]; ?> - <span><?php $luogo["roomName"]; ?></span></h4>
							<h3><?php echo $ev["name"]; ?> - <span><?php echo $ev["artist"]; ?></span></h3>
						</header>
					
						<footer>
							<a href="#">Leggi tutto</a>	<!-- Aggiungere il link relativo all'evento-->
						</footer>
					</article>
				</div>
				
			<?php endforeach; ?> 
			
        </div>
    </div>
</div>