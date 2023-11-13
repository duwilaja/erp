$(document).ready(function () {
    dt_merek();
    edit_merek();
    add_merek();
    get_solution();
});

function dt_merek() {
    $('#tbl_merek').DataTable({
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
            "url": 'dt_merek',
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
    var c = httpGet('get_merek_json?id='+id);
    $('input[name="e_id"]').val(c.id);
    $('input[name="e_merek"]').val(c.merek);
    get_solution(c.solution_id,'e_solution');
}

function get_solution(id='',name='') { 
    if(name == '') name = 'solution';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'../SelMa/getSolution',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Select --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.solution+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.solution+"</option>");
                }
            });
        }
    });
}

function add_merek() { 
    $('#form_add').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: 'in_merek',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    dt_merek();
                    $('#form_add')[0].reset();
                    $('#model_form_add').modal('hide');
                    toastr.success(res.msg);
                }
            }
        });
    });
}

function edit_merek() { 
    $('#form_edit').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'up_merek',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    dt_merek();
                    $('#model_form_edit').modal('hide');
                    toastr.success(res.msg);
                }
            }
        });
    });
}

function del_merek(id) { 
    var r = confirm("Apakah anda yakin ingin menghapus data !");
    if (r == true) {
        $.ajax({
            type: "POST",
            url: "./de_merek/",
            data : {'id' : id},
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                dt_merek();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
 }