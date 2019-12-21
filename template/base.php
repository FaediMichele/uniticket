<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UniTicket</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
    <!-- Menu -->
    <nav>
        <ul>
            <li><a href="#">I miei ordini</a></li>
            <li><a href="#">Carrello</a></li>
            <li><a href="#">La mia agenda</a></li>
            <li><a href="#">Notifiche</a></li>
        </ul>
    </nav>

    <!-- Search box -->
    <form >
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    </header>
    
    <main>
    <?php
        if(isset($templateParams["nome"])){
            require($templateParams["nome"]);
        }
    ?>
    </main>
    <aside>
        
    </aside>
    <footer>
        <p>Sede legale, e info azienda?</p>
    </footer>
</body>
</html>