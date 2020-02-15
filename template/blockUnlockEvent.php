<div class="col-12 contenuti pt-3">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center text-uppercase">Blocca un evento</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-6">
            <form>
                <!-- name -->
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="name" id="lblIdEventB" class="text-uppercase">*id evento</label>
                        <input type="number" name="name" placeholder="id evento" class="input input-max-width" id="idEventB" required>
                        <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                </div>
                <!-- Message -->
                <div class="row">
                    <div class="col-12 text-center pr-0">
                        <label for="message" id="lblMessageB" class="text-uppercase ">*Messaggio notifiche</label>
                        <input type="text" id="messageB" name="message" placeholder="Motivo del blocco" class="input" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <button type="button" onclick="blockEvent()" class="button-orange text-uppercase">Blocca</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <p id="errorB" class="hidden text-red">I campi con * sono abbligatori</p>
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
    <div class="row">
        <div class="col-12">
            <h3 class="text-center text-uppercase">Sblocca un evento</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-6">
            <form>
                <!-- name -->
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="name" id="lblIdEventS" class="text-uppercase">*id evento</label>
                        <input type="number" name="name" placeholder="id evento" class="input input-max-width" id="idEventS" required>
                        <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                </div>
                <!-- Message -->
                <div class="row">
                    <div class="col-12 text-center pr-0">
                        <label for="message" id="lblMessageS" class="text-uppercase ">*Messaggio notifiche</label>
                        <input type="text" id="messageS" name="message" placeholder="Motivo del blocco" class="input" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <button type="button" onclick="unlockEvent()" class="button-orange text-uppercase">Sblocca</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <p id="errorS" class="hidden text-red">I campi con * sono abbligatori</p>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function blockEvent(event) {
    var ok = true;
    if ($("#idEventB").val().length == 0) {
        $("#lblIdEventB").addClass("text-red");
        ok = false;
    } else {
        $("#lblIdEventB").removeClass("text-red");
    }
    if ($("#messageB").val().length == 0) {
        $("#lblMessageB").addClass("text-red");
        ok = false;
    }
    if (!ok) {
        $("#errorB").removeClass("hidden");
    } else {
        $.post("phpFunctions/blockEvent.php", {
            idEvent: $("#idEventB").val(),
            message: $("#messageB").val()
        }, function(data) {
            if (data > 0) {
                alert("evento bloccato");
            } else if (data == "0") {
                alert("evento non trovato");
            } else {
                console.log(data);
                //window.location.href = "./login.php";
            }
        })
    }
}

function unlockEvent(event) {
    var ok = true;
    if ($("#idEventS").val().length == 0) {
        $("#lblIdEventS").addClass("text-red");
        ok = false;
    } else {
        $("#lblIdEventS").removeClass("text-red");
    }
    if ($("#messageS").val().length == 0) {
        $("#lblMessageS").addClass("text-red");
        ok = false;
    }
    if (!ok) {
        $("#errorS").removeClass("hidden");
    } else {
        $.post("phpFunctions/unlockEvent.php", {
            idEvent: $("#idEventS").val(),
            message: $("#messageS").val()
        }, function(data) {
            if (data > 0) {
                alert("evento sbloccato");
            } else if (data == "0") {
                alert("evento non trovato");
            } else {
                console.log(data);
                //window.location.href = "./login.php";
            }
        })
    }
}
</script>