$(document).ready(function() {
    showtable();
});

$('#form_in_data_ruangan').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "in_data_ruangan",
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

                $('#modal_in_data_ruangan').modal('hide');
                $('#form_in_data_ruangan')[0].reset();

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
                'Terjadi gangguan sistem, harap hubungi developer, terima kasih',
                'error'
              );

              $('#btn-save').show();
              $('#btn-save-loading').hide();
         }
    });
});

$('#form_up_data_ruangan').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "up_data_ruangan",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        beforeSend: function() {
           $('#btn-upd').hide();
           $('#btn-upd-loading').show();
        },
        success: function (r) {
            if (r.status) {
                
                Swal.fire(
                  'Berhasil',
                  r.msg,
                  'success'
                );

                $('#modal_up_data_ruangan').modal('hide');
                $('#form_up_data_ruangan')[0].reset();

                $('#btn-upd').show();
                $('#btn-upd-loading').hide();

                showtable();
            }else{

                Swal.fire(
                  'Gagal',
                  r.msg,
                  'error'
                );

                $('#btn-upd').show();
                $('#btn-upd-loading').hide();
            } 
        },
        error: function () { 

            Swal.fire(
                'Gagal',
                'Terjadi gangguan sistem, harap hubungi developer, terima kasih',
                'error'
              );

              $('#btn-upd').show();
              $('#btn-upd-loading').hide();
         }
    });
});

function del_data_ruangan(id) { 
    var r = confirm("Apakah anda yakin ingin menghapus data ini ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "post",
            url: "set_non_aktif_data_ruangan",
            data: {
                'id' : id,
            },
            dataType: "json",
            success: function (r) {
                if(r.status){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    showtable();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: r.msg,
                    })
                }
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}

function edit_data_ruangan(id='') { 
    $.ajax({
        type: "GET",
        url: "get_data_ruangan",
        data : {
            'id' : id
        },
        dataType: "json",
        success: function (r) {
            if (r.status) {
                var x = r.data;
                $('#id').val(x.id);
                $('#e_nama_ruangan').val(x.nama_ruangan);
                $('#e_aktif').val(x.aktif);
            }else{
                Swal.fire(
                    'Gagal',
                    r.msg,
                    'error'
                  );
            }
        },error : function () {
            Swal.fire(
                'Gagal',
                'Terjadi gangguan sistem, harap hubungi developer, terima kasih.',
                'error'
            );
        }
    });
}

function detail_data_ruangan(id='') { 
    $.ajax({
        type: "GET",
        url: "get_data_ruangan",
        data : {
            'id' : id
        },
        dataType: "json",
        success: function (r) {
            if (r.status) {
                var x = r.data;
                $('#txt_nama_ruangan').text(x.nama_ruangan);
                $('#txt_status_ruangan').text(x.status_ruangan);
            }else{
                Swal.fire(
                    'Gagal',
                    r.msg,
                    'error'
                  );
            }
        },error : function () {
            Swal.fire(
                'Gagal',
                'Terjadi gangguan sistem, harap hubungi developer, terima kasih.',
                'error'
              );
        }
    });
}

function showtable() {
	//console.log('list');
    $('#tabel_data_ruangan').DataTable({
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
          "url": 'dt_data_ruangan',
          "type": "POST",
        //   "data" : {
        //       'project' : $('input[name="project_id"]').val()
        //   }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }
