$(document).ready(function () {
    dtKontrak();
});


$('#formPembaharuan').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "addKontrak",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
                document.getElementById("formPembaharuan").reset();
                $('#addRenewal').modal('hide');
                dtKontrak();
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

$('#formEditPembaharuan').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "upKontrak",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
                document.getElementById("formEditPembaharuan").reset();
                // $('#addRenewal').modal().hide();
                $('#editRenewal').modal('hide');
                dtKontrak();
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

function getKontrak(id) { 
    document.getElementById("formEditPembaharuan").reset();
    var http = httpGet('getProjekKontrak?id_pk='+id).data[0];
    $('input[name="id_e"]').val(id);
    $('input[name="no_kontrak_e"]').val(http.no_kontrak);
    $('select[name="jenis_e"]').val(http.jenis);
    $('input[name="masa_kontrak_e"]').val(http.masa_kontrak);
    $('input[name="nominal_e"]').val(http.tt);
    $('input[name="start_date_e"]').val(http.sd);
    $('input[name="end_date_e"]').val(http.ed);
}

function delKontrak(id) { 
    var r = confirm("Apakah anda yakin ingin menghapus data ini ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "POST",
            url: 'delKontrak',
            data : {'id' : id},
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                dtKontrak();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }

}

function dtKontrak() {
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
            "url": 'dtProjekKontrak',
            "type": "POST",
            'data' : {
                'id' : $('#id').val(),
            }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function(e) {
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  var ok = this.value.replace(/[^0-9\.]+/g, '');
  var nominal = ok.replaceAll('.','');
  $('#nominal').val(nominal);
  rupiah.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}