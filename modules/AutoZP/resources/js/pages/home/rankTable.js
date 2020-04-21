const params = {
    "orgId": "orgId",
    "schoolyearId": "yearId",
    "schoolsemesterId": "semesterId",
    "gradeId": "gradeId",
    "classId": "classId"
};

window.onUserInfoReady.push(function() {
    for (let param in params) {
        $("#inputRankParam_" + param).val(window._userInfo["term"][params[param]]);
    }
});

$("#switchRankCustom").change(function() {
    if (this.checked === true) {
        $("#inputRankParamsGroup").stop().slideDown(200);
        $("#switchRankGradeGroup").stop().slideUp(200);
    } else {
        $("#inputRankParamsGroup").stop().slideUp(200);
        $("#switchRankGradeGroup").stop().slideDown(200);
    }
});

$("#rankSubmit").click(function() {
    $(this).attr("disabled", "disabled")
        .html('<span class="spinner-border spinner-border-sm"></span> 正在查询...');
    let p = {};
    p["custom"] = $("#switchRankCustom")[0].checked ? "yes" : "no";
    if (p["custom"] == "yes") {
        for (let param in params) {
            let ele = $("#inputRankParam_" + param);
            if (ele.val()) p[param] = ele.val();
        }
    } else p["grade"] = $("#switchRankGrade")[0].checked ? "yes" : "no";
    $.get("user/rank", p).done(function(data) {
        let api = $("#rankTable").DataTable();
        api.clear();
        api.rows.add(data[1]);
        api.draw();
        $("#rankResult").slideDown(200);
    }).fail(function() {
        alert("查询失败。");
    }).always(function() {
        $("#rankSubmit").text("查询").removeAttr("disabled");
    });
});

$("#rankTable").DataTable({
    columns: [{
        name: "id",
        data: "id",
        title: "教育ID"
    }, {
        name: "name",
        data: "name",
        title: "姓名"
    }, {
        name: "score",
        data: "score",
        title: "分数"
    }],
    order: [[2, "desc"]],
    pageLength: 15,
    lengthChange: false,
    info: false,
    pagingType: "simple"
});
