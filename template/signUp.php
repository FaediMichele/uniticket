<!-- email -->
<form class="margin-bottom">
	<div class="row d-flex justify-content-center">
		<div class="col-12 text-center">
			<label for="e-mail" class="lable">e-mail</label>
			<input id="e-mail"class="input" type="username" name="siteusername" placeholder="Username" class="input input-max-width" />
		</div>
	</div>

	<!-- username -->
	<div class="row d-flex justify-content-center">
		<div class="col-12 text-center">
			<label for="username" class="lable">username</label>
			<input class="input" type="password" name="sitepassword" placeholder="Password" class="input input-max-width" id="username" />
        </div>
    </div>

                
    <!-- password -->     
    <div class="row d-flex justify-content-center">
        <div class="col-12 text-center">
            <label for="password" class="lable text-center">password</label>
            <input class="input" type="password" name="sitepassword" placeholder="Password" class="input input-max-width" id="password" />
        </div>
    </div>

    <!-- signIn -->
    <div class="row d-flex justify-content-center">
        <div class="col-12">
			<input type="checkbox" name="sonoOrganizzatore" value="remember"><span class="text-gray"><span class="text-gray"> Sono organizzatore</span>
        </div>
    </div>
                
</form>

<!-- registrati -->
<div class="row d-flex justify-content-center">
	<div class="col-12">
		<button class="button-orange" type="registrami" id="registrazione" name="sitesignUp" value="registrati" onclick="formAction(signUp.php)" >Registrati</button> 
    </div>
</div>

<div class="mt-5 mb-2 separate">
	<div class="circle"></div>
	<div class="circle"></div>
	<div class="circle"></div>
</div>

<!-- help text account esistente -->
<div class="row d-flex justify-content-center">
    <div class="col-12">
        <h6 class="text-center">Hai già un account?</p>
    </div>
</div>

<!-- go to singUp page -->
<div class="row d-flex justify-content-center">
    <div class="col-12">
        <button class="button-white" type="loginButton" id="login" name="sitesLogin" value="Go to login"
            onclick="location.href = 'login.php';">Accedi</button>
    </div>
</div>