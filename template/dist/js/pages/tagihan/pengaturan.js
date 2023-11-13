$(document).ready(function () {
    $('#email').select2({
        tags:true, 
    });
    getNotif();
});

$('#formNotif').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "upNotifikasi",
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

function getNotif() { 
    $('#email').html();
    $.ajax({
        type: "GET",
        url: "seNotifikasi",
        dataType: "json",
        success: function (r) {
            if (r.status) {
               var email = r.data.email;
               var pesan = r.data.pesan;
               
               email.forEach(e => {
                   $('#email').append('<option value="'+e+'" selected>'+e+'</option>');
               });

               $('#pesan').val(pesan);
            }
        }
    });
 }