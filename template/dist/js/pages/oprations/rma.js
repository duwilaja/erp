$(document).ready(function () {
    showtable();
    edit_out_page();
});

function edit_out_page() {
    let e = $('#edit').val();
    let d = $('#device_idx').val();
    if(e == 'true'){
        $('#editModal').modal('show');
        get_rma_device('',d);
    }
}

$('#form_edit_rma_device').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../SCM/up_rma_device",
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
                $('#form_edit_rma_device')[0].reset();
                $('#editModal').modal('hide');
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

function get_rma_device(id='',device_id='') { 
    $.ajax({
        type: "get",
        url:'../SCM/get_device_rma/'+device_id,
        dataType: "json",
        success: function (res) {
            $('#id').val(id);
            $('#device_id').val(device_id);
            $('#status').val(res.status);
            $('#ket').val(res.ket);
            $('#txt_device').text(res.model);
            $('#txt_sn').text(res.sn);
            $('#txt_sn').text(res.sn);
        }
    });
}


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
            "url": '../SCM/dt_device_rma',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            // "targets": [0],
            "orderable": false
        }]
    });
}