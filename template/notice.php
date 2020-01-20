<div class="col-11 contenuti">
    <div class="row inline-block" id="notices">
        <div class=col-12>
            <?php
            $data = $dbh->getNotice($_COOKIE["sessionId"]);
            
            foreach ($data as $key => $value){
                $noticeDate = new Datetime($value["NoticeDate"]);
                $eventDate = new Datetime($value["date"]);
                
                ?><div class="row noti">
                <div class="noti-event-image col-3 pr-0 pt-0 pb-0">
                    <img class="img-responsive" src="<?php echo $value['img'] ?>" alt="image of the event" />
                </div>
                <div class="noti-event-info col-7">
                    <h3 class="noti-event-date mb-1"><?php echo $eventDate->format("l d/m") ?>
                    </h3>
                    <h4 class="noti-event-name text-truncate mb-0"><?php echo $value["name"] ?></h4>
                    <p class="noti-event-description text-truncate"><?php echo $value["description"] ?> </p>

                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="align-self-start noti-notice-date"><?php echo $noticeDate->format('m/d H:i'); ?>
                        </div>
                    </div>
                </div>
            </div><?php 
            }
            ?>
        </div>
    </div>
</div>