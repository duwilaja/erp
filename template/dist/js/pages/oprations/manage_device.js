$(document).ready(function() {
    get_device();
});

$('#form_manage_device').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../SCM/up_manage_device",
        data: $(this).serialize(),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
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

function select_action(v){
    $('#rsl').html('');
    if (v == 'replace') {
       $('#rsl').html(`
       <div class="nma">Select New Device to replace Old Device</div>
       <select class="form-control form-control-sm" id="device_new" name="device_new" onchange="select_sn(this.value)">
        ${get_device_by_allo()}
       </select>
       `);
    }else if(v == 'rma'){
        $('#rsl').html(`
            <div class="nma">Select action for device</div>
            <select class="form-control form-control-sm" id="action" name="action">
                <option value="">-- Select RMA --</option>
                <option value="diperbaiki">Diperbaiki</option>
                <option value="ganti_baru">Ganti Baru</option>
            </select>
        `);
    }
}

function get_device_by_allo() { 
    $('#device_new').html('');
    $.ajax({
        type: "get",
        url:'../SCM/get_device_by_allo/operation',
        dataType: "json",
        success: function (res) {
            res.forEach(r => {
                $('#device_new').append('<option value="'+r.id+'">'+r.model +' (SN#'+ r.sn+')</option>');
            });
            $('#device_new').select2();
        }
    });
}

function get_device() { 
    $.ajax({
        type: "get",
        url:'../SCM/get_device/'+$('#device_id').val(),
        dataType: "json",
        success: function (r) {
            $('#tdevice').text(r.model);
            $('#tsn').text(r.sn);
            $('#sn_old').val(r.sn);
            $('#tisn').text('SN#'+r.sn);
            $('#status').val(r.status);
            $('#pk_id').val(r.project);
            $('#ket').val(r.ket);
        }
    });
}

function select_sn(sn) { 
    $('#sn_new').val(sn);
 }
