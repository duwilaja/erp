$(document).ready(function() {
    showtable();
});

$('#add_form_sn').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "in_sn",
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
                $('#modal_create_sn').modal('hide');
                $('#list_sn').html('');

                $('#add_form_sn')[0].reset();
  
                $('#btn-save').show();
                $('#btn-save-loading').hide();
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

function detail_sn(id='') { 
    var no = 1;
    $('#list_sn').html('');
    $('input[name="id"]').val(id);
    $.ajax({
        type: "GET",
        url: "get_po_item_id?id="+id,
        dataType: "json",
        success: function (r) { 
            if (r.qty <= 15) {
                for (let i = 0; i < r.qty; i++) {
                    var n = no++;
                    $('#list_sn').append(`<tr id="n${n}"><td style="text-align:center;">${n}</td><td>
                        <input type="text" class="form-control form-control-sm" name="sn[]" placeholder="Masukan SN disini">
                    </td>
                    </tr>`);
                }
            }
            
        }
    });
}

function detail_list_sn(id='') { 
    var no = 1;
    $('#lists_sn').html('');
    $.ajax({
        type: "GET",
        url: "get_device_po_item_id?id="+id,
        dataType: "json",
        success: function (r) { 
            r.forEach(v => {
                var n = no++;   
                $('#lists_sn').append(`<tr>
                    <td style="text-align:center;">${n}</td>
                    <td style="text-align:center;">${v.type}</td>
                    <td>${v.sn}</td>
                </tr>`);
            }); 
        }
    });
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
          "url": 'dt_inventory_items',
          "type": "POST",
          "data" : {
              'id' : $('#poid').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }
