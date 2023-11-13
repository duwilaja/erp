let btroub = $('#btroub');
let projek = [];
let service = [];

$(document).ready(function() {
    addForm();
    dtInventory();
    add();
});

function modal_add() {
    $('#form_add')[0].reset(); // reset form on modals
    btroub.html('');
    $('#add').modal('show'); // show bootstrap modal

    $('#btnSave').text('Simpan'); //change button text
    $('#btnSave').attr('disabled',false); //set button disable 
}

window.hapus = function(id='') { 
    if (id != '') {
        $(id).remove();
    }
  }

function addForm() {
    let no = 0;
  $('#addForm').click(function (e) {
      
      let n = no++;
        let lastRow = btroub.find("tr").length;
        let idlast = lastRow -1;
        let emptyrows = 0;
        for (i=idlast; i<lastRow; i++) {
            if ($("#nama_barang"+n).val() == '' || $("#catatan"+i).val() == '' ) {
            emptyrows += 1;
            }
        }
        if (emptyrows == 0 ) {
      btroub.append(`<tr class="${'t'+n}" id="t">
      <td>
          <select class="form-control" name="nama_barang[]" id="nama_barang${n}" style="width : 168px;" required>
          </select>
      </td>
      <td>
          <textarea class="form-control" cols="30" rows="5" name="catatan[]" id="catatan${lastRow}" required></textarea>
      </td>
      <td class="text-center"><button type="button" id="del" class="btn btn-sm btn-danger" onclick="hapus('${'.t'+n}')"><i class="fa fa-trash"></i></button></td>
      </tr>
      `);

      setTimeout(() => {
        $.ajax({
            type: "GET",
            url: "getMasterBarang",
            dataType: "json",
            success: function (r) {
                r.forEach(v => {
                $('#nama_barang'+n).append('<option value="'+v.id+'" >'+v.nama_barang+'</option>');
                });
            }
        });
        setTimeout(() => {
            $('#nama_barang'+n).select2({
                dropdownParent: $('#add')
            });
        }, 100);
    }, 300);
        } else  {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris'
              })
        }
      
  });
}

function add() { 
    var link = 'addReqInv'; 
    $('#form_add').submit(function (e) { 
         $('#btnSave').text('Menyimpan...'); //change button text
         $('#btnSave').attr('disabled',true); //set button disable 
         e.preventDefault();
         $.ajax({
            type: "POST",
            url: link,
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    $('#add').modal('hide');
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                      );
                      dtInventory();
                }else{
                    $('#add').modal('hide');
                    Swal.fire(
                        'Gagal',
                        r.msg,
                        'error'
                      );
                    dtInventory();
                }
                
            }
        });
     });
   
 }

function dtInventory() {
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
            "url": 'dt_inventoryu',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,3],
            "orderable": false
        }]
    });
  }