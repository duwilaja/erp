var spsb = $('select[name="psb[]"]');
var sdismantle = $('select[name="dismantle[]"]');

var psb = [];

var dismantle = [];

var x = 1;

$(document).ready(function () {
    addTimeline();
    getPD();
});

function getPD() { 
    $('select[name="psb[]"]').html('');
    $('select[name="dismantle[]"]').html('');

    var project_id = $('input[name="pk_id"]').val();
    $.get("../scm/getDeviceByProjek?projek_id="+project_id,
      function (data, textStatus, jqXHR) {
        data.forEach(v => {
          $('select[name="psb[]"]').append('<option value="'+v.id+'">'+v.model+'</option>');
        });
        
        data.forEach(v => {
          $('select[name="dismantle[]"]').append('<option value="'+v.id+'">'+v.model+'</option>');
        });
      },
      "json"
    );
  }

function add(){
    $('#okrek').append(`<tr id="ts${x}">
        <td>
        <input type="text" style="width:200px;" name="pekerjaan[]" class="form-control form-control-sm">
        </td>
        <td>
        <input type="date" style="width:200px;" name="start_date[]" class="form-control form-control-sm">
        </td>
        <td>
        <input type="date" style="width:200px;" name="end_date[]" class="form-control form-control-sm">
        </td>
        <td>
        <input type="text" style="width:200px;" name="ket[]" class="form-control form-control-sm">
        </td>
        ${resTd()}
        <td><button class="btn btn-danger" onclick="del(${x})"><i class="fa fa-trash"></i></button></td>
        </tr>`); 
    x++;
}

function del(x){
    if(x != ''){
        $('#ts'+x).remove();
        x--;
    }
}

function resTd() { 
    var html = '';
    psb.forEach(v => {
        html += `<td>
        <input type="number" placeholder="${v.nama}" style="width:70px;" name="${'xpsb'}[][${v.id}]" class="form-control form-control-sm">
        </td>`;
    });

    dismantle.forEach(v => {
        html += `<td>
        <input type="number" placeholder="${v.nama}" style="width:70px;" name="${'xdismantle'}[][${v.id}]" class="form-control form-control-sm">
        </td>`;
    });

    return html;
}

$(spsb).change(function (e) { 
    e.preventDefault();
    psb = [];
    $('#spsb option:selected').map(function() {
        var id = $(this).val();
        var txt = $(this).text();
        psb.push({id : id, nama : txt });
        cpsb();
    }).get();
});

$(sdismantle).change(function (e) { 
    e.preventDefault();
    dismantle = [];
    $('#sdismantle option:selected').map(function() {
        var id = $(this).val();
        var txt = $(this).text();
        dismantle.push({id : id, nama : txt });
        cdismantle();
    }).get();
});

function cpsb() { 
    $('#tpsb').attr('colspan', psb.length);
}

function cdismantle() { 
    $('#tdismantle').attr('colspan', dismantle.length);
}

// Tambah timeline
function addTimeline() {
    $('#formAddTimeline').submit(function (e) { 
      e.preventDefault();
      
      $.ajax({
        type: "POST",
        url: "inTimeline",
        data: $(this).serialize(),
        dataType: "json",
        success: function (r) {
          if (r.status) {
            Swal.fire(
                'Berhasil',
                r.msg,
                'success'
              );
            showtable();
            $('#addtaskModal').modal('hide');
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
  }