
$(document).ready(function() {
    showtable();
} );

$('#uploadSlipExcel').change(function (e) { 
  var formElement = document.querySelector("#importSlip");
  var formData = new FormData(formElement);

  $('#radio-mix').html('');
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: 'uploadSlipExcel',
    data: formData,
    contentType: false,
    cache: false,
    processData:false,
    dataType: "json",
    success: function (r) {
      if (r.status) {
         $('input[name="file"]').val(r.data.file);
         var s = r.data.sheets;
         $.each(s, function (i, v) { 
            $('#radio-mix').append(`<div class="inp-radio mr-2"><input type="radio" name="sheet" value="${v.sheet}"> ${v.sheet} </div>`);
         });

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

$('#importSlip').submit(function (e) { 
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: 'importSlip',
    data: $(this).serialize(),
    dataType: "json",
    beforeSend: function() {
      $('button[type="submit"]').attr('disabled','true');
    },
    success: function (r) {
      if (r.status) {
        Swal.fire(
          'Sukses',
          r.msg,
          'success'
        );
        showtable();
        $('input[name="tanggal"]').val('');
        $('button[type="submit"]').removeAttr('disabled');
        $('#uploadSlipExcel').val('');
        $('#radio-mix').html('<span style="font-size: 13px;"> Tidak ada sheet yang dipiih</span>');
      }else{
        Swal.fire(
          'Gagal',
          r.msg,
          'error'
        );
        $('button[type="submit"]').removeAttr('disabled');
      }
    }
  });
});



function showtable() {
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
          "url": 'dt_gj_karyawan_all',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }