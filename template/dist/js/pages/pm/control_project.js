let btroub = $('#btroub');
let projek = [];
let service = [];

$(document).ready(function () {
  dt_projek_trouble();
  addFormTrouble();
  addKendala();
});

function dt_projek_trouble() {
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
          "url": 'dt_projek_trouble',
          "type": "POST",
      },
      //Set column definition initialisation properties
      "columnDefs": [{
          "targets": [0,2],
          "orderable": false
      }]
  });
}

window.hapus = function(id='') { 
  if (id != '') {
      $(id).remove();
  }
}

function add_modal()
{
    $('#formTrouble')[0].reset(); // reset form on modals
    $('#t').remove();
    $('#exampleModal').modal('show'); // show bootstrap modal

    $('#btnSave').text('Simpan'); //change button text
    $('#btnSave').attr('disabled',false); //set button disable 
}

function addFormTrouble() { 
  let no = 0;
  $('#add').click(function (e) {
      
      let n = no++;
        let lastRow = btroub.find("tr").length;
        let idlast = lastRow -1;
        let emptyrows = 0;
        for (i=idlast; i<lastRow; i++) {
            if ($("#projek"+n).val() == '' || $("#kendala"+i).val() == '' ) {
            emptyrows += 1;
            }
        }
        if (emptyrows == 0 ) {
      btroub.append(`<tr class="${'t'+n}" id="t">
      <td>
          <select class="form-control" name="projek[]" id="projek${n}" multiple style="width : 168px;" required>
          </select>
      </td>
      <td>
          <textarea class="form-control" cols="30" rows="5" name="kendala[]" id="kendala${lastRow}" required></textarea>
      </td>
      <td class="text-center"><button type="button" id="del" class="btn btn-sm btn-danger" onclick="hapus('${'.t'+n}')"><i class="fa fa-trash"></i></button></td>
      </tr>
      `);

      setTimeout(() => {
        $.ajax({
            type: "GET",
            url: "../pm/getProjekService",
            dataType: "json",
            success: function (r) {
                r.service.forEach(v => {
                $('#projek'+n).append('<option value="'+v.idp+'" >'+v.service+'</option>');
                });
            }
        });
        setTimeout(() => {
            $('#projek'+n).select2();
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

function addKendala() { 
    var link = 'addKendala'; 
    $('#formTrouble').submit(function (e) { 
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
                    $('#exampleModal').modal('hide');
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                      );
                      dt_projek_trouble();
                }else{
                    $('#exampleModal').modal('hide');
                    Swal.fire(
                        'Gagal',
                        r.msg,
                        'error'
                      );
                }
                
            }
        });
     });
   
 }

  function cekSelected(id,arr) { 
    if (arr.indexOf(id) != -1) return 'selected';
 }