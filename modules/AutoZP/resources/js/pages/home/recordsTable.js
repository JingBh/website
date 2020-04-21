function loadRecordsTable() {
    $.get("user/records", {}).done(function(data) {
        let api = $("#recordsTable").DataTable({
            columns: [{
                name: "id",
                data: "id",
                title: "记录ID",
                render: function(data) {
                    return `<strong>${data}</strong>`;
                },
                visible: false
            }, {
                name: "title",
                data: "title",
                title: "标题",
                responsivePriority: 1,
                className: "text-truncate limit-1"
            }, {
                name: "content",
                data: "content",
                title: "内容",
                responsivePriority: 100,
                className: "none"
            }, {
                name: "score",
                data: "score",
                title: "分数变化",
                responsivePriority: 1,
                render: function(data) {

                    // Round with 2 digits.
                    let value = Number(data) * 100;
                    value = Math.round(value) / 100;

                    // Add Color
                    if (value < 0) {
                        return `<strong class="text-danger">${data}</strong>`;
                    } else if (value > 0) {
                        return `<strong class="text-success">+${data}</strong>`;
                    } else return `<strong>${data}</strong>`;
                }
            }, {
                name: "submitter",
                data: "submitter",
                title: "提交者",
                className: "min-tablet-l",
                responsivePriority: 3
            }, {
                name: "date",
                data: "date",
                title: "提交时间",
                className: "min-tablet-p",
                responsivePriority: 2
            }],
            autoWidth: false,
            scrollX: true,
            order: [[5, "desc"]],
            pageLength: 10,
            lengthChange: false,
            info: false,
            pagingType: "simple",
            responsive: {
                details: {
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll()
                    // TODO: 重写这个破东西
                }
            }
        });
        api.clear();
        api.rows.add(data[1]);
        api.draw();
        $("#recordsLoading").slideUp(200);
        // Auto redraw on resize.
        $(window).resize(function() {
            window.setTimeout(function() {
                $("#recordsTable").DataTable().columns.adjust();
            }, 200);
        });
    }).fail(function() {
        $("#recordsLoading").text("历史记录查询失败。").addClass("text-danger");
    });
}

window.onUserInfoReady.push(function() {
    loadRecordsTable();
});
