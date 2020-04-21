require("datatables.net");
require("datatables.net-bs4");
require("datatables.net-fixedheader-bs4");
require("datatables.net-responsive-bs4");

$.extend($.fn.dataTable.defaults, {
    "language": require("./utils/datatables_langs/zh_CN")
});
