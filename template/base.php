<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="" href="./css/style.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php 
        if(isset($templateParams["css"])){
            foreach($templateParams["css"] as $val){
            ?>
                <link rel="stylesheet" type="text/css" href="<?php echo $val;?>" /> <?php 
            }   
        }?>
</head>
<body>
    <header>
    <!-- Menu -->
    <div>
        <?php
        if(isset($templateParams["utente"])){
            ?><a href="#">Ciao <?php echo $templateParams["utente"]; ?></a>
        <?php }
        ?>
        <nav>
            <ul>
                <li><a href="#">I miei ordini</a></li>
                <li><a href="#">Carrello</a></li>
                <li><a href="#">La mia agenda</a></li>
                <li><a href="#">Notifiche</a></li>
            </ul>
        </nav>
    </div>

    <!-- Logo -->
    <!-- <img src="<?php echo UPLOAD_DIR?>/logo.png" alt="" /> -->

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
        } else{
            header("Location: notFound.php");
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