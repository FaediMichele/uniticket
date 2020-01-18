<div class="col-11">
    <div class="row contenuti">
        <div class="row">
		
			<?php foreach($templateParams["articoli"] as $articolo): ?>
				<article>
					<header>
						<div>
							<img src="<?php echo UPLOAD_DIR.$articolo["imgarticolo"]; ?>" alt="" />
						</div>
						<h2><?php echo $articolo["titoloarticolo"]; ?></h2>
						<p><?php echo $articolo["dataarticolo"]; ?> - <?php echo $articolo["nome"]; ?></p>
					</header>
					
					<section>
						<p><?php echo $articolo["anteprimaarticolo"]; ?></p>
					</section>
					
					<footer>
						<a href="#">Leggi tutto</a>
					</footer>
				</article>
			<?php endforeach; ?> 
			
            <!-- da generare tramite query 
             inizio post nella home 
            <div class="col-12 col-xl-3 home-post">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
            <div class="col-12 col-xl-3 home-post">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
            <div class="col-12 col-xl-3 home-post">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
            <div class="col-12 col-xl-3 home-post">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
            <div class="col-12 col-xl-3 home-post">
                <header>
                    <img src="./img/locandina.jpg">
                    <h2>gio 12 dic</h2>
                    <h4>energy <span>sala 2</span></h4>
                    <h3>happy new year 2020 <span>Max Pezzali + Finley</span></h3>
                </header>
            </div>
             fine post nella home -->
        </div>
    </div>
</div>