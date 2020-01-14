			<!-- username -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <form id="form-username">
                        <input type="username" name="siteusername" placeholder="Username" class="input input-max-width"
                            id="username" />
                    </form>
                </div>
                <div class="col-1"></div>
            </div>

			<!-- password -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <form id="form-password">
                        <input type="password" name="sitepassword" placeholder="Password" class="input input-max-width"
                            id="password" />
                    </form>
                </div>
                <div class="col-1"></div>
            </div>

			<!-- signIn -->
            <div class="row">
                <div class="col-1"></div>
				<div class="col-5">
					<input type="checkbox" name="rememberMe" value="remember">Ricordami
				</div>
                <div class="col-5">
					<button class="button-orange" type="signInButton" id="signIn" name="sitesignIn" onclick="formAction(signUp.php)">Accedi</button> 
                </div>
                <div class="col-1"></div>
            </div>

			<!-- text -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <p>Non hai ancora un account?</p>
                </div>
                <div class="col-1"></div>
            </div>

			<!-- go to singUp page -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
					<button class="button-orange" type="signUpButton" id="signUp" name="sitesignUp" value="Go to signUp" onclick="formAction(signUp.php)" >Registrati</button> 
                </div>
                <div class="col-1"></div>
            </div>