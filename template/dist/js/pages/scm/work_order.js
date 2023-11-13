$(document).ready(function() {
    showtable();
} );

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
          "url": 'dt_projek_by_po',
          "type": "POST",
        //   'data' :{
        //       'device_id' : $('#device_id').val()
        //   }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }
