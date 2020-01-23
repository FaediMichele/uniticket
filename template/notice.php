<div class="col-11 contenuti">
    <div class="row inline-block" id="notices">
        <div class="col-12 container">
            <div class="panel-group">
                <?php
                $data = $dbh->getNotice($_COOKIE["sessionId"]);
                for($i=0; $i < count($data); $i++){
                    $value = $data[$i];
                    $noticeDate = new Datetime($value["NoticeDate"]);
                    $eventDate = new Datetime($value["date"]);
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse<?php echo $i; ?>">
                                <div class="row noti">
                                    <div class="noti-event-image col-3 pr-0 pt-0 pb-0 pl-0">
                                        <img class="img-responsive" src="<?php echo $value['img'] ?>"
                                            alt="image of the event" />
                                    </div>
                                    <div class="noti-event-info col-7">
                                        <h3 class="noti-event-date mb-1"><?php echo $eventDate->format("l d/m") ?>
                                        </h3>
                                        <h4 class="noti-event-name text-truncate mb-0"><?php echo $value["name"] ?></h4>
                                        <p class="noti-event-description text-truncate">
                                            <?php echo $value["description"] ?> </p>
                                    </div>
                                    <div class="col-2">
                                        <div class="row align-self-start noti-notice-date">
                                            <?php echo $noticeDate->format('m/d H:i'); ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p><?php echo $value["NoticeDescription"] ?> </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>