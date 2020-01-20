<div class="col-11">
    <div class="row contenuti">
        <div class="row">
		
			<?php 
				$eventId = $templateParams["evento"];

				$event = $dbh->getEventInfo($eventId)[0];
				$location = $dbh->getRoomData($eventId)[0];
				$img = $dbh->getEventImages($eventId);
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
							<h2><?php echo $date->format('d/m'); ?> - <?php echo $event["name"]; ?></h2>
							<h4><?php echo $location["locationName"]; ?> - <span><?php $location["roomName"]; ?></span></h4>
							<h3><?php echo $event["name"]; ?> - <span><?php echo $event["artist"]; ?></span></h3>
							<p><?php echo $event["description"]; ?></p>
							<h3><span>APERTURA ORE </span><?php echo $date->format('h:i'); ?> </h3>
							<h3><span>PREVENDITA </span><?php echo $event["price"] ?>€ </h3>
						</header>
						<body>
							<div class="row d-flex justify-content-center">
								<div class="col-10">
									<button class="button-orange" type="submit" id="addToCart" name="addToCart" value="<?php echo $eventId ?>" >AGGIUNGI AL CARRELLO</button>
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
	$(document).ready(function(){
    $('.button-orange').click(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = 'ajax.php',
        data =  {'eventId': clickBtnValue, 'quantity': 1};
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    });
});
</script>