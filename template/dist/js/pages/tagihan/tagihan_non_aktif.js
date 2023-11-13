
$(document).ready(function () {
    showtable();
});

function showtable() {
	//console.log('list');
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
          "url": 'dtTagihan?s=0',
          "type": "POST",
          "data" : {
            'a' : '0'
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [4],
          "orderable": false
        }]
      });
  }
