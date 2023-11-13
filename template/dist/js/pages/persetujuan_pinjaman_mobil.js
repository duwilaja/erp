$(document).ready(function() {
    $('[data-toggle="tooltip1"]').tooltip();  
    $('[data-toggle="tooltip2"]').tooltip();  
    $('[data-toggle="tooltip3"]').tooltip();  
    showtable();
    // $('input[name="datetimes"]').daterangepicker({
    //   singleDatePicker: true,
    //   format: 'YYYY-MM-DD hh:mm A'
    // });
    $('input[name="tmp"]').daterangepicker({
      // autoUpdateInput: false,
      singleDatePicker: true,
      timePicker: true,
      startDate: moment().startOf('hour'),
      endDate: moment().startOf('hour').add(32, 'hour'),
      timePicker24Hour : true,
      locale: {
        format: 'YYYY-MM-DD HH:mm'
      }
    });
    $('input[name="tsp"]').daterangepicker({
      // autoUpdateInput: false,
      singleDatePicker: true,
      timePicker: true,
      timePicker24Hour : true,
      // startDate: moment().startOf('hour'),
      // endDate: moment().startOf('hour').add(32, 'hour'),
      locale: {
        format: 'YYYY-MM-DD HH:mm'
      }
    });
} );

function showtable() {
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
          "url": 'dt_persetujuan_peminjaman_mobil',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [8],
          "orderable": false
        }]
      });
  }

  $(function() {
    $('#pnjm_tujuan').change(function(){
        $('.tujuan').hide();
        $('#' + $(this).val()).show();
    });
});

  