require("../packages");

$(function() {
    $("#submitInviteCode").click(function() {
        $(this).attr("disabled", "disbaled")
            .html('<span class="spinner-border spinner-border-sm"></span> 请稍候...');
        $.post("invite_code/verify", {
            "code": $("#inputInviteCode").val()
        }).done(function(data) {
            let input = $("#inputInviteCode");
            if (data[0] === true) {
                input.addClass("is-valid").removeClass("is-invalid");
                location.href = data[1];
            } else input.removeClass("is-valid").addClass("is-invalid");
        }).fail(function() {
            alert("请求出错，请稍后重试。");
        }).always(function() {
            $("#submitInviteCode").removeAttr("disabled").html("提交");
        });
    });

    $("#inputInviteCode").keyup(function(event) {
        if (event.key == "Enter") $("#submitInviteCode").click();
    });
});
