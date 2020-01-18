<div class="col-11">
    <div class="row contenuti">
        <div class="row">
		
			<?php foreach($templateParams["eventi"] as $evento): 
				$evT = $dbh->getEventInfo($evento);
				$ev = $evT[0];
				/*foreach ($ev as $key => $value) {
					echo "Key: $key; Value: $value\n";
				}*/ 
				?>

				<div class="col-12 col-xl-3 home-post">
					<article>
						<header>
							<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $images['image'] ).'"/>'; ?>
							<h2><?php echo $ev["date"]; ?> - <?php echo $ev["name"]; ?></h2>
							<h4><?php echo $ev["idRoom"]; ?></h4>
							<h3><?php echo $ev["name"]; ?> - <?php echo $ev["artist"];?></h3>
						</header>
					
						<footer>
							<a href="#">Leggi tutto</a>
						</footer>
					</article>
				</div>
				
			<?php endforeach; ?> 
			
            <!-- da generare tramite query -->
            <!-- inizio post nella home -->
            <div class="col-12 col-xl-3">
                <header class="post">
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
            <div class="col-12 col-xl-3">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
            <div class="col-12 col-xl-3">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
            <div class="col-12 col-xl-3">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
            <div class="col-12 col-xl-3">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
           <!-- fine post nella home -->
        </div>
    </div>
</div>