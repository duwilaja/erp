let no = 1;
$(document).ready(function() {
    showtable();
});

$('#form_asset').submit(function (e) { 
  e.preventDefault();
  $.ajax({
      type: "POST",
      url: "in_dvc_inv",
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
              $('#modal_create_asset').modal('hide');

              $('#btn-save').show();
              $('#btn-save-loading').hide();
              $('#list_assets').html('');
              showtable();
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
              'Terjadi kesalahan, harap hubungi developer',
              'error'
            );

            $('#btn-save').show();
            $('#btn-save-loading').hide();
       }
  });
});

function add() { 
  var n = no++;
  $('#list_assets').append(`<tr id="la${n}">
  <td>
    <select name="category[]" id="category" class="form-control form-control-sm" placeholder="category">
      <option value="1">Property</option>
      <option value="2">Electronic</option>
      <option value="3">Project</option>
    </select>
  </td>
  <td><input type="text" name="sn[]" id="sn" class="form-control form-control-sm" placeholder="SN" required></td>
  <td>
      <select name="status[]" id="status" class="form-control form-control-sm" placeholder="Condition">
          <option value="baik">Good</option>
          <option value="rusak"> Risk</option>
      </select>
  </td>
  <td>
      <select name="mutasi[]" id="mutasi" class="form-control form-control-sm" placeholder="Mutation" required onchange="select_mutation(this.value,${n})">
          <option value=""></option>
          <option value="1">Employee</option>
          <option value="2">Division</option>
          <option value="3">Project</option>
          <option value="4">Office</option>
          <option value="5">SCM</option>
      </select>
      <div id="rsl_mutasi${n}"></div>
  </td>
  <td><input type="text" name="alokasi[]" id="sn" class="form-control form-control-sm" placeholder="Allocation"></td>
  <td style="display:inline-flex;"><input type="date" name="handover_date[]" id="handover_date" class="form-control form-control-sm" placeholder="Handover Date" style="width:140px;"><button class="ml-2 btn btn-danger btn-sm" onclick="del_asset('#la${n}')">Del</button></td>
</tr>`);
}

function select_mutation(n,no) { 
  var d = $('#rsl_mutasi'+no);
  d.html('');
  if (n == '1') {
    // get employerd
    get_employ(d,no);
  }else if(n == '2'){
    // get devision
    get_devision(d,no);
  }else if (n == '3') {
    // get project
    get_project(d,no);
  }
}

function get_employ(d,no) { 
  var data = '';
   data  += '<select name="mutasi_to[]" id="karyawan'+no+'" class="mt-2 form-control form-control-sm">';
   data  += '</select>';
   d.html(data);

   $('#karyawan'+no).html('');
   $.ajax({
    type: "POST",
    url: "../Karyawan/getKaryawanJson",
    dataType: "json",
    success: function (r) {
      r.forEach(v => {
        $('#karyawan'+no).append('<option value="'+v.id+'">'+v.nama+'</option>');
      });
    }
  });
}

function get_devision(d,no) { 
  var data = '';
   data  += '<select name="mutasi_to[]" id="devision'+no+'" class="mt-2 form-control form-control-sm">';
   data  += '</select>';
   d.html(data);

   $('#devision'+no).html('');
   $.ajax({
    type: "POST",
    url: "../Hcm/get_jabatan_grp",
    dataType: "json",
    success: function (r) {
      r.forEach(v => {
        $('#devision'+no).append('<option value="'+v.id+'">'+v.nama_group+'</option>');
      });
    }
  });
}

function get_project(d,no) { 
  
   var data = '';
   data  += '<select name="mutasi_to[]" id="project'+no+'" class="mt-2 form-control form-control-sm">';
   data  += '</select>';
   d.html(data);

   $('#project'+no).html('');
   $.ajax({
    type: "POST",
    url: "../Project/get_projek_all",
    dataType: "json",
    success: function (r) {
      r.forEach(v => {
        $('#project'+no).append('<option value="'+v.id+'">'+v.service+'</option>');
      });
    }
  });
}

function del_asset(id='') { 
  $(id).remove();
}

function showtable() {
	//console.log('list');
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
          "url": 'dt_detail_inv_device',
          "type": "POST",
          "data" : {
              'type' : $('#type').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }
