class sessionManager{
    static open($username, $password, $stayLogged){
        $.post("phpFunctions/logIn.php", {username: $username, password: $password}, function(data) {
            if(data == ""){
                console.log("login fault");
            } else {
                document.cookie = "sessionId=" + data;
                if($stayLogged) {
                    document.cookie += "; expires="+(date.getDate() + 1);
                }
                window.location.href = "../home.php";
            }
        });
    }

    static close(){
        $.post("phpFunctions/logOut.php");
        document.cookie = '';
    }
}