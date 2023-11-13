$(document).ready(function() {
    showtableDetailProjekPo()
    addDatekList()
    upDatekList()
});

function GetURLParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) 
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }

    let pk = GetURLParameter('pk');

function showtableDetailProjekPo(pk_id=pk) {
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
            "url": url+'SelMa/dtDetailProjekPo/'+pk_id,
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,4,5,8,9],
            "orderable": false
        }]
    });
}

function modal_excel() {
    $('#form_excel')[0].reset(); // reset form on modals
    $('#modal_excel').modal('show'); // show bootstrap modal

    $('#btnImport').text('Import'); //change button text
    $('#btnImport').attr('disabled',false); //set button disable 

}

$('#form_excel').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "./import_datek",
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
                $('#form_excel')[0].reset();
                $('#modal_excel').modal('hide');
                showtableDetailProjekPo();
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

function modal_add() {
    $('#addDatekList')[0].reset(); // reset form on modals
    $('#modal_add').modal('show'); // show bootstrap modal

    $('#btnSave').text('Simpan'); //change button text
    $('#btnSave').attr('disabled',false); //set button disable 

}

function modal_edit(id)
{
    $('#editDatekList')[0].reset(); // reset form on modals
    $('#modal_edit').modal('show'); // show bootstrap modal

    $('#id_dtk_list').val(id);
    $.ajax({
        type: "GET",
        url: "./getDtkList/"+id,
        dataType: "json",
        success: function (v) {
            $('#layanan').val(v.data.layanan);
            $('#lokasi').val(v.data.lokasi);
            $('#provinsi').val(v.data.provinsi);
            $('#alamat').html(v.data.alamat);
            $('#sid').val(v.data.sid);
            $('#status').val(v.data.status);
            $('#masa_layanan').val(v.data.masa_layanan);
        }
    });

    $('#btnUbah').text('Ubah'); //change button text
    $('#btnUbah').attr('disabled',false); //set button disable 
}

function addDatekList() { 
    var link = './addDatekList'; 
    $('#addDatekList').submit(function (e) { 
         $('#btnSave').text('Menyimpan...'); //change button text
         $('#btnSave').attr('disabled',true); //set button disable 
         e.preventDefault();
         $.ajax({
            type: "POST",
            url: link,
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    $('#modal_add').modal('hide');
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                      );
                      showtableDetailProjekPo();
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
   
 }

 function upDatekList() { 
    var link = 'editDtkList'; 
    $('#editDatekList').submit(function (e) {
        $('#btnUbah').text('Mengubah...'); //change button text
        $('#btnUbah').attr('disabled',true); //set button disable  
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: link,
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    $('#modal_edit').modal('hide');
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                        );
                    showtableDetailProjekPo()
                }else{
                    Swal.fire(
                        'Gagal',
                        r.msg,
                        'error'
                        );
                }
            },
            error: function () { 
                Swal.fire(
                    'Gagal',
                    'Terjadi kesalahan',
                    'error'
                  );
             }
        });
     });
   
 }