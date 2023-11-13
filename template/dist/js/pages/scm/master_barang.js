$(document).ready(function() {
    dtMasterData();
    add();
    up();
});

function modal_add() {
    $('#form_add')[0].reset(); // reset form on modals
    $('#add').modal('show'); // show bootstrap modal

    $('#btnSave').text('Simpan'); //change button text
    $('#btnSave').attr('disabled',false); //set button disable 
}

function add() { 
    var link = 'addMasterBarangInv'; 
    $('#form_add').submit(function (e) { 
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
                    $('#add').modal('hide');
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                      );
                      dtMasterData();
                }else{
                    $('#add').modal('hide');
                    Swal.fire(
                        'Gagal',
                        r.msg,
                        'error'
                      );
                    dtMasterData();
                }
                
            }
        });
     });
   
 }

 function modal_edit(id)
{
    $('#form_edit')[0].reset(); // reset form on modals
    $('#edit').modal('show'); // show bootstrap modal

    $('#id').val(id);
    $.ajax({
        type: "GET",
        url: "getMasterBarang?id="+id,
        dataType: "json",
        success: function (v) {
            $('#namaBarang').val(v.nama_barang);
        }
    });

    $('#btnUbah').text('Edit'); //change button text
    $('#btnUbah').attr('disabled',false); //set button disable 
}

function up() { 
    $('#form_edit').submit(function (e) { 
        $('#btnUbah').text('Editing...'); //change button text
        $('#btnUbah').attr('disabled',true); //set button disable 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "upMasterBarangInv",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    $('#edit').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtMasterData();
                }else{
                    $('#edit').modal('hide');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: r.msg,
                    })
                }
            }
        }); 
    });
}

 function del(id)
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
            var link = 'delMasterBarangInv?id='+id; 
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
                        dtMasterData();
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

function dtMasterData() {
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
            "url": 'dt_master_barang_inv',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,3],
            "orderable": false
        }]
    });
  }