$(document).ready(function () {
    dt_type();
    edit_type();
    add_type();
    get_merek('','select[name="merek"]');
});

function dt_type() {
    $('#tbl_type').DataTable({
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
            "url": 'dt_type',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,2],
            "orderable": false
        }]
    });
}

function get_edit(id='') {
    var c = httpGet('get_type_json?id='+id);
    $('input[name="e_id"]').val(c.id);
    get_merek(c.merek_id,'select[name="e_merek"]');
    $('input[name="e_type"]').val(c.type);
}

function get_merek(id='',name='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "get_merek_json",
        dataType: "json",
        success: function (r) {
            $(name).html('<option value=""></option>');
            r.forEach(e => {
                if (e.id == id) {
                    $(name).append(`<option value="${e.id}" selected >${e.merek}</option>`);
                }else{
                    $(name).append(`<option value="${e.id}">${e.merek}</option>`);
                }
            });
        }
    });
}

function add_type() { 
    $('#form_add').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: 'in_type',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    dt_type();
                    $('#form_add')[0].reset();
                    $('#model_form_add').modal('hide');
                    toastr.success(res.msg);
                }
            }
        });
    });
}

function edit_type() { 
    $('#form_edit').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'up_type',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    dt_type();
                    $('#model_form_edit').modal('hide');
                    toastr.success(res.msg);
                }
            }
        });
    });
}

function del_type(id) { 
    var r = confirm("Apakah anda yakin ingin menghapus data !");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "./de_type/",
            data : {'id' : id},
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                dt_type();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
 }