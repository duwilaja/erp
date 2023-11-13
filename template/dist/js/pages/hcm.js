var id = $('#idt').val();

$(document).ready(function() {
    showtable();
    showMytable();
    get_form_pengajuan();
});


function get_form_pengajuan() { 
  if (id != '') {
    console.log(id);
    var x = atob(id).split('|');
    get_pengajuan(x[0]);
    $("#modal_form_pengajuan").modal('show');
  }
}


function xfield(s) {
  if (s == 1) {
    $('#xfield').html(`<p>Catatan </p>
    <textarea class="form-control" name="alasan"></textarea>`);
  }else if(s == 2){
    $('#xfield').html(`<p>Status Pengajuan </p>
    <div id="txt_status_pengajuan"></div>`);
  }
}

function set_status_pengajuan(x) {
  if (x == 1) {
    $('#txt_status_pengajuan').html('<div class="label success">Pengajuan di Setujui</div>');
  }else if(x == 2){
    $('#txt_status_pengajuan').html('<div class="label failed">Pengajuan Tidak di Setujui</div>');
  }
}

function tolak_pengajuan() { 
  var r = confirm("Apakah anda yakin ingin menolak pengajuan ini ?");
  if (r == true) {
    $.ajax({
      type: "POST",
      url: 'tolak',
      data : $('#form_pengajuan').serialize(),
      dataType: "json",
      success: function (r) {
        
        $("#modal_form_pengajuan").modal('hide');
        $('textarea[name="alasan"]').val('');
        showtable();

        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: r.msg,
        })
        
      }
    });
  }
}


function terima_pengajuan() {
  var r = confirm("Apakah anda yakin ingin menerima pengajuan ini ?");
  if (r == true) {
    $.ajax({
      type: "POST",
      url: 'terima',
      data : $('#form_pengajuan').serialize(),
      dataType: "json",
      success: function (r) {
        
        $("#modal_form_pengajuan").modal('hide');
        $('textarea[name="alasan"]').val('');
        showtable();
        
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: r.msg,
        })
        
      }
    });
  } 
 
}

function get_pengajuan(id) { 
  $.ajax({
    type: "GET",
    url: "get_pengajuan_id",
    data: {
      'id' : id
    },
    dataType: "json",
    success: function (r) {
      $('#idt').val(r.id);
      $('#txt_nama').text(r.nama);
      $('#txt_tgl_pengajuan').val(r.tgl_pengajuan);
      $('#txt_tgl_mulai').val(r.tgl_mulai);
      $('#txt_tgl_akhir').val(r.tgl_akhir);
      $('#txt_jml_hari').val(r.lama);
      $('#txt_keterangan').val(r.alasan);
      if (r.status_pengajuan == '0') {
        $('#xbtn').html(`<input type="button" class="btn btn-primary" name="btn_tolak" value="Tolak" onclick="tolak_pengajuan()">
        <input type="button" name="btn_terima" type="submit" class="btn btn-success" onclick="terima_pengajuan()" value="Terima">`);
        xfield(1);
      }else{
        xfield(2);
      }
      set_status_pengajuan(r.status_pengajuan);
    }
  });
}

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
          "url": url+'hcm/dt',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }

  function showMytable() {
    $('#mytabel').DataTable({
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
          "url": url+'hcm/dtMY',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }

  function tolak(id) { 
      $('input[name="idt"]').val(id); 
  }