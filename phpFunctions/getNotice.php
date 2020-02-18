<?php

require_once("../db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "UniTicket");
$data = $dbh->getNotice($_COOKIE["sessionId"]);
if(count($data) <= 0){
    echo '<h2 class="text-center">Non hai notifiche</h2>';
}else {
    echo '<h2 class="text-center">Notifiche</h2>';
    $noticeToRead = $dbh->getNoticeToRead($_COOKIE["sessionId"]);
    /*var_dump($noticeToRead);*/
    //var_dump($data);
    $noticeArray = array();
    $eventArray = array();
    $noticeNumber = array();

    foreach($data as $notice){
        if(isset($noticeArray[$notice["idEvent"]])){
            array_push($noticeArray[$notice["idEvent"]], array("noticeDate" => new Datetime($notice["NoticeDate"]),
                "text" => $notice["Text"], "name" => $notice["name"]));
        } else{ 
            $noticeArray[$notice["idEvent"]] = array(array("noticeDate" => new Datetime($notice["NoticeDate"]),
                "text" => $notice["Text"], "name" => $notice["name"]));
            array_push($eventArray, array("name" => $notice["name"], "img" => $notice["img"],
                "description" => $notice["description"], "date" => $notice["date"],
                "artist" => $notice["artist"], "idEvent" => $notice["idEvent"]));
        }
    }
    foreach($noticeToRead as $row){
        $noticeNumber[$row["idEvent"]] = $row["NumberNoticeNotRead"];
    }
    for($i=0; $i < count($eventArray); $i++){
        $value = $eventArray[$i];
        $noticeDate = $noticeArray[$value["idEvent"]][0]["noticeDate"];
        $eventDate = new Datetime($value["date"]);
        
        $noticeNotRead = (isset($noticeNumber[$value["idEvent"]])) ? $noticeNumber[$value["idEvent"]] : 0;
    ?>
<a data-toggle="collapse" href="#collapse<?php echo $i; ?>" <?php if($noticeNotRead >0){ printf('onclick="readNotice(this, %d, %d)"', $value['idEvent'], $noticeNotRead);} ?>>
    <div class="border-bottom">
        <!-- riga del prodotto -->
        <div class=" row noti m-0 pr-0 pl-0 justify-content-center">
            <div class="col-4 mr-1 p-0      col-sm-3 mr-sm-0     col-md-2 mr-md-0     col-lg-2  col-xl-2 text-center">
                <img class="cover-95 radius-100" src="<?php echo $value['img'] ?>" alt="image of the event" />
            </div>
            <div class="col-5   col-sm-7    col-md-8 pl-md-0   col-lg-8     col-xl-8">
                <h3 class="noti-event-date mb-1"><?php echo $eventDate->format("l d/m") ?></h3>
                <h4 class="noti-event-name text-truncate mb-0"><?php echo $value["name"] ?></h4>
                <p class="noti-event-description text-truncate"><?php echo $value["description"] ?></p>
            </div>
            <div class="col-2">
                <div class="row">
                    <div class="col-12 noti-notice-date">
                        <p><?php echo $noticeDate->format('m/d H:i'); ?></p>
                    </div>
                    <?php if($noticeNotRead > 0){ ?>
                    <div class="col-12 notice-number">
                        <div class="badge-notify">
                            <p><?php echo $noticeNumber[$value["idEvent"]] ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- fine riga del prodotto -->

        <!-- inizio riga notifica collapse -->
        <div id="collapse<?php echo $i; ?>" class="collapse pt-2">
            <!--inizio notifiche-->
            <?php   foreach($noticeArray[$value["idEvent"]] as $eventName => $noticeVal){ ?>
            <div class="row">
                <div class="col-4 p-0      col-sm-3 mr-sm-0     col-md-2 mr-md-1 pr-md-2     col-lg-2  col-xl-2 pl-xl-0 ml-xl-0">
                    <p class="text-orange text-right"><?php echo $noticeVal["noticeDate"]->format('m/d H:i'); ?></p>
                </div>
                <div class="col-7 pl-2   col-sm-9    col-md-9 pl-md-0   col-lg-9     col-xl-9 ml-xl-0">
                    <div class="cloud p-2 pl-3 mb-2">
                        <p class="mb-2"><?php echo $noticeVal["text"] ?> </p>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!--fine notifiche-->
        </div>
        <!-- fine riga notifica collapse -->
    </div>
</a>
<?php }} ?>