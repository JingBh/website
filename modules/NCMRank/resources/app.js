function loadData(uid) {
    $(".data-user").attr("disabled", "disabled");
    $("#data").stop().fadeOut(200);
    $("#loading").css("opacity", 1);
    $("[id^='chartBy']").removeClass("active");
    $("#chartZoomIn, #chartZoomOut").removeAttr("disabled");
    $("#chartZoom").removeAttr("data-zoom");
    if (uid in _cache) {
        $(".hide-l10").show();
        $("#avatar").hide();
        const data = _cache[uid];
        const hash = "#" + data.user.id;
        if (location.hash !== hash) {
            location.hash = hash;
            if (window._paq) window._paq.push(['trackEvent', 'NCMRank', 'View', data.user.id]);
        }
        $("#username").text(data.user.name);
        $("#level").text(data.user.level);
        $("#total").text(data.user.total);
        if (data.user.avatar) $("#avatar").attr("src", data.user.avatar).show();
        if (data.remain > 0) {
            $("#remain").text(data.remain);
            $("#remainDays").text(data.remainDays);
            $("#remainDaysAll").text(data.remainDaysAll);
            $("#remainDaysMonth").text(data.remainDaysMonth);
            $("#remainDaysReg").text(data.remainDaysReg);
        } else $(".hide-l10").hide();
        $("#regDays").text(data.regDays);
        $("#averageReg").text(data.averageReg);
        $("#averageAll").text(data.averageAll);
        $("#averageWeek").text(data.averageWeek);
        $("#averageMonth").text(data.averageMonth);
        $("#averageByWeek").text(data.averageByWeek);
        $("#lastUpdate").text(data.lastUpdateTime);
        $("#data").stop().fadeIn(200);
        loadChart(data.records);
        $("#loading").css("opacity", 0);
        $(".data-user").removeAttr("disabled");
    } else {
        $.get((_localizedDataUrl || "/ncm_rank/data") + "/" + uid, function(data) {
            _cache[uid] = data;
            loadData(uid);
        });
    }
}
function loadChart(data) {
    $("#chart").remove();
    const chartEle = $('<canvas id="chart"></canvas>');
    $("#chartContainer").append(chartEle);
    const ctx = chartEle[0].getContext('2d');
    $("#chartZoom").attr("data-zoom", 10);
    $("#chartByDay").addClass("active");
    let gra = ctx.createLinearGradient(0, 0, 0, 450);
    gra.addColorStop(0, 'rgba(111, 66, 193, 0.3)');
    gra.addColorStop(0.5, 'rgba(111, 66, 193, 0.2)');
    gra.addColorStop(1, 'rgba(111, 66, 193, 0.05)');
    const chart = new Chart(ctx, {
        type: "bar",
        data: {
            datasets: [{
                label: "日听歌量",
                borderColor: "#6f42c1",
                backgroundColor: gra,
                borderWidth: 2,
                data: []
            }],
            labels: []
        },
        options: {
            maintainAspectRatio: false,
            responsiveAnimationDuration: 500,
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        min: 0,
                        precision: 0,
                        maxTicksLimit: 11
                    }
                }]
            },
            tooltips: {
                displayColors: false,
                backgroundColor: "rgba(0, 0, 0, 0.7)",
                callbacks: {
                    label: function(tooltipItem) {
                        return "听歌" + tooltipItem.yLabel + "首";
                    },
                    afterLabel: function(tooltipItem) {
                        const day = tooltipItem.xLabel;
                        const uid = $(".data-user.active").attr("data-uid");
                        if (_cache[uid].recordsRaw[day]) {
                            return "截至此日累计听歌" + _cache[uid].recordsRaw[day] + "首";
                        } else return "";
                    }
                }
            },
            legend: {
                display: false
            }
        }
    });
    _charts.chart = {
        obj: chart,
        data: data
    };
    updateChart(chart, data);
}
function updateChart(chart, data, animate) {
    const number = Number($("#chartZoom").attr("data-zoom"));
    data = data || [];
    if (animate == undefined) animate = true;
    let cData = [];
    let cLabel = [];
    for (let day in data) {
        cData.push(data[day]);
        cLabel.push(day);
    }
    while (cData.length > number) {
        cData = cData.slice(cData.length - number);
        cLabel = cLabel.slice(cLabel.length - number);
    }
    if (cData.length < number) {
        let offset = number - cData.length;
        for (let i = 1; i <= offset; i ++) {
            cData.unshift(null);
            cLabel.unshift("");
        }
    }
    chart.data.datasets[0].data = cData;
    chart.data.labels = cLabel;
    if (animate === false) {
        chart.update(0);
    } else chart.update();
    _charts.chart.data = data;
}
$(function() {
    $("[title]").tooltip();
    $("#aboutButton").click(function(event) {
        event.preventDefault();
    }).popover({
        html: true,
        placement: "bottom",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header text-dark"></h3><div class="popover-body"></div></div>',
        content: 'NCMRank是<strong>JingBh开发的</strong>用来统计网易云音乐听歌量的小工具，数据全部来自<a href="https://music.163.com/" target="_blank" rel="noreferrer">网易云音乐</a>。'
    });
    $(".data-user").click(function() {
        if (!$(this).attr("disabled")) {
            const activeId = $(".data-user.active").attr("data-uid");
            const thisId = $(this).attr("data-uid");
            if (activeId != thisId) {
                $(".data-user").removeClass("active");
                $(this).addClass("active");
                loadData(thisId);
            }
        }
        return false;
    });
    $(window).resize(function() {
        if ($("#userListToggle").css("display") == "none") $("#userList").collapse("show");
    });
    $("[id^='chartBy']").click(function() {
        if (!$(this).hasClass("active")) {
            const action = $(this).attr("data-action");
            const uid = $(".data-user.active").attr("data-uid");
            let data = _cache[uid];
            if (action == "day") {
                data = data.records;
            } else data = data.recordsByWeek;
            const chart = _charts.chart.obj;
            updateChart(chart, data);
            $("[id^='chartBy']").removeClass("active");
            $(this).addClass("active");
        }
    });
    $("#chartZoomIn, #chartZoomOut").click(function() {
        const min = 8;
        const max = 20;
        const action = $(this).attr("data-action");
        let now = Number($("#chartZoom").attr("data-zoom"));
        if (action == "in") now -= 2;
        if (action == "out") now += 2;
        if (now <= min) {
            now = min;
            $("#chartZoomIn").attr("disabled", "disabled");
        } else $("#chartZoomIn").removeAttr("disabled");
        if (now >= max) {
            now = max;
            $("#chartZoomOut").attr("disabled", "disabled");
        } else $("#chartZoomOut").removeAttr("disabled");
        $("#chartZoom").attr("data-zoom", now);
        const chart = _charts.chart;
        updateChart(chart.obj, chart.data);
    });
    if (location.hash) {
        let target = location.hash.substr(1);
        $(".data-user[data-uid='" + target + "']").click();
    } else $($(".data-user")[0]).click();
    $("#userList").collapse("show");
});
