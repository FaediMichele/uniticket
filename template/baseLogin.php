<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Page title -->
    <title><?php echo $templateParams["titolo"]; ?></title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Jquery with ajax -->
    <script src="js/jquery.js" type="text/javascript"></script>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    <!-- Add the css pages to the base -->
    <?php 
    if(isset($templateParams["css"])){
        foreach($templateParams["css"] as $val){
        ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $val;?>" /> <?php 
        }   
    }
    if(isset($templateParams["js"])){
        
        foreach($templateParams["js"] as $val){
        ?>
    <script src="<?php echo $val; ?>"></script> <?php 
        }   
    }
    ?>

    <link rel="icon" type="image/png" href="img/favicon/favicon.png">

</head>

<body>
    <!--inizio costellazione-->
    <div id="wrapper">
        <div id="main">
            <canvas id="background" width="1280" height="1024"></canvas>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    <script src="js/costellazione.js"></script>
    <!--fine costellazione-->

    <div class="container-fluid">
        <!-- Page Content  -->
        <header id="header-main">
            <nav class="navbar">
                <a class="navbar-brand mx-auto" href="index.php">
                    <img src="./img/logo.png" height="100" alt="">
                </a>
            </nav>
        </header>
        <?php require($templateParams["nome"]);?>
    </div>
    <div class="overlay"></div>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>

    <script>
    $(document).ready(function() {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('.overlay').on('click', function() {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
        });

        $('input,textarea').focus(function() {
            $(this).data('placeholder', $(this).attr('placeholder'))
                .attr('placeholder', '');
        }).blur(function() {
            $(this).attr('placeholder', $(this).data('placeholder'));
        });

    });
    </script>
</body>

</html>