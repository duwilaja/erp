let no = 1;
$(document).ready(function() {
    showtable();
    get_merek('','select[name="merek"]');
});

$('#form_inventory').submit(function (e) { 
  e.preventDefault();
  $.ajax({
      type: "POST",
      url: "in_form_inventory",
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
              $('#modal_form_inventory').modal('hide');
              $('#form_inventory')[0].reset();

              $('#btn-save').show();
              $('#btn-save-loading').hide();
              $('#list_devices').html('');
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
              'Terjadi kesalahan, harap hubungi developer',
              'error'
            );

            $('#btn-save').show();
            $('#btn-save-loading').hide();
       }
  });
});

function add() { 
  var n = no++;
  $('#list_devices').append(`<tr id="n${n}"><td>
    <select name="merek_id[]" id="merek${n}" onchange="get_type('','#type${n}',this.value)" class="form-control form-control-sm">
    </select>
    </td>
    <td>
    <select name="type_id[]" id="type${n}" class="form-control form-control-sm">
    </select>
    </td>
    <td>
    <input type="number" class="form-control form-control-sm" name="qty[]"  placeholder="" value=""> 
    </td>
    <td>
    <input type="number" class="form-control form-control-sm" name="price[]"  placeholder="" value="">
    </td>
    <td><button type="button" class="btn btn-danger btn-sm" onclick="del('#n${n}')">Del</button></td>
    </tr>`);

    get_merek('','#merek'+n);
    setTimeout(() => {
        get_type('','#type'+n,$('#merek'+n).val());
    }, 300);
}

function del(id='') { 
    $(id).remove();
 }

function get_merek(id='',name='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "get_dvc_merek",
        dataType: "json",
        success: function (r) {
            $(name).html('<option value=""></option>');
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

function cetak_sn() {
    let qty = $('#qty').val();
    if (qty > 0) {
        add(qty);
        $('#tabel_sn').show();
    }else{
        $('#tabel_sn').hide();
        $('#list_sn').html('');
    }
}  

function showtable() {
	//console.log('list');
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
          "url": 'dt_inventory_invoice',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }
