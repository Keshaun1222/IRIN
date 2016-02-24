$(document).ready(function() {
    $("#error").css('display', 'none', 'important');
    $("#submit").click(function() {
        var username = $("#username").val();
        var password = $("#password").val();
        
        $.ajax({
            type: "POST",
            url: "login.php",
            data: "username=" + username + "&password=" + password,
            success: function(html) {
                console.log(html);
                if (html == 'true') {
                    window.location="main.php";
                } else {
                    $("#error").html("Incorrect Username or Password").show();
                }
            }, beforeSend: function() {
                $("#error").html("Loading...").show();
            }
        });
        return false;
    });
});