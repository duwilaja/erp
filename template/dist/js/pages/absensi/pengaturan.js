$(document).ready(function () {
    showtable();
});

function getPengat(id='') { 
    $.ajax({
        type: "get",
        url:'get_pengaturan_absensi/'+id,
        dataType: "json",
        success: function (r) {
           $('input[name="e_tgl_mulai"]').val(r.tgl_mulai);
           $('input[name="e_tgl_akhir"]').val(r.tgl_akhir);
           $('input[name="e_jam_telat"]').val(r.jam_telat);
           $('input[name="id"]').val(r.id);
        }
    });
}

function singkronisasi(id='') {
    $.ajax({
        type: "POST",
        url:'singkornisasi_absen',
        data : {'id' : id},
        dataType: "json",
        beforeSend: function() {
            // setting a timeout
            $('#btn-loading'+id).show();
            $('#btn-singkroniasi').hide();
        },
        success: function (r) {
           if (r.status) {
               Swal.fire(
                 'Berhasil',
                 r.msg,
                 'success'
               );
           }else{
               Swal.fire(
                 'Gagal',
                 r.msg,
                 'error'
               );
           } 

           $('#btn-loading'+id).hide();
           $('#btn-singkroniasi').show();
        },
        error: function () { 
            Swal.fire(
                'Gagal',
                'Terjadi kesalahan sistem, harap hubungi developer',
                'error'
              );

            $('#btn-loading'+id).hide();
            $('#btn-singkroniasi').show();
         }
    });
}

$('#form_add').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "in_pengaturan_absensi",
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
                $('#form_add')[0].reset();
                $('#modal_add').modal('hide');
            }else{
                Swal.fire(
                  'Gagal',
                  r.msg,
                  'error'
                );
            } 
        }
    });
});

$('#form_edit').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "up_pengaturan_absensi",
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
                $('#form_edit')[0].reset();
                $('#modal_edit').modal('hide');
            }else{
                Swal.fire(
                  'Gagal',
                  r.msg,
                  'error'
                );
            } 
        }
    });
});


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
            "url": 'dt_pengaturan_absensi',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            // "targets": [0],
            "orderable": false
        }]
    });
}