$(document).ready(function() {
    editKaryawan();
});

function editKaryawan() { 
    $('#formEditProfile').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'karyawan/upProfile/',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });

            }
        });
    });
 }