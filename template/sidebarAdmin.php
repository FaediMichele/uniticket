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

    <div class="separate">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <?php/*
		if(isset($templateParams["advSidebar"])){
			require($templateParams["advSidebar"]);
		}*/
	?>
    <ul>
        <li>
            <a href="blockUnlockUser.php">Blocca/sblocca un utente</a>
        </li>
        <li>
            <a href="blockUnlockEvent.php">Blocca/sblocca un evento</a>
        </li>
    </ul>

    <footer class="footer-logout">
        <ul class="mb-0 pb-0">
            <li>
                <a onClick="logout()" href="#">Logout</a>
            </li>
        </ul>
    </footer>
</nav>

<script>
var logout = function(event) {
    sessionManager.close();
    //window.location.href = "./login.php";
}
</script>