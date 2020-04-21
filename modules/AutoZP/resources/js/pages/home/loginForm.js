function refreshValidateCode() {
    $.get("login/validateCode", function(data) {
        if (data[0] === true) {
            let result = data[1];
            $("#loginValidateCodeImage").attr("src", result["image_url"]);
            $("#loginInputValidateFlag").val(result["flag"]);
            $("#loginValidateCodeGroup").slideDown(200);
        }
    });
}

if ($("#loginInputPassword").val())
    $("#loginRememberPassword")[0].checked = true;

$("#loginSubmit").click(function() {
    $("#loginTimeHint").removeClass("text-muetd").addClass("text-info");
    $("#loginError, #loginSuccess").hide();
    if ($("#loginAgreeTerms")[0].checked === true) {
        $(this).attr("disabled", "disabled")
            .html('<span class="spinner-border spinner-border-sm"></span> 请稍候...');
        $.post("login", {
            "username": $("#loginInputUsername").val(),
            "password": $("#loginInputPassword").val(),
            "flag": $("#loginInputValidateFlag").val(),
            "validateCode": $("#loginInputValidateCode").val(),
            "remember": $("#loginRememberPassword")[0].checked
        }).done(function(data) {
            if (data["success"] === true) {
                $("#loginSuccess").slideDown(200);
                location.reload();
            } else {
                $("#loginError").slideDown(200)
                    .children("span").text(data["message"]);
                if (data["reload"]) window.setTimeout(function() {
                    location.reload();
                }, 3000);
            }
        }).fail(function() {
            alert("请求出错，请稍后重试。");
        }).always(function() {
            refreshValidateCode();
            $("#loginSubmit").removeAttr("disabled").html("提交");
            $("#loginTimeHint").addClass("text-muetd").removeClass("text-info");
        });
    } else $("#loginError").slideDown(200)
        .children("span").text("请先阅读并同意用户协议。");
});

$("[id^='loginInput']").keyup(function(event) {
    if (event.key == "Enter") $("#loginSubmit").click();
});

$("#logoutButton").click(function() {
    $.post("logout").done(function() {
        location.reload();
    });
});

$("#loginAgreeTerms").change(function() {
    let submitButton = $("#loginSubmit");
    if (this.checked === true) {
        submitButton.stop().removeAttr("disabled").fadeIn(100);
    } else submitButton.stop().attr("disabled", "disabled").fadeOut(100);
});

$("#loginModal").on("show.bs.modal", function() {
    refreshValidateCode();
});
