<div class="col-11">
    <div class="row contenuti">
        <div class="row">
		
			<?php 
			$eventi = $templateParams["eventi"];
			$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			if(count($eventi) > 0){
				foreach($eventi as $evento): 
					$evT = $dbh->getEventInfo($evento);
					$luT = $dbh->getRoomData($evento);
					$ev = $evT[0];
					$luogo = $luT[0];
					?>

					<div class="col-12 col-xl-3 home-post">
						<article>
							<header>
								<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $images['image'] ).'"/>'; ?>
								<h2><?php echo $ev["date"]; ?> - <?php echo $ev["name"]; ?></h2>
								<h4><?php echo $luogo["locationName"]; ?> - <span><?php $luogo["roomName"]; ?></span></h4>
								<h3><?php echo $ev["name"]; ?> - <?php echo $ev["artist"];?></h3>
							</header>
					
							<body>
								<p class="text-orange"><?php echo $ev["price"]; ?>€</p>
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
