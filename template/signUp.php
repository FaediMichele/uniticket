<div class="row d-flex justify-content-center">
    <div class="col-11 col-lg-6">
        <div id="error" class="hidden text-danger">
            <p>Non tutti i campi sono stati inseriti</p>
        </div>
        <div id="usrAlreadyExist" class="hidden text-danger">
            <p>L'username inserito è già presente</p>
        </div>
        <div id="emailAlreadyExist" class="hidden text-danger">
            <p>La mail è già utilizzata in un altro account</p>
        </div>
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
                    <input class="input input-max-width" type="text" name="username" placeholder="Username" id="username">
                </div>
            </div>


            <!-- password -->
            <div class="row">
                <div class="col-12 text-center">
                    <label for="password" class="lable text-center">password</label>
                    <input type="password" name="password" placeholder="Password" class="input input-max-width" id="password">
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
                <button class="button-white text-uppercase" onclick="location.href = 'login.php';">Accedi</button>
            </div>
        </div>
    </div>
</div>

<script>
var name = true;
var mail = true;

function check() {
    var ok = true;
    if ($("#e-mail").val().length < 5) {
        ok = false;
    }
    if ($("#username").val().length < 3) {
        ok = false;
    }
    if ($("#password").val().length < 3) {
        ok = false;
    }
    if (!ok) {
        $("#error").removeClass("hidden");
    } else {
        $("#error").addClass("hidden");
        $.post("phpFunctions/checkUsername.php", {
            username: $("#username").val()
        }, function(data) {
            if (data != 0) {
                $("#usrAlreadyExist").removeClass("hidden");
                name = false;
            } else {
                $("#usrAlreadyExist").addClass("hidden");
                name = true;
            }
        }).done(function() {
            $.post("phpFunctions/checkEmail.php", {
                email: $("#e-mail").val()
            }, function(data) {
                if (data != 0) {
                    $("#emailAlreadyExist").removeClass("hidden");
                    email = false;
                } else {
                    $("#emailAlreadyExist").addClass("hidden");
                    email = true;
                }
            }).done(function() {
                if (name && email) {
                    $("#signUpForm").submit();
                }
            });
        });
    }
}
</script>