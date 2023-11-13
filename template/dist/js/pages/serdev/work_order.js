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
          "url": 'dt_wo',
          "type": "POST",
          "data": {
              'status' : ''
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
}

function get_serdev_activity(id='') { 
    $.ajax({
        type: "GET",
        url: "get_wo_activity",
        data: {id : id },
        dataType: "json",
        success: function (r) { 
          $('input[name="id"]').val(r.id);
          $('select[name="activity"]').val(r.activity);
          $('textarea[name="remarks"]').val(r.remarks);
        }
      });
}

$('#form_activity').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "in_sdv_wo_activity",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        beforeSend: function() {
           $('#btn-save').hide();
           $('#btn-save-loading').show();
        },
        success: function (r) {
            if (r.status) {
                Swal.fire(
                  'Berhasil',
                  r.msg,
                  'success'
                );
                $('#form_activity')[0].reset();
                $('#serdevActivity').modal('hide');
  
                $('#btn-save').show();
                $('#btn-save-loading').hide();
                showtable();
  
            }else{
                Swal.fire(
                  'Gagal',
                  r.msg,
                  'error'
                );
  
                $('#btn-save').show();
                $('#btn-save-loading').hide();
            } 
        },
        error: function () { 
              Swal.fire(
                'Gagal',
                'Terjadi gangguan sistem, harap hubungi developer',
                'error'
              );
  
              $('#btn-save').show();
              $('#btn-save-loading').hide();
         }
    });
  });