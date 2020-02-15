<div class="col-12 contenuti pt-3">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-uppercase">Crea nuovo locale</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-6">
            <form id="form-addLocation" class="mt-3" action="phpFunctions/newLocation.php" method="POST" enctype="multipart/form-data">
                <!-- name -->
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="name" id="lblName" class="text-uppercase">*Nome locale</label>
                        <input type="text" name="name" placeholder="Nome edificio es: Energy" class="input input-max-width" id="name" required>
                        <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                </div>
                <!-- Addres and CAP -->
                <div class="row">
                    <div class="col-8 text-center pr-0">
                        <label for="address" id="lblAddress" class="text-uppercase ">*Indirizzo</label>
                        <input type="text" id="address" name="address" placeholder="Indirizzo es: via roma 105" class="input" required>
                    </div>
                    <div class="col-4 text-center">
                        <label for="cap" id="lblCap" class="text-uppercase">*CAP</label>
                        <input type="number" id="cap" name="cap" placeholder="CAP es: 47522" class="input" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189" required>
                    </div>
                </div>
                <!-- phone and email -->
                <div class="row">
                    <div class="col-6 text-center">
                        <label for="tel" id="lblTel" class="text-uppercase">tel.</label>
                        <input class="input" type="text" id="tel" name="tel" pattern="[0-9]{10}" placeholder="Numero di telefono">
                    </div>
                    <div class="col-6 text-center pl-0">
                        <label for="email" id="lblEmail" class="text-uppercase ">e-mail</label>
                        <input class="input" type="email" id="email" name="email" placeholder="Indirizzo email">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <button type="button" onclick="uploadEvent()" class="button-orange text-uppercase">crea locale</button>
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