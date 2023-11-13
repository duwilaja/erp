$(document).ready(function () {
    showtable();
    formAddAbsen();
});


function formAddAbsen() {
  $('#absen').submit(function (e) { 
    e.preventDefault();
    var opsi = $('#opsi').val();
    var dt = $(this).serialize();

    if (opsi == 'O') {
         var r = confirm("Apakah anda sudah memastikan bahwa ini jam pulang ?");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "inAbsenOnline",
                secureuri: false,
                contentType: false,
                cache: false,
                processData:false,
                data: new FormData(this),
                dataType: "json",
                success: function (r) {
                if (r.status) {
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                    );
                    showtable();
                    document.getElementById("absen").reset();
                }else{
                    Swal.fire(
                        'Gagal',
                        r.msg,
                        'error'
                    );
                }
                }
            });
        }
    }else{
        $.ajax({
            type: "POST",
            url: "inAbsenOnline",
            secureuri: false,
            contentType: false,
            cache: false,
            processData:false,
            data: new FormData(this),
            dataType: "json",
            success: function (r) {
              if (r.status) {
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
                showtable();
                document.getElementById("absen").reset();
              }else{
                Swal.fire(
                    'Gagal',
                    r.msg,
                    'error'
                  );
              }
            }
          });
    }
  });
}

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
          "url": 'dt_absen_online_personal',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [],
          "orderable": false
        }]
      });
  }
