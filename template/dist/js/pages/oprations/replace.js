$(document).ready(function () {
    showtable();
    getCust();
    edit_out_page();
});

function edit_out_page() {
    let e = $('#edit').val();
    let c = $('#cust').val();
    let d = $('#device_id').val();
    if(e == 'true'){
        $('#addModal').modal('show');
        getCust(c);
        cek_device_by_cust(c,'',d);
    }
}

$('#form_replace_device').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../SCM/in_replace_device",
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
                $('#form_replace_device')[0].reset();
                $('#addModal').modal('hide');
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

function getCust(id='',name='') { 
    if(name == '') name = 'custend';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'../customers/getEndCustomer/',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Pilih Customer --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.custend+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.custend+"</option>");
                }
            });

            $('select[name="'+name+'"]').select2({
                dropdownParent: $("#addModal"),
            });
        }
    });
}

function cek_device_by_cust(id='',name='',device_id='') { 
    if(name == '') name = 'device_old';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'../SCM/cek_device_by_cust/'+id,
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Select Old Device/SN --</option>');
            $.each( res, function( key, value ) {
                if (value.id == device_id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.model+" (SN#"+value.sn+")</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.model+" (SN#"+value.sn+")</option>");
                }
            });

            $('select[name="'+name+'"]').select2({
                dropdownParent: $("#addModal"),
            });
        }
    });
    get_device_by_allo_baik();
}

function get_device_by_allo_baik() { 
    if(name == '') name = 'device_new';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'../SCM/get_device_by_allo_baik/operation',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Select New Device/SN --</option>');
            $.each( res, function( key, value ) {
                $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.model+" (SN#"+value.sn+")</option>");
            });

            $('select[name="'+name+'"]').select2({
                dropdownParent: $("#addModal"),
            });
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
            "url": '../SCM/dt_device_replace',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            // "targets": [0],
            "orderable": false
        }]
    });
}