<div class="col-12 contenuti">
    <h2 class="text-center"><?php echo $_GET["message"]; ?></h2>
    <?php
        if(isset($_GET["link"]) && isset($_GET["linkName"])){
            echo '<a class="button-orange text-center" href="' . $_GET["link"] . '">' . $_GET["linkName"] . '</a>';
        }
    ?>
</div>