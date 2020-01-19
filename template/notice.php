<div class="col-11 contenuti">
    <div class="row inline-block" id="notices">
        <div class=col-12>
            <?php
            $data = $dbh->getNotice($_COOKIE["sessionId"]);
            var_dump($data);
            foreach ($data as $key => $value){
                ?><div class="row noti">
                <div class="noti-event-image col-3 pr-0 pt-0 pb-0">
                    data:image/jpeg;base64,'.'"/>';
                    <img class="img-responsive" src="data:image/jpeg;base64,<?php echo base64_encode($value['img']) ?>"
                        alt="image of the event" />
                </div>
                <div class="noti-event-info col-7">
                    <h3 class="noti-event-date mb-1"><?php echo $value["date"] ?>
                    </h3>
                    <h4 class="noti-event-name text-truncate mb-0"><?php echo $value["name"] ?></h4>
                    <p class="noti-event-description text-truncate"><?php echo $value["description"] ?> </p>

                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-12 align-self-start noti-notice-date"><?php echo $value["NoticeDate"] ?>
                        </div>
                    </div>
                </div>
            </div><?php 
            }
            ?>
            <!-- inzio a inserire i contenuti -->

            <!-- prima notifica-->
            <div class=" row noti">
                <div class="noti-event-image col-3 pr-0 pt-0 pb-0">
                    <img class="img-responsive" src="./img/locandina.jpg" alt="image of the event" />
                </div>
                <div class="noti-event-info col-7">
                    <h3 class="noti-event-date mb-1">GIO. 12. DIC</h3>
                    <h4 class="noti-event-name text-truncate mb-0">HAPPY NEW YEAR 2020</h4>
                    <p class="noti-event-description text-truncate">Lorem ipsum as as ssss ciao ciccio</p>
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-12 align-self-start noti-notice-date">12:03</div>
                        <div class="col-12 align-self-center align-self-end">
                            <div class="badge-notify">2</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- fine contenti -->
    </div>
</div>