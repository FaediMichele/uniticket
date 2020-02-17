<div class="col-11 contenuti pt-3">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-uppercase">Crea nuova sala</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-6">
            <form id="form-addRoom" class="mt-3" action="phpFunctions/newRoom.php" method="POST" enctype="multipart/form-data">
                <!-- name -->
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="name" id="lblName" class="text-uppercase">*Nome sala</label>
                        <input type="text" name="name" placeholder="Nome sala es: SALA2" class="input input-max-width" id="name" required>
                        <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                </div>
                <!-- capacity and location -->
                <div class="row">
                    <!-- locale -->
                    <div class="col-8  text-center">
                        <label for="place" id="lblplace" class="text-uppercase">*Locale</label>
                        <select class="form-control input-dropdown" name="roomName" id="place">
                            <?php   
                                $array = $dbh->getLocationsAndRoom($_COOKIE["sessionId"]);
                                $locationData = json_encode($array);
                                $keys = array_keys($array);
                                for($i=0; $i < count($keys); $i++){
                                    echo '<option value="' . strval($keys[$i]) . '">' . strval($keys[$i]) . '</option>';
                                }
                        ?>
                        </select>
                    </div>
                    <div class="col-4  text-center">
                        <label for="capacity" id="lblCapacity" class="text-uppercase">*Capienza</label>
                        <input type="text" id="capacity" name="capacity" placeholder="Capienza" class="input" required>
                    </div>
                </div>
                <!-- button -->
                <div class="row">
                    <div class="col-12 mt-2  text-center">
                        <button type="button" onclick="uploadEvent()" class="button-orange">CREA SALA</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                        <p id="error" class="hidden text-danger">I campi con * sono abbligatori</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function uploadEvent(event) {
    var ok = true;
    if ($("#name").val().length == 0) {
        $("#lblName").addClass("text-danger");
        ok = false;
    } else {
        $("#lblName").removeClass("text-danger");
    }
    if ($("#capacity").val().length == 0) {
        $("#lblCapacity").addClass("text-danger");
        ok = false;
    } else {
        $("#lblCapacity").removeClass("text-danger");
    }
    if (!ok) {
        $("#error").removeClass("hidden");
    } else {
        console.log("SONO QUI");
        $("#form-addRoom").submit();
    }
}
</script>