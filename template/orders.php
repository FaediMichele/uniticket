<div class="col-12 contenuti">

    <?php 
			
			$eventi = $templateParams["orders"];
			//$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			if(count($eventi) > 0){	
				for($index=0; $index < count($eventi); $index++){
					$evento = $eventi[$index][0];
					$event = $dbh->getEventInfo($evento)[0];
					$img = $dbh->getEventImages($evento);
					$date = new Datetime($event["date"]);
					foreach ($event as $key => $value) {
						echo "Key: $key; Value: $value\n";
					}
			?>


    <!-- PRIMO PRODOTTO -->
    <div class="row justify-content-center">
        <div class="col-11 cart">
            <!--primo elemento-->
            <!--inizio prima row-->
            <div class="row">
                <div class="col-4 p-0 text-center">
                    <img class="cover-95" src="<?php echo $img[0]["img"] ?>"
                        alt="immagine evento: <?php echo $event["name"]; ?>" />
                </div>
                <div class="col-5">
                    <h3 class="noti-event-date mb-1"><?php echo $date->format('l d/m'); ?></h3>
                    <h4 class="noti-event-name text-truncate mb-0"><?php echo $event["eventName"]; ?></h4>
                </div>
                <div class="col-3">
                    <p class="text-red font-size-red"><?php echo $event["price"]; ?>€</p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <p class="text-orange mb-0">Quantity : [numero quantità]</p>
                </div>
            </div>

            <!--fine prima row-->
        </div>
    </div>
    <!-- FINE PRIMO PRODOTTO -->
    <?php
				}
			} else {
				?>
    <h2 class="text-text-center">orders empty</h2>
    <?php
			}?>

</div>
</div>
</div>




<!--
<div class="col-11">
	<div class="row">
		<!-- da eliminare quando la query funzioner� -->
<!-- inizio post ordinati - ->
		<div class="col-12 col-xl-3 home-post">
			<header>
				<img src="./img/locandina.jpg">
				<h2>gio 12 dic</h2>
				<h4>energy <span>sala 2</span></h4>
				<h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
			</header>
			<body>
				<p class="text-orange">8�</p>
			</body>
		</div>

	</div>
</div>
-->