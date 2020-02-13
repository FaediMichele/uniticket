<div class="row d-flex justify-content-center">
    <div class="col-11 col-lg-6">
        <div id="error" class="hidden text-danger">Non tutti i campi sono stati inseriti</div>
        <div id="usrAlreadyExist" class="hidden text-danger">L'username inserito è già presente</div>
        <!-- email -->
        <form id="signUpForm" class="margin-bottom" action="phpFunctions/createUser.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 text-center">
                    <label for="e-mail" class="lable">e-mail</label>
                    <input id="e-mail" class="input input-max-width" type="email" name="email" placeholder="e-mail">
                </div>
            </div>

            <!-- username -->
            <div class="row">
                <div class="col-12 text-center">
                    <label for="username" class="lable">username</label>
                    <input class="input input-max-width" type="text" name="username" placeholder="Username"
                        id="username">
                </div>
            </div>


            <!-- password -->
            <div class="row">
                <div class="col-12 text-center">
                    <label for="password" class="lable text-center">password</label>
                    <input type="password" name="password" placeholder="Password" class="input input-max-width"
                        id="password">
                </div>
            </div>

            <!-- manager -->
            <div class="row pl-3 mt-3 mb-4 ">
                <div class="col-12">
                    <input type="checkbox" name="manager" value="1"><span class="text-gray">Sono organizzatore</span>
                </div>
            </div>


            <!-- registrati -->
            <div class="row">
                <div class="col-12">
                    <button type="button" onclick="check()" class="button-orange text-uppercase">Registrati</button>
                </div>
            </div>
        </form>

        <div class="mt-5 mb-2 separate">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>

        <!-- help text account esistente -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <h6 class="text-center">Hai già un account?</h6>
            </div>
        </div>

        <!-- go to singUp page -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <button  class="button-white text-uppercase" onclick="location.href = 'login.php';">Accedi</button>
            </div>
        </div>
    </div>
</div>

<script>
function check(){
    $.post("phpFunctions/checkUsername.php", { username: $("#username").val()}, function (data) {
        console.log(data);
        if(data == 0){
            $("#usrAlreadyExist").addClass("hidden");
            var ok = true;
            if($("#e-mail").val().length < 5){ok = false;}
            if($("#username").val().length < 3){ok = false;}
            if($("#password").val().length < 3){ok = false;}  
            if(!ok){
                $("#error").removeClass("hidden");
            } else {
                $("#signUpForm").submit();
            }
        } else{
            $("#usrAlreadyExist").removeClass("hidden");
        }
    });
}
</script>