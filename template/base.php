<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script>
    <!-- Add the css pages to the base -->
    <?php 
    if(isset($templateParams["css"])){
        foreach($templateParams["css"] as $val){
        ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $val;?>" /> <?php 
        }   
    }?>

</head>

<body>

    <div class="container-fluid">

        <!-- Sidebar  -->
        <nav id="sidebar">

            <header class="sidebar-header">
                <h3>Ciao Utente</h3>
            </header>
            <ul>
                <li>
                    <a href="#">I miei ordini</a>
                </li>
                <li>
                    <a href="#">Carrello</a>
                </li>
            </ul>

            <div class="separate">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>

            <ul>
                <li>
                    <a href="#">La mia agenda</a>
                </li>
                <li>
                    <a href="#">Notifiche</a>
                </li>
            </ul>

            <div class="separate">
                <div class="circle"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>

            <ul>
                <li>
                    <a href="#">Organizza un nuovo evento</a>
                </li>
                <li>
                    <a href="#">Lista Eventi organizzati</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->

        <header id="header-main">

            <nav class="navbar">
                <!-- bottone per la side bar -->
                <button type="button" id="sidebarCollapse">
                    <i class="fas fa-bars fa-2x"></i>
                </button>
                <a class="navbar-brand mx-auto" href="#">
                    <img src="./img/logo.png" height="100" alt="">
                </a>
            </nav>

            <!-- ricerca -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <form id="form-search">
                        <span class="icon"><i class="fa fa-search"></i></span>
                        <input type="search" name="sitesearch" placeholder="Search" class="input input-max-width"
                            id="search" />
                    </form>
                </div>
                <div class="col-1"></div>
            </div>
        </header>

        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10">
                <div class="row">
                    <?php
                        if(isset($templateParams["nome"])){
                            require($templateParams["nome"]);
                        } else{
                            header("Location: notFound.php");
                        }
                    ?>
                
                </div>
            </div>
            <div class="col-1">
            </div>
        </div>

    </div>
    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('.overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
            });

            $('input,textarea').focus(function () {
                $(this).data('placeholder', $(this).attr('placeholder'))
                    .attr('placeholder', '');
            }).blur(function () {
                $(this).attr('placeholder', $(this).data('placeholder'));
            });

        });
    </script>

</body>

</html>