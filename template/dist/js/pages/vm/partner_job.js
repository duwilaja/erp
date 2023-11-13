$(document).ready(function() {
    dtPartnerJob();

    addPartnerJob();
    upPartnerJob();
});

function dtPartnerJob() {
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
          "url": 'dtPartnerJob',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,2],
          "orderable": false
        }]
      });
}

function getEdit(id) { 
    $.ajax({
        type: "get",
        url: "get_partnerJob?id="+id,
        dataType: "json",
        success: function (v) {
            $('input[name="id"]').val(v.id);
            $('input[name="jobs"]').val(v.jobs);
        }
    });
}

function addPartnerJob() { 
    $('#addPartnerJob').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "inPartnerJob",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtPartnerJob();
                    document.getElementById("addPartnerJob").reset();
                    $('#formAddPartnerJob').modal('hide');
                }else{
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

function upPartnerJob() { 
    $('#editPartnerJob').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "upPartnerJob",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtPartnerJob();
                    $('#formEditPartnerJob').modal('hide');
                }else{
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

function delPartnerJob(id){
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
            var link = 'setNPartnerJob'; 
            $.ajax({
                type: "POST",
                url: link,
                data: {
                    'id' : id,
                },
                dataType: "json",
                success: function (r) {
                    if (r.status) {
                        Swal.fire(
                            'Berhasil',
                            r.msg,
                            'success'
                        );
                        dtPartnerJob();
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