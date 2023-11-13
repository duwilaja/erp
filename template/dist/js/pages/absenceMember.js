$(document).ready(function() {
    showtable();
});

window.lihatDt = function() { 
  var status = $('#status').val();
  var karyawan = $('#karyawan').val();
  var date = $('#tgl').val();
  showtable(status,karyawan,date);
 }

 window.pilihTanggal = function(v) { 
  showtable('','',v);
 }

 $('#filter_absen').submit(function (e) { 
  e.preventDefault();
  showtable();
});

 function reset_form() { 
  $('#filter_absen')[0].reset();
  setTimeout(() => {
    showtable();
  }, 300);
}

function showtable(status='',karyawan='',d='') {
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
          "url": 'dtAbsenLeader',
          "type": "POST",
          "data" : {
            's' : $('#status').val(),
            'k': $('#karyawan').val(),
            'd' : $('#tgl').val(),
            'tgl_mulai' : $('input[name="tgl_mulai"]').val(),
            'tgl_akhir' : $('input[name="tgl_akhir"]').val(),
         } 
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }
