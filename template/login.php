<form>

    <!-- username -->
    <div class="row">
        <div class="col-12">
            <input class="input" type="username" name="siteusername" placeholder="Username"
                class="input input-max-width" id="username" />
        </div>
    </div>

    <!-- password -->
    <div class="row">
        <div class="col-12">
            <input class="input" type="password" name="sitepassword" placeholder="Password"
                class="input input-max-width" id="password" />
        </div>
    </div>

    <!-- signIn -->
    <div class="row">
        <div class="col-6">
            <div class="row-center">
                <input type="checkbox" name="rememberMe" value="remember" id="remember"><span class="text-gray"><span
                        class="text-gray"> Ricordami</span>
            </div>
        </div>
        <div class="col-6">
            <button class="button-orange" type="button" id="signIn" name="sitesignIn"
                onclick="handleSignIn();">Accedi</button>
        </div>
    </div>
</form>

<!-- help text no account -->
<div class="row">
    <div class="col-12">
        <h6 class="text-center">Non hai ancora un account?</p>
    </div>
</div>

<!-- go to singUp page -->
<div class="row">
    <div class="col-12">
        <button class="button-white" type="signUpButton" id="signUp" name="sitesignUp" value="Go to signUp"
            onclick="formAction(signUp.php)">Registrati</button>
    </div>
</div>

<script>
function handleSignIn() {
    /* also redirect to the home */
    // sessionManager.open($("#username").val(), $("#password").val(), $('#remember').is(":checked"))
}
</script>