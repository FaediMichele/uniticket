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
        </li>
    </ul>

    <div class="separate">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <ul>
        <li>
            <a href="#">La mia agenda</a> <!-- cosa deve fare? -->
        </li>
        <li>
            <a href="notice.php">Notifiche</a>
        </li>
    </ul>

    <?php
		if(isset($templateParams["advSidebar"])){
			require($templateParams["advSidebar"]);
		}
	?>

    <footer>
        <ul>
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