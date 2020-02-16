<div class="row d-flex justify-content-center">
    <div class="col-11 col-lg-6">
        <div id="error" class="hidden text-danger">Username o password sbagliati</div>
        <form>
            <!-- username -->
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <input class="input  input-max-width" type="text" name="siteusername" placeholder="Username" id="username" />
                </div>
            </div>

            <!-- password -->
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <input type="password" name="sitepassword" placeholder="Password" class="input input-max-width" id="password" />
                </div>
            </div>

            <!-- signIn -->
            <div class="row d-flex justify-content-center">
                <div class="pl-3 col-6">
                    <div class="row-center">
                        <input type="checkbox" name="rememberMe" value="remember" id="remember">
                        <span class="text-gray"> Ricordami</span>
                    </div>
                </div>
                <div class="col-6">
                    <button class="button-orange text-uppercase" type="button" id="signIn" name="sitesignIn" onclick="handleSignIn();">Accedi</button>
                </div>
            </div>
        </form>

        <div class="mt-5 mb-2 separate">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>

        <!-- help text no account -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <h6 class="text-center">Non hai ancora un account?</h6>
            </div>
        </div>

        <!-- go to singUp page -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <button class="button-white text-uppercase" id="signUp" name="sitesignUp" value="Go to signUp" onclick="location.href = 'signUp.php';">Registrati</button>
            </div>
        </div>
    </div>
</div>

<script>
function handleSignIn() {
    sessionManager.open($("#username").val(), $("#password").val(), $('#remember').is(":checked")).success(function(data) {
        console.log(data);
        if (data == -1) {
            $("#error").html("L'account non è stato ancora abilitato");
            $("#error").removeClass("hidden");
        } else if (data != 0) {
            window.location.href = "./index.php";
        } else {
            $("#error").html("Username o password sbagliati");
            $("#error").removeClass("hidden");
        }

    });
}

/* add event listener to enter button*/
var input = document.getElementById("password");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("signIn").click();
    }
});
</script>