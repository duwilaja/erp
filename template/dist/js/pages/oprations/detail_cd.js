$(document).ready(function () {
    show_cd();
    get_projek();
});

$('#form_import').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../import_cd",
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
                show_cd();
                $('#form_import')[0].reset();
                $('#modal_import_device').modal('hide');
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


function get_projek() { 
    $.get("../../Project/get_projek/"+$('#id').val(),
        function (data, textStatus, jqXHR) {
            $('#custend').text(data.custend);
            $('#service').text(data.service);
        },
        "json"
    );
}

 function show_cd() {
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
            "url": '../dt_cust_device',
            "type": "POST",
            "data" : {
                'id' : $('#id').val()
            }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}