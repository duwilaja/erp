var no = 1;
$(document).ready(function() {
    dt_node();
    create_node();
    update_node();
    getCost('','cust');
    $('select[name="cust"]').select2({
        dropdownParent: $("#modal_add_node")
    });
    $('select[name="layanan"]').select2({
        dropdownParent: $("#modal_add_node")
    });
});

// Layanan 

function getCustLayanan(id='',name='') { 
    if(name == '') name = 'layanan';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'./getLayananJson?cust_end='+id,
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">All Layanan</option>');
                $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }
            });
        }
    });
}

function getCusTicLayanan(id='',id_cust='',name='') { 
    if(name == '') name = 'layanan';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'./getTicLayananJson?cust_end='+id_cust,
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">All Layanan</option>');
                $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.layanan+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }
            });
        }
    });
}

function getCusTicLayanan_id(id='',id_cust='',name='') { 
    if(name == '') name = 'layanan';
    $(name).html('');
    $.ajax({
        type: "get",
        url:'./getTicLayananJson?cust_end='+id_cust,
        dataType: "json",
        success: function (res) {
            $(name).html('<option value="">All Layanan</option>');
                $.each( res, function( key, value ) {
                if (value.id == id) {
                    $(name).append("<option selected value='"+value.id+"'>"+value.layanan+"</option>");
                }else{
                    $(name).append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }
            });
        }
    });
}

function dt_node() {
    $('#tabel_node').DataTable({
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
            "url": './dt_node',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,3],
            "orderable": false
        }]
    });
}

function add() { 
    var n = no++;
    $('#tbody_node').append(`<tr id="n${n}"><td>
      <select name="cust_id[]" id="cust${n}" onchange="getCusTicLayanan_id('',this.value,'#layanan${n}')" class="form-control form-control-sm">
      </select>
      </td>
      <td>
      <select name="tic_layanan_id[]" id="layanan${n}" class="form-control form-control-sm">
      </select>
      </td>
      <td>
      <input type="number" class="form-control form-control-sm" name="qty[]"  placeholder="" value=""> 
      </td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="del('#n${n}')">DEL</button></td>
      </tr>`);
  
      getCost_id('','#cust'+n);
      setTimeout(() => {
          getCusTicLayanan_id('',$('#cust'+n).val(),'#layanan'+n);
      }, 300);
}

function del(id='') { 
    $(id).remove();
 }

 $('#btn-down-node').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "down_sample_node",
        data: $('#upload_device').serialize(),
        dataType: "json",
        success: function (r) {
            window.location.assign(r.file);
        },
        error : function () {
            Swal.fire(
                'Gagal',
                'Terjadi gangguan sistem, harap hubungi developer, terima kasih.',
                'error'
              );
        }
    });
});

$('#form_import_node').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "import_node",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        beforeSend: function() {
           $('#btn-import').hide();
           $('#btn-import-loading').show();
        },
        success: function (r) {
            if (r.status) {
                Swal.fire(
                  'Berhasil',
                  r.msg,
                  'success'
                );

                $('#modal_import_node').modal('hide');

                $('#btn-import').show();
                $('#btn-import-loading').hide();
                dt_node();
            }else{
                Swal.fire(
                  'Gagal',
                  r.msg,
                  'error'
                );

                $('#btn-import').show();
                $('#btn-import-loading').hide();
            } 
        },
        error: function () { 
            Swal.fire(
                'Gagal',
                'Terjadi kesalahan upload',
                'error'
              );

              $('#btn-import').show();
              $('#btn-import-loading').hide();
         }
    });
});

function get_edit_node(id) {
    var c = httpGet('./get_node?id='+id);
    getCusTicLayanan(c.tic_layanan_id,c.cust_id,'e_layanan');
    getCost(c.cust_id,'e_cust');
    $('select[name="e_cust"]').select2({
        dropdownParent: $("#modal_edit_node")
    });

    $('input[name="e_id"]').val(c.id);
    $('input[name="e_node"]').val(c.node);
}

function create_node() { 
    $('#form_add_node').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./in_node',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    dt_node();
                    $('#form_add_node')[0].reset();
                    toastr.success(res.msg+' '+$('input[name="node"]').val());
                    $("#modal_add_node").modal('hide');
                }else{
                    toastr.error(res.msg+' '+$('input[name="node"]').val());
                    $("#modal_add_node").modal('hide');
                }
            }
        });
    });
}

function update_node() { 
    $('#form_edit_node').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./up_node',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    dt_node();
                    toastr.success(res.msg);
                    $("#modal_edit_node").modal('hide');
                }else{
                    toastr.error(res.msg);
                    $("#modal_edit_node").modal('hide');
                }
            }
        });
    });
}

function del_node(id) { 
    var val = 0;
    var r = confirm("Apakah anda yakin ingin menghapus data !");
    if (r == true) {
        txt = "You pressed OK!";
        val = 1;
        $.ajax({
            type: "POST",
            url: "./de_node/",
            data : {'id' : id},
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                dt_node();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
 }

 function getCost(id='',name='') { 
    if(name == '') name = 'customer';
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
        }
    });
}

function getCost_id(id='',name='') { 
    if(name == '') name = 'customer';
    $(name).html('');
    $.ajax({
        type: "get",
        url:'../customers/getEndCustomer/',
        dataType: "json",
        success: function (res) {
            $(name).html('<option value="">-- Pilih Customer --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $(name).append("<option selected value='"+value.id+"'>"+value.custend+"</option>");
                }else{
                    $(name).append("<option value='"+value.id+"'>"+value.custend+"</option>");
                }
            });
        }
    });
}



