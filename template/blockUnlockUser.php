<div class="col-12 contenuti pt-3">
    <div class="row">
        <div class="col-12">
            <h3 class="text-center text-uppercase">Blocca un utente</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-6">
            <form>
                <!-- name -->
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="name" id="lblNameB" class="text-uppercase">*Username</label>
                        <input type="text" name="name" placeholder="Username utente" class="input input-max-width" id="nameB" required>
                        <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                </div>
                <!-- Message -->
                <div class="row">
                    <div class="col-12 text-center pr-0">
                        <label for="message" id="lblMessage" class="text-uppercase ">*Motivo del blocco</label>
                        <input type="text" id="message" name="message" placeholder="Motivo del blocco" class="input" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <button type="button" onclick="blockUser()" class="button-orange text-uppercase">Blocca</button>
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
            <h3 class="text-center text-uppercase">Sblocca un utente</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-6">
            <form>
                <!-- name -->
                <div class="row">
                    <div class="col-12 text-center">
                        <label for="name" id="lblNameS" class="text-uppercase">*Username</label>
                        <input type="text" name="name" placeholder="Username utente" class="input input-max-width" id="nameS" required>
                        <!-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <button type="button" onclick="unlockUser()" class="button-orange text-uppercase">Sblocca</button>
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
function blockUser(event) {
    var ok = true;
    if ($("#nameB").val().length == 0) {
        $("#lblNameB").addClass("text-red");
        ok = false;
    } else {
        $("#lblNameB").removeClass("text-red");
    }
    if ($("#message").val().length == 0) {
        $("#lblMessage").addClass("text-red");
        ok = false;
    }
    if (!ok) {
        $("#errorB").removeClass("hidden");
    } else {
        $.post("phpFunctions/blockUser.php", {
            username: $("#nameB").val(),
            message: $("#message").val()
        }, function(data) {
            if (data > 0) {
                alert("utente bloccato");
            } else if (data == "0") {
                alert("utente non trovato");
            } else {
                console.log(data);
                window.location.href = "./login.php";
            }
        })
    }
}

function unlockUser(event) {
    var ok = true;
    if ($("#nameS").val().length == 0) {
        $("#lblNameS").addClass("text-red");
        ok = false;
    } else {
        $("#lblNameS").removeClass("text-red");
    }
    if (!ok) {
        $("#errorS").removeClass("hidden");
    } else {
        $.post("phpFunctions/unlockUser.php", {
            username: $("#nameS").val()
        }, function(data) {
            console.log(data);
            if (data > 0) {
                alert("utente sbloccato");
            } else if (data == "0") {
                alert("utente non trovato");
            } else {
                console.log(data);
                window.location.href = "./login.php";
            }
        })
    }
}
</script>