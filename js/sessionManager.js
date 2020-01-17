class sessionManger{
    constructor(){
        if(document.cookie == ''){
            window.location.href = 'login.php';
        }
    }

    open($username, $password){
        $.post("php/logIn.php", {username: $username, passord: $password}, function(data) {
            document.cookie = "sessionId=" + data +"; expires="+(date.getDate() + 1);
        });
    }

    close(){
        $.post("php/logOut.php");
        document.cookie = '';
    }
}