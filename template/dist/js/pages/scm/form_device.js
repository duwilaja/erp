$('#upload_device').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "import_sd",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        beforeSend: function() {
           $('#btn-import').hide();
           $('#btn-import-loading').show();
        },
        success: function (r) {
            if (r.status) {
                Swal.fire(
                  'Berhasil',
                  r.msg,
                  'success'
                );
                $('#upload_device')[0].reset();
                $('#modal_import_device').modal('hide');

                $('#btn-import').show();
                $('#btn-import-loading').hide();

            }else{
                Swal.fire(
                  'Gagal',
                  r.msg,
                  'error'
                );

                $('#btn-import').show();
                $('#btn-import-loading').hide();
            } 
        },
        error: function () { 
            Swal.fire(
                'Gagal',
                'Terjadi kesalahan upload',
                'error'
              );

              $('#btn-import').show();
              $('#btn-import-loading').hide();
         }
    });
});
