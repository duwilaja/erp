$(document).ready(function () {
    dt_pilih_projek();
});

function dt_pilih_projek() {
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
            "url": 'dt_pilih_projek',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,2],
            "orderable": false
        }]
    });
}

function pilih_projek(id) {
    var link = 'pilihP/'+id; 
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
                  dt_pilih_projek();
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