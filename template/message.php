<div class="col-12 contenuti">
    <div class="row">
        <h2 class="col-12 text-center text-uppercase"><?php echo $_GET["message"]; ?></h2>
    </div>
    <?php
        if(isset($_GET["link"]) && isset($_GET["linkName"])){
            echo '<a class="row justify-content-center mt-5" href="' . $_GET["link"] . '">
                <button class="button-orange text-uppercase col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3">' . $_GET["linkName"] . '</button>
            </a>';
        }
    ?>
</div>