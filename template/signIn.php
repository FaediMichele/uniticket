            <!-- username -->
            <form>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                            <input class="input" type="username" name="siteusername" placeholder="Username" class="input input-max-width"
                                id="username" />
                    </div>
                    <div class="col-1"></div>
                </div>

                <!-- password -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                            <input class="input" type="password" name="sitepassword" placeholder="Password" class="input input-max-width"
                                id="password" />
                    </div>
                    <div class="col-1"></div>
                </div>

                <!-- signIn -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5">
                        <div class="row-center">
                            <input type="checkbox" name="rememberMe" value="remember"><span class="text-gray"><span class="text-gray"> Ricordami</span>
                        </div>
                    </div>
                    <div class="col-5">
                        <button class="button-orange" type="signInButton" id="signIn" name="sitesignIn" onclick="formAction(signUp.php)">Accedi</button> 
                    </div>
                    <div class="col-1"></div>
                </div>
            </form>
			<!-- text -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    <h6 class="text-center">Non hai ancora un account?</p>
                </div>
                <div class="col-1"></div>
            </div>

			<!-- go to singUp page -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
					<button class="button-white" type="signUpButton" id="signUp" name="sitesignUp" value="Go to signUp" onclick="formAction(signUp.php)" >Registrati</button> 
                </div>
                <div class="col-1"></div>
            </div>