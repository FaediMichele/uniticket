class sessionManager {
    static open($username, $password, $stayLogged) {
        $.post("phpFunctions/logIn.php", { username: $username, password: $password }, function (data) {
            if (data == "" || data == 0) {
                console.log("login fault");
                console.log(data.lenght);
            } else {
                var co = "sessionId=" + data
                if ($stayLogged) {
                    var date = new Date();
                    date.setTime(date.getTime() + 24 * 3600 * 1000);
                    co += "; expires=" + (date.toUTCString());
                }
                console.log(co);
                document.cookie = co;
                window.location.href = "./index.php";
            }
        });
    }

    static close() {
        $.post("phpFunctions/logOut.php", function (data) {
            if (data != "") {
                console.log(data);
            }
        }).done(function(data) {
            location.reload();
        });
        document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
}