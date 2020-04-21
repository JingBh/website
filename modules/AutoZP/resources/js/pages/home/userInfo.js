$.get("user/info", function(data) {
    // 判断是否已登录
    if (data[1]) {
        let info = window._userInfo = data[1];
        for (let i in window.onUserInfoReady) {
            window.onUserInfoReady[i]();
        }

        $("#userName").text(info["name"]);
        $("#userSchool").text(info["school"]);
        $("#loginButton").slideUp(200);
        $("#logoutButton").slideDown(200).removeAttr("disabled");

        $.get("user/score", function(data) {
            let ele = $("#userScore");
            if (data[1]) {
                ele.text(data[1]["score"]);
            } else {
                ele.text("获取失败").addClass("text-danger");
            }
        }).fail(function() {
            $("#userScore").text("获取失败").addClass("text-danger");
        }).always(function() {
            $("#userScore").removeClass("text-primary");
        });

        $("#userInfo").show();
    } else {
        $("#logoutButton").slideUp(200);
        $("#loginButton").slideDown(200).removeAttr("disabled");
    }
}).fail(function() {
    alert("加载信息失败，请尝试刷新页面重试。");
}).always(function() {
    $("#userInfoLoading").slideUp(200);
});

require("./loadPhoto");
