$(document).ready(function() {
    showtable();
} );

function showtable(s='') {
    $('#tabel').DataTable({
        // Processing indicator
        "bAutoWidth": false,
        "destroy": true,
        "searching": true,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        "scrollX": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
          "url": url+'project/dt/'+s,
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }

function cekProject(v) {
    if (v == 1) {
        $('#addHref').attr('href',url+'project/profitability_plan');
    }else if (v == 2) {
        $('#addHref').attr('href',url+'project/project_archive');
    }else if (v == 3) {
        $('#addHref').attr('href',url+'project/request_invoicing');
    }
}