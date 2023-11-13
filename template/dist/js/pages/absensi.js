
$(document).ready(function() {
    
    showtable();
    showtableBulan();
    showtableTahun();

    pilihFor('CU');

    $('#wk_mulai').timepicker();
    $('#wk_selesai').timepicker();

});

$('#filter_absen').submit(function (e) { 
  e.preventDefault();
  showtable();
});

window.pilihTanggal = function(d) { 
  showtable('',d);
}

function reset_form() { 
  $('#filter_absen')[0].reset();
  setTimeout(() => {
    showtable();
  }, 300);
}

function showtable(status='',date='') {
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
          "url": url+'absensi/dtAbsensi',
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

  function showtableBulan() {
    $('#tabelBulan').DataTable({
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
          "url": url+'absensi/dtAbsensiBulan/',
          "type": "POST",
          "data" : {
            'bulan' : $('select[name="bulan"]').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,3,4,5,6],
          "orderable": false
        }]
      });
  }

  function showtableTahun(b='') {
    $('#tabelTahun').DataTable({
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
          "url": url+'absensi/dtAbsensiTahun/'+b,
          "type": "POST",
          "data" : {
            'tahun' : $('select[name="bulan"]').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,3,4,5,6],
          "orderable": false
        }]
      });
  }

  window.pilih = function (b){
    showtableBulan();
    showtableTahun();
  }
 
  window.pilihFor = function(v) {
    var html = '';
    $('#elm').html('');
      if (v == 'L') {
        
        html += '<div class="col-sm-6"> <div class="form-group"> <label>Tanggal Mulai</label> <input type="date" class="form-control" required name="tgl_mulai"> </div> </div><div class="col-sm-6"> <div class="form-group"> <label>Tanggal Selesai</label> <input type="date" class="form-control" required name="tgl_akhir"> </div> </div><div class="col-sm-6"> <div class="form-group"> <label>Waktu Mulai</label> <input type="time" id="wk_mulai" class="form-control" required name="waktu_mulai"> </div> </div> <div class="col-sm-6"> <div class="form-group"> <label>Waktu Selesai</label> <input type="time" id="wk_selesai" class="form-control" required name="waktu_selesai"> </div> </div> <div class="col-sm-12"> <div class="form-group"> <label>Projek</label> <select class="form-control" id="pjk" required name="projek"> <option></option> </select> </div> </div>';
        
        setTimeout(() => {
          
          $('#pjk').select2({
            placeholder: 'Pilih Projek'
          });
            
        }, 300);

      }else if (v == 'CU') {
        html += '<div class="col-sm-6"> <div class="form-group"> <label>Dari Tanggal</label> <input type="date" class="form-control" min="'+twoWeekDate()+'" required name="tgl_mulai"> </div> </div> <div class="col-sm-6"> <div class="form-group"> <label>Sampai Tanggal</label> <input type="date" min="'+twoWeekDate()+'"  class="form-control" required name="tgl_akhir"> </div> </div>';
      }else if (v == 'SK') {
        html += '<div class="col-sm-12"> <div class="form-group"> <label>Upload Bukti Sakit</label> <input type="file" id="bukti" class="form-control" required name="bukti"> </div> </div>';
      }else if (v == 'PD') {
        html += '<div class="col-sm-6"> <div class="form-group"> <label>Tanggal Mulai Dinas</label> <input type="date" class="form-control" required name="tgl_mulai"> </div> </div> <div class="col-sm-6"> <div class="form-group"> <label>Tanggal Selesai Dinas</label> <input type="date" class="form-control" required name="tgl_akhir"> </div> </div><div class="col-sm-12"> <div class="form-group"> <label>Karyawan</label> <select class="form-control" id="karyawan" required name="karyawan[]" multiple> <option></option> </select> </div> </div>';
        setTimeout(() => {
          
          $('#karyawan').select2({
            placeholder: 'Pilih Karyawan',
            tags : true
          });

          getKaryawan();
            
        }, 300);
      }
    $('#elm').html(html);
  }

  function getKaryawan() {
    var karyawan = '';

    $.ajax({
      type: "POST",
      url: url+"karyawan/getKaryawanJson",
      dataType: "json",
      success: function (r) {

        r.forEach(k => {
          karyawan += '<option value="'+k.id+'">'+k.nama+'</option>';
        });

        $('#karyawan').html(karyawan);
      }
    });
  }


  function twoWeekDate() {
    let numWeeks = 2;
    let current_datetime = new Date();
    current_datetime.setDate(current_datetime.getDate() + numWeeks * 7);
    let month = (current_datetime.getMonth() + 1);
    let formatted_date = current_datetime.getFullYear() + "-" + (month.length > 1 ? month : '0'+month) + "-" + current_datetime.getDate();
    
    return formatted_date;
  }

  