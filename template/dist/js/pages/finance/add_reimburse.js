
var no = 1;


function pilih_p_o(x) {
    $('#p_o').html('');

    if (x == 1) {
        $('#p_o').html('<select name="pk_id" class="form-control form-control-sm"></select>');
        get_pk();
    }else if(x == 2){
        $('#p_o').html('<input type="text" name="other" class="form-control form-control-sm" placeholder="Masukan keterangan lain">');
    }
}

function get_pk() { 
    $('select[name="pk_id"]').html('');
    $.ajax({
        type: "GET",
        url: "../Project/get_projek_all",
        dataType: "json",
        success: function (data) {
            data.forEach(v => {
                $('select[name="pk_id"]').append('<option value="'+v.id+'">'+v.custend +' - '+ v.service+'</option>');
            });
        }
    });
}

function add_form_r() { 
    $('#from_r').append(`
    <tr id="d_r_${no}">
        <td><input type="date" class="form-control form-control-sm" name="tgl_klaim[]" required></td>
        <td><input type="text" class="form-control form-control-sm" name="klaim[]"></td>
        <td><input type="keterangan" class="form-control form-control-sm" name="keterangan[]"></td>
        <td><input type="file" class="form-control form-control-sm" name="struk[]"></td>
        <td><input type="text" class="form-control form-control-sm" name="total[]" required></td>
        <td><button type="button" class="btn btn-default btn-sm" onclick="del_form_r('#d_r_${no}')"><i class="fa fa-trash"></i></button></td>
    </tr>
    `);

    no++;
}

function del_form_r(id) { 
    $(id).remove();
    no--;
}

$('#form_pengajuan_reimburse').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "in_reimburse",
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

                $('#btn-save').show();
                $('#btn-save-loading').hide();

                $('#from_r').html('');
                
                setTimeout(() => {
                    var x = confirm("Reimburse berhasil diajukan, Apakah anda ingin kembali ke halaman reimburse ?");
                    if (x == true) {
                        window.location.assign(r.redi);
                    } else {
                        txt = "You pressed Cancel!";
                    }
                }, 1000);
               
  
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
                'Terjadi gangguan sistem, harap hubungi developer',
                'error'
              );
  
              $('#btn-save').show();
              $('#btn-save-loading').hide();
         }
    });
  });