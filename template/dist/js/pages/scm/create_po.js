no = 1;
$(document).ready(function() {
    showtable();
});

function get_po(id='') { 
    $('input[name="po_id"]').val(id);
}

$('#form_create_po').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "in_po",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        beforeSend: function() {
           $('#btn-save').hide();
           $('#btn-save-loading').show();
        },
        success: function (r) {
            if (r.status) {
                Swal.fire(
                  'Berhasil',
                  r.msg,
                  'success'
                );
                $('#modal_create_po').modal('hide');

                $('#btn-save').show();
                $('#btn-save-loading').hide();
                $('#list_vendor').html('');
                showtable();
            }else{
                Swal.fire(
                  'Gagal',
                  r.msg,
                  'error'
                );

                $('#btn-save').show();
                $('#btn-save-loading').hide();
            } 
        },
        error: function () { 
            Swal.fire(
                'Gagal',
                'Terjadi kesalahan upload',
                'error'
              );

              $('#btn-save').show();
              $('#btn-save-loading').hide();
         }
    });
});

$('#btn-import').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "import_device",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData($('#form_device')[0]),
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
                $('#detail_device').modal('hide');
                $('#form_device')[0].reset();
                $('#btn-import').show();
                $('#btn-import-loading').hide();
                $('#list-device').html('');
                showtable();
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

function add() { 
    var n = no++;
    $('#list_vendor').append(`<tr id="lv_${n}">
        <td><input type="text" name="no_po[]" id="no_po" class="form-control form-control-sm" placeholder="No PO"></td>
        <td>
            <select  name="vendor[]" id="vendor${n}" class="form-control form-control-sm" placeholder="Vendor">
            </select>
        </td>
        <td><input type="date" name="date[]" id="date" class="form-control form-control-sm" placeholder="Date Deliverd"></td>
        <td><input type="date" name="date_received[]" id="date_received" class="form-control form-control-sm" placeholder="Date Received"></td>
        <td><input type="file" name="file_po[]" id="file_po" class="form-control form-control-sm"></td>
        <td>
            <button class="btn btn-danger btn-sm" onclick="del('#lv_${n}')">Del</button>
        </td>
        </tr>`);
    get_vendor('','#vendor'+n);
 }

 function del(id='') { 
    $(id).remove();
 }

 function add_device() { 
    var n = no++;
    $('.list-device').append(`<div class="device" id="dd${n}" style="border-bottom:1px solid #DDD;padding-bottom:10px;margin-bottom:4px;font-size:14px;">
    <div class="row">
    <div class="col-md-3">
        <div>Merek</div>
            <select name="merek[]" id="merek${n}" onchange="get_type('','#type${n}',this.value)" class="form-control form-control-sm">
            </select>
        </div>
        <div class="col-md-3">
        <div>Type</div>
            <select name="type[]" id="type${n}" class="form-control form-control-sm">
            </select>
        </div>
        <div class="col-md-3">
            <div>Price/unit</div>
            <input type="number" name="price[]" id="price" class="form-control form-control-sm" placeholder="Ex : 120000">
        </div>
        <div class="col-md-2">
            <div>Qty</div>
            <input type="number" name="qty[]" id="qty" class="form-control form-control-sm" placeholder="Ex : 1">
        </div>
        <div class="col-md-1">
            <div class='dassda' style="position:absolute;bottom:0px;">
                <button type="button" class="btn btn-danger btn-sm" onclick="del_device('#dd${n}')">Del</button>
            </div>
        </div>
        </div>
    </div>
</div>`);

get_merek('','#merek'+n);
setTimeout(() => {
    get_type('','#type'+n,$('#merek'+n).val());
}, 300);

}

 function del_device(id='') { 
    $(id).remove();
 }

function get_vendor(id='',name='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "get_vendor",
        dataType: "json",
        success: function (r) {
            r.forEach(e => {
                $(name).append(`<option value="${e.id}">${e.nama}</option>`);
            });
        }
    });
}

$('#btn-down-device').click(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "down_sample_device",
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

function get_merek(id='',name='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "get_dvc_merek",
        dataType: "json",
        success: function (r) {
            r.forEach(e => {
                $(name).append(`<option value="${e.id}">${e.merek}</option>`);
            });
        }
    });
}

function get_type(id='',name='',merek='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "get_dvc_type/"+merek,
        dataType: "json",
        success: function (r) {
            r.forEach(e => {
                $(name).append(`<option value="${e.id}">${e.type}</option>`);
            });
        }
    });
}

function showtable() {
	//console.log('list');
    $('#tabel_list_po').DataTable({
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
          "url": 'dt_po_project',
          "type": "POST",
          "data" : {
              'project' : $('input[name="project_id"]').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }
