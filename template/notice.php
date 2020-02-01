<div class="col-11 contenuti">
    <div class="row inline-block" id="notices">
        <div class="col-12 container">
            <!-- inzio contenitore  -->

            <?php
                $data = $dbh->getNotice($_COOKIE["sessionId"]); 
                // var_dump($data);
                for($i=0; $i < count($data); $i++){
                    $value = $data[$i];
                    $noticeDate = new Datetime($value["NoticeDate"]);
                    $eventDate = new Datetime($value["date"]);
                ?>
            <a data-toggle="collapse" href="#collapse<?php echo $i; ?>">
                <div class="border-bottom">
                    <!-- riga del prodotto -->
                    <div class=" row noti m-0 pr-0 pl-0">
                        <div class="col-4 p-0">
                            <img class="cover-95 radius-100" src="<?php echo $value['img'] ?>"
                                alt="image of the event" />
                        </div>
                        <div class="col-6">
                            <h3 class="noti-event-date mb-1"><?php echo $eventDate->format("l d/m") ?></h3>
                            <h4 class="noti-event-name text-truncate mb-0"><?php echo $value["name"] ?></h4>
                            <p class="noti-event-description text-truncate"><?php echo $value["description"] ?></p>
                        </div>
                        <div class="col-2">
                            <div class="row">
                                <div class="col-12 noti-notice-date">
                                    <?php echo $noticeDate->format('m/d H:i'); ?>
                                </div>
                                <div class="col-12">
                                    <div class="badge-notify">2</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- fine riga del prodotto -->
                    <!-- inizio riga notifica collapse -->
                    <div id="collapse<?php echo $i; ?>" class="collapse pt-2">
                        <!--inizio prima notifica-->
                        <div class="row">
                            <div class="col-4">
                                <p class="text-orange text-right"> <?php echo $noticeDate->format('m/d H:i'); ?></p>
                            </div>
                            <div class="col-8 pl-0">
                                <div class="cloud p-2 pl-3 mb-2">
                                    <p class="mb-2"><?php echo $value["NoticeDescription"] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--fine prima notifica-->

                        <!--inizio seconda notifica-->
                        <div class="row">
                            <div class="col-4">
                                <p class="text-orange text-right"> <?php echo $noticeDate->format('m/d H:i'); ?></p>
                            </div>
                            <div class="col-8 pl-0">
                                <div class="cloud p-2 pl-3 mb-2">
                                    <p class="mb-2"><?php echo $value["NoticeDescription"] ?> </p>
                                </div>
                            </div>
                        </div>
                        <!--fine seconda notifica-->
                    </div>
                    <!-- fine riga notifica collapse -->
                </div>
            </a>
            <?php } ?>
            <!-- contenitore naed -->
        </div>
    </div>
</div>




<!-- 
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
                </div> -->