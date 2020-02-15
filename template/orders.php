<div class="col-12 contenuti">
    <?php 
			$ordersId = $templateParams["orders"];
			//$eventi[] = 1;	//togliere il commento per aggiungere un evento di test (questa riga fa la push dell' idEvento 1 nell'array $eventi)
			if(count($ordersId) <=  0){	
                echo '<h2 class="text-text-center">Non hai comprato nessun biglietto</h2>';
            }else {
                echo '<h2 class="text-center text-uppercase">Ordini</h2>';
				for($index=0; $index < count($ordersId); $index++){
					$event = $dbh->getEventInfo($ordersId[$index]["idEvent"])[0];
					$img = $dbh->getEventImages($ordersId[$index]["idEvent"]);
					$date = new Datetime($event["date"]);

					/*foreach ($event as $key => $value) {	//FOR DEBUG PURPOSES
						echo "Key: $key; Value: $value\n";
					}*/

					//fare un ciclo di merge degli eventi uguali, incrementando il contatore quantità
			?>
    <!-- PRIMO PRODOTTO -->
    <div class="row justify-content-center">
        <div class="col-11 cart">
            <!--primo elemento-->
            <!--inizio prima row-->
            <a href="eventInfo.php?ID=<?php echo $ordersId[$index]["idEvent"];?>">
                <div class="row">
                    <div class="col-4 p-0 text-center">
                        <img class="cover-95" src="<?php echo $img[0]["img"] ?>" alt="immagine evento: <?php echo $event["name"]; ?>" />
                    </div>
                    <div class="col-5">
                        <h3 class="noti-event-date mb-1 text-white"><?php echo $date->format('l d/m'); ?></h3>
                        <h4 class="noti-event-name text-truncate mb-0 text-gray "><?php echo $event["eventName"]; ?></h4>
                    </div>
                    <div class="col-3">
                        <p class="text-red font-size-red"><?php echo ($event["price"] * $ordersId[$index]["NumberTicket"]); ?>€</p>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <p class="text-orange mb-0">Quantity : <?php echo $ordersId[$index]["NumberTicket"]; ?></p>
                    </div>
                </div>
            </a>
            <!--fine prima row-->
        </div>
    </div>
    <!-- FINE PRIMO PRODOTTO -->
    <?php }} ?>
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