let no = 1;
$(document).ready(function() {
    get_merek('','select[name="merek"]');
});

$('#form_inventory').submit(function (e) { 
  e.preventDefault();
  $.ajax({
      type: "POST",
      url: "in_form_inventory",
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
              $('#modal_form_inventory').modal('hide');
              $('#form_inventory')[0].reset();

              $('#btn-save').show();
              $('#btn-save-loading').hide();
              $('#list_sn').html('');
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

function add(jml='') { 
  var n = no++;
  $('#list_sn').html('');
    if (jml <= 100) {
        for (let i = 0; i < jml; i++) {
            $('#list_sn').append(`<tr id="sn${n}">
            <td><input type="text" name="sn[]" class="form-control form-control-sm" placeholder="Masukan SN"></td>
        </tr>`);
        }
    }
}

function get_merek(id='',name='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "get_dvc_merek",
        dataType: "json",
        success: function (r) {
            $(name).html('<option value=""></option>');
            r.forEach(e => {
                $(name).append(`<option value="${e.id}">${e.merek}</option>`);
            });
        }
    });
}

function get_type(id='',name='',merek='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "get_dvc_type/"+merek,
        dataType: "json",
        success: function (r) {
            r.forEach(e => {
                $(name).append(`<option value="${e.id}">${e.type}</option>`);
            });
        }
    });
}

function cetak_sn() {
    let qty = $('input[name="qty"]').val();
    if (qty > 0) {
        add(qty);
        $('#tabel_sn').show();
    }else{
        $('#tabel_sn').hide();
        $('#list_sn').html('');
    }
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
