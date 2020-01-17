class sessionManager{
    static open($username, $password, $stayLogged){
        var result;
        $.post("phpFunctions/logIn.php", {username: $username, password: $password}, function(data) {
            console.log(data);
            if(data == ''){
                result = false;
            } else{
                result = true;
                document.cookie = "sessionId=" + data;
                if($stayLogged) {
                    document.cookie += "; expires="+(date.getDate() + 1);
                }
            }
            console.log(data); 
        });
        return result;
    }

    static close(){
        $.post("phpFunctions/logOut.php");
        document.cookie = '';
    }
}