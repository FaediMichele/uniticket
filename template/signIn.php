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
					<form>
						<input type="checkbox" name="rememberMe" value="remember">Ricordami
					</form>
				</div>
                <div class="col-5">
                    <form id="form-signIn">
						<button type="signInButton" id="signIn" name="sitesignIn" onclick="formAction(signUp.php)">Accedi</button> 
                    </form>
                </div>
                <div class="col-1"></div>
            </div>

			<!-- text -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <p align="center">Non hai ancora un account?</p>
                </div>
                <div class="col-1"></div>
            </div>

			<!-- go to singUp page -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <form id="form-signUp" action="signUp.php">
						<button type="signUpButton" id="signUp" name="sitesignUp" value="Go to signUp" >Registrati</button> 
                    </form>
                </div>
                <div class="col-1"></div>
            </div>