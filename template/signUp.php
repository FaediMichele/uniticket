            <!-- email -->
            <form class="margin-bottom">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                        <label for="e-mail" class="lable">e-mail</label>
                        <input id="e-mail"class="input" type="username" name="siteusername" placeholder="Username" class="input input-max-width"
                                 />
                    </div>
                    <div class="col-1"></div>
                </div>

                <!-- username -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                            <label for="username" class="lable">username</label>
                            <input class="input" type="password" name="sitepassword" placeholder="Password" class="input input-max-width"
                                id="username" />
                    </div>
                    <div class="col-1"></div>
                </div>

                
                <!-- password -->     
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10 text-center">
                            <label for="password" class="lable text-center">password</label>
                            <input class="input" type="password" name="sitepassword" placeholder="Password" class="input input-max-width"
                                id="password" />
                    </div>
                    <div class="col-1"></div>
                </div>

                <!-- signIn -->
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <div class="row-center">
                            <input type="checkbox" name="sonoOrganizzatore" value="remember"><span class="text-gray"><span class="text-gray"> Sono organizzatore</span>
                        </div>
                    </div>
                </div>
                
            </form>
			<!-- text -->


			<!-- registrati -->
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
					<button class="button-orange" type="registrami" id="registrazione" name="sitesignUp" value="registrati" onclick="formAction(signUp.php)" >Registrati</button> 
                </div>
                <div class="col-1"></div>
            </div>