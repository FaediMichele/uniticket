<div class="col-12 contenuti pt-3">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center text-uppercase">Blocca o sblocca un utente</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-6">
            <form id="form-addLocation" class="mt-3" action="phpFunctions/newLocation.php" method="POST" enctype="multipart/form-data">
                <!-- name -->
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="name" id="lblName" class="text-uppercase">*Username</label>
                        <input type="text" name="name" placeholder="Username utente" class="input input-max-width" id="name" required>
                        <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                </div>
                <!-- Addres and CAP -->
                <div class="row">
                    <div class="col-12 text-center pr-0">
                        <label for="address" id="lblAddress" class="text-uppercase ">*Motivo del blocco</label>
                        <input type="text" id="address" name="address" placeholder="Motivo del blocco" class="input" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <button type="button" onclick="uploadEvent()" class="button-orange text-uppercase">Blocca</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <p id="error" class="hidden text-danger">I campi con * sono abbligatori</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row separate">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
</div>

<script>
function uploadEvent(event) {
    var ok = true;
    console.log($("#name").val());
    if ($("#name").val().length == 0) {
        $("#lblName").addClass("text-danger");
        ok = false;
    } else {
        $("#lblName").removeClass("text-danger");
    }
    if ($("#address").val().length == 0) {
        $("#lblAddress").addClass("text-danger");
        ok = false;
    } else {
        $("#lblAddress").removeClass("text-danger");
    }
    if ($("#cap").val().length == 0) {
        $("#lblCap").addClass("text-danger");
        ok = false;
    } else {
        $("#lblCap").removeClass("text-danger");
    }
    if (!ok) {
        $("#error").removeClass("hidden");
    } else {
        $("#form-addLocation").submit();
    }
}
</script>