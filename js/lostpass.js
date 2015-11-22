$(document).ready(function() {
    $("#error").css('display', 'none', 'important');
    $("#submit").click(function() {
        var email = $("#email").val();
        $.ajax({
            type: "POST",
            url: "lostpassword.php",
            data: "email=" + email,
            success: function(html) {
                if (html == 'true') {
                    window.location="index.php";
                } else {
                    $("#error").html("No records found matching your email address.").show();
                }
            }, beforeSend: function() {
                $("#error").html("Loading...").show();
            }
        });
        return false;
    });
});