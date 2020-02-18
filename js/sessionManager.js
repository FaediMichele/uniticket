class sessionManager {
    static open($username, $password, $stayLogged) {

        return $.post("phpFunctions/logIn.php", { username: $username, password: $password }, function (data) {
            if (data == "" || data == 0) {
                console.log("login fault");
                return false;
            } else {
                var co = "sessionId=" + data + "; SameSite=Lax"
                if ($stayLogged) {
                    var date = new Date();
                    date.setTime(date.getTime() + 24 * 3600 * 1000);
                    co += "; expires=" + (date.toUTCString());
                }
                co += ""
                document.cookie = co;
                return true;
            }
        });
    }


    static close() {
        $.post("phpFunctions/logOut.php", function (data) {
            if (data != "") {
                console.log(data);
            }
        }).done(function (data) {
            window.location.href = "login.php";
        });
        document.cookie = "sessionId=; SameSite=none Secure; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    }
}