<nav id="sidebar">

	<header class="sidebar-header">
		<h3>Ciao Utente</h3>
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
            <a href="#">La mia agenda</a>	<!-- cosa deve fare? -->
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
                <a href="#">Logout</a>
            </li>
        </ul>
    </footer>
</nav>