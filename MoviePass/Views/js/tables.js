$(document).ready(function () {
    $('#dt-fixed-footer').dataTable({
      "paging": false,
      "fnInitComplete": function () {
        var myCustomScrollbar = document.querySelector('#dt-fixed-footer_wrapper .dataTables_scrollBody');
        var ps = new PerfectScrollbar(myCustomScrollbar);
      },
      "scrollY": 450,
    });
  });