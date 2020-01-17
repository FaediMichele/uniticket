class sessionManger{
    static open($username, $password){
        $.post("php/logIn.php", {username: $username, passord: $password}, function(data) {
            document.cookie = "sessionId=" + data +"; expires="+(date.getDate() + 1);
        });
    }

    static close(){
        $.post("php/logOut.php");
        document.cookie = '';
    }
}