// 	* submit the create student form
// 		*/
$("#msg").hide();
$(".please_wait").hide();
$("#submit-button").on("click", function (event) {
    var url = $('#login_form').attr('action');
	$("#submit-button").hide();
    $(".please_wait").show();
    $(".error").empty();
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: $("#login_form").serializeArray(),
        success: function (response) {
            console.log(response)
           // $("#submit-button").show();
            $(".please_wait").show();
            if (response.response == true) {
                if($('#login_form').hasClass('content')) {
                    window.location.replace(window.location.href);
                } else {
                    window.location.replace(response.redirect);
                }
            } else {
                $("#submit-button").show();
                $(".please_wait").hide();
                $("#email_error").html(response.email);
                $("#password_error").html(response.password);
                if (response.error != null && response.error != "") {
                    $("#error").show();
                    $("#error").html(response.error);
                }
            } // /else
        }, // /success
    }); // /ajax
});

///

//register form
$("#register-button").on("click", function (event) {
    $("#msg").hide();
    $("#register-button").hide();
    $(".please_wait").show();
    var url = $('#register_form').attr('action');
    $(".error").empty();
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: $("#register_form").serializeArray(),
        success: function (response) {
            if (response.response == true) {
                $("#form_id").trigger("reset");
                $("#msg").show();
                $("#msg").html(response.msg);
                window.setTimeout(function(){location.reload()},500)
                //window.location.href = "/template";
            } else {
                $("#register-button").show();
                $(".please_wait").hide();
                $("#register_password").html(response.password);
                $("#checkbox_error").html(response.checkbox);
                $("#emailaddress_error").html(response.email);
                $("#username_error").html(response.username);
                $("#g_recaptcha_response").html(response['g-recaptcha-response']);
                if (response.error != "") {
                    $("#error").html(response.error);
                }
            } // /else
        }, // /success
    }); // /ajax
});
$("#submit").on("click", function (e) {
    $("#submit").hide();
    $(".plz_wait").fadeIn();
    var url = $('#recoverForm').attr('action');
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: $("#recoverForm").serializeArray(),
        success: function (data) {
            //$("#submit").show();
            $(".plz_wait").show();
            if (data.response) {
                $("#emailerror").html(data.msg);
            } else {
                if (data.msg != "") {
                    $("#emailerror").html(data.msg);
                }
                if (data.email_error != "")
                    $("#emailerror").html(data.email_error);
            }
        },
    });
});

function openmodel(open, close) {
    $("#" + close + "").modal("hide");
    $("#" + open + "").modal("show");
}
