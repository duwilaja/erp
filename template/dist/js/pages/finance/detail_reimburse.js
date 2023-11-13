function terima_pengajuan() { 
    var fri = $('#fnc_r_id').val();
    var r = confirm("Apakah anda ingin menerima pengajuan ini ?");
    if (r) {
        $.ajax({
            type: "POST",
            url: "../terima_reimburse",
            data: {
                'fnc_r_id' : fri,
                'catatan' : ''
            },
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                    ); 
                }
            }
        });
    }
}

function tolak_pengajuan() { 
    var fri = $('#fnc_r_id').val();
    var r = confirm("Apakah anda ingin menolak pengajuan ini ?");
    if (r) {
        $.ajax({
            type: "POST",
            url: "../tolak_reimburse",
            data: {
                'fnc_r_id' : fri,
                'catatan' : ''
            },
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                    ); 
                }
            }
        });
    }

}