$(document).ready(function () {
    $('#karyawan').select2({
        dropdownParent: $('#addModal')
    });
    dt_tracking_covid();
    addTracking();
    upTracking();
    getKaryawan();
});

function dt_tracking_covid() {
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
            "url": 'dt_tracking_covid',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,2],
            "orderable": false
        }]
    });
}

function dt_histori_covid(tcid) {
    $('#tabelHis').DataTable({
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
            "url": 'dt_histori_covid/'+tcid,
            "type": "GET",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,2],
            "orderable": false
        }]
    });
}

function addTracking() { 
    var link = 'in_tracking_covid'; 
    $('#formAdd').submit(function (e) {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable  
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:link,
            secureuri: false,
            contentType: false,
            cache: false,
            processData:false,
            data: new FormData(this),
            dataType: "json",
            // beforeSend: function() {
            //    $('#btn-save').hide();
            //    $('#btn-save-loading').show();
            // },
            success: function (r) {
                if (r.status) {
                    $('#addModal').modal('hide');
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                        );
                    dt_tracking_covid()
                }else{
                    $('#addModal').modal('hide');
                    Swal.fire(
                        'Gagal',
                        r.msg,
                        'error'
                        );
                }
            },
            error: function () { 
                // Swal.fire(
                //     'Gagal',
                //     'Terjadi kesalahan upload',
                //     'error'
                //   );
    
                //   $('#btn-save').show();
                //   $('#btn-save-loading').hide();
             }
        });
     });
   
 }

 function upTracking() { 
    var link = 'up_tracking_covid'; 
    $('#formEditCov').submit(function (e) {
        $('#btnUbah').text('Mengubah...'); //change button text
        $('#btnUbah').attr('disabled',true); //set button disable  
        e.preventDefault();
        $.ajax({
            type: "POST",
            url:link,
            secureuri: false,
            contentType: false,
            cache: false,
            processData:false,
            data: new FormData(this),
            dataType: "json",
            // beforeSend: function() {
            //    $('#btn-save').hide();
            //    $('#btn-save-loading').show();
            // },
            success: function (r) {
                if (r.status) {
                    $('#editModal').modal('hide');
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                        );
                    dt_tracking_covid()
                }else{
                    $('#editModal').modal('hide');
                    Swal.fire(
                        'Gagal',
                        r.msg,
                        'error'
                        );
                }
            },
            error: function () { 
                // Swal.fire(
                //     'Gagal',
                //     'Terjadi kesalahan upload',
                //     'error'
                //   );
    
                //   $('#btn-save').show();
                //   $('#btn-save-loading').hide();
             }
        });
     });
   
 }

 function del_cov(id)
 {
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {         
            var link = 'set_nonaktif/'+id; 
            $.ajax({
                type: "POST",
                url: link,
                data : $(this).serialize(),
                dataType: "json",
                success: function (r) {
                    if (r.status) {
                        Swal.fire(
                            'Berhasil',
                            r.msg,
                            'success'
                        );
                        dt_tracking_covid();
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
      })
 }

function add_modal()
{
    $('#formAdd')[0].reset(); // reset form on modals
    $('#addModal').modal('show'); // show bootstrap modal

    $('#btnSave').text('Simpan'); //change button text
    $('#btnSave').attr('disabled',false); //set button disable 
}

function edit_modal(id)
{
    $('#formEditCov')[0].reset(); // reset form on modals
    $('#editModal').modal('show'); // show bootstrap modal

    $('#id').val(id);
    $.ajax({
        type: "GET",
        url: "../hcm/getTrackCov/"+id,
        dataType: "json",
        success: function (data) {
            $('#nkaryawan').html(data.nama.nama);
            $('[name="karyawan_id"]').val(data.nama.idk);
            $('#jkaryawan').html(data.nama.nma_jabatan);
        }
    });

    $('#btnUbah').text('Ubah'); //change button text
    $('#btnUbah').attr('disabled',false); //set button disable 
}
function detail_modal(id)
{
    $('#detailModal').modal('show'); // show bootstrap modal
    $.ajax({
        type: "GET",
        url: "../hcm/getTrackCov/"+id,
        dataType: "json",
        success: function (data) {
            $('#nama').html(data.nama.nama);
            $('#nma_jabatan').html(data.nama.nma_jabatan);
            $('#act_ming_kang').html(data.nama.act_ming_kang);
            $('#act_luar_kntr').html(data.nama.act_luar_kntr);
            dt_histori_covid(id);
        }
    });
}

function getKaryawan() { 
    $('#karyawan').val('');
    $.ajax({
        type: "GET",
        url: "../hcm/getKaryawan",
        dataType: "json",
        success: function (r) {
            r.nama.forEach(v => {
            $('#karyawan').append('<option value="'+v.idk+'" >'+v.nama+'</option>');
            });
        }
    });
  }

$(document).on('change','#karyawan', function(){
    id = $('#karyawan').val()
    $.ajax({
        type: "GET",
        url: "../hcm/getKaryawan/"+ id,
        dataType: "json",
        success: function (r) {
            $('#jabatan').attr('placeholder',r.nama.nma_jabatan)
        }
    });
})