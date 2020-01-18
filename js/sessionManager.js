class sessionManager{
    static open($username, $password, $stayLogged){
        $.post("phpFunctions/logIn.php", {username: $username, password: $password}, function(data) {
            if(data == ""){
                console.log("login fault");
            } else {
                var co = "sessionId=" + data
                if($stayLogged) {
                    var date = new Date();
                    date.setTime(date.getTime() + 24 * 3600 * 1000);
                    co += "; expires="+(date.toUTCString());
                }
                console.log(co);
                document.cookie = co;
                window.location.href = "./index.php";
            }
        });
    }

    static close(){
        $.post("phpFunctions/logOut.php");
        document.cookie = '';
    }
}