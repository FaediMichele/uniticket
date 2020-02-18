<nav id="sidebar">

    <header class="sidebar-header">
        <h3>Ciao <?php 
        if(isset($_COOKIE["sessionId"])){
            $userParam= $dbh->getUserParam($_COOKIE["sessionId"]);
            if(isset($userParam["username"])){
                echo $userParam["username"];
            } else{
                echo "Guest";
            }
        } else{
            echo "Guest";
        }?></h3>
    </header>

    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>
        <li>
            <a href="orders.php">I miei ordini</a>
        </li>
        <li>
            <a href="cart.php">Carrello</a>
            <?php
			$quantity = 0;
			$eventsInCartNum = $dbh->getEventsInCart($_COOKIE["sessionId"]);
            foreach($eventsInCartNum as $eventoNum){
				$quantity += $eventoNum[1];
			}
			if($quantity > 99) $quantity = 99;
            if($quantity > 0){
                printf('<div id="numCartElem" class="badge-notify text-white"><p >%d</p></div>', $quantity);
            } else{
                echo '<div id="numCartElem" class="badge-notify hidden"><p >0</p></div>';
            }
            ?>

        </li>
    </ul>

    <div class="separate">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <ul>
        <li>
            <a href="agenda.php">La mia agenda</a>
        </li>
        <li>
            <!-- DA CORREGGERE (credo) -->
            <a href="notice.php">Notifiche
                <?php
            $noticeToRead = $dbh->getNoticeToRead($_COOKIE["sessionId"]);
            $num = 0;
            foreach($noticeToRead as $row){
                $num = $row["NumberNoticeNotRead"] + $num;
            }
            if($num > 0){
                printf('<div id="numNotice" class="badge-notify"><p >%d</p></div>', $num);
            }
            ?>
            </a>
        </li>
    </ul>

    <?php
		if(isset($templateParams["advSidebar"])){
			require($templateParams["advSidebar"]);
		}
	?>

    <footer class="footer-logout">
        <ul class="mb-0 pb-0">
            <li>
                <a onClick="logout()" href="login.php">Logout</a>
            </li>
        </ul>
    </footer>
</nav>

<script>
var logout = function(event) {
    sessionManager.close();
    window.location.href = "./login.php";
}
</script>