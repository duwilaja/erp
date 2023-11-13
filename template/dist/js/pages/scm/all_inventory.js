let no = 1;

$(document).ready(function() {
    showtable();
    showtable_property();
    showtable_elec();
    showtable_project();
});

$('#form_edit_device').submit(function (e) { 
  e.preventDefault();
  $.ajax({
      type: "POST",
      url: "up_dvc_inv",
      secureuri: false,
      contentType: false,
      cache: false,
      processData:false,
      data: new FormData(this),
      dataType: "json",
      beforeSend: function() {
         $('#btn-edit').hide();
         $('#btn-edit-loading').show();
      },
      success: function (r) {
          if (r.status) {
              Swal.fire(
                'Berhasil',
                r.msg,
                'success'
              );
              $('#modal_create_asset').modal('hide');

              $('#btn-edit').show();
              $('#btn-edit-loading').hide();
              $('#list_assets').html('');
              showtable();
          }else{
              Swal.fire(
                'Gagal',
                r.msg,
                'error'
              );

              $('#btn-edit').show();
              $('#btn-edit-loading').hide();
          } 
      },
      error: function () { 
          Swal.fire(
              'Gagal',
              'Terjadi gangguan sistem, harap hubungi developer',
              'error'
            );

            $('#btn-edit').show();
            $('#btn-edit-loading').hide();
       }
  });
});

function select_mutation(n,id='') { 
  var d = $('#rsl_mutation');
  d.html('');
  if (n == '1') {
    // get employerd
    get_employ(d,id);
  }else if(n == '2'){
    // get devision
    get_devision(d,id);
  }else if (n == '3') {
    // get project
    get_project(d,id);
  }
}

function get_employ(d,id) { 
  var data = '';
   data  += '<select name="e_mutasi_to" id="karyawan" class="mt-2 form-control form-control-sm">';
   data  += '</select>';
   d.html(data);
   $('#karyawan').html('');
   $.ajax({
    type: "POST",
    url: "../Karyawan/getKaryawanJson",
    dataType: "json",
    success: function (r) {
      r.forEach(v => {
        if(id == v.id) {
          $('#karyawan').append('<option selected value="'+v.id+'">'+v.nama+'</option>');
        }else{
          $('#karyawan').append('<option value="'+v.id+'">'+v.nama+'</option>');
        }
      });
    }
  });
}

function get_devision(d,id) { 
  var data = '';
   data  += '<select name="e_mutasi_to" id="devision" class="mt-2 form-control form-control-sm">';
   data  += '</select>';
   d.html(data);

   $('#devision').html('');
   $.ajax({
    type: "POST",
    url: "../Hcm/get_jabatan_grp",
    dataType: "json",
    success: function (r) {
      r.forEach(v => {
        if(id == v.id) {
          $('#devision').append('<option selected value="'+v.id+'">'+v.nama_group+'</option>');
        }else{
          $('#devision').append('<option value="'+v.id+'">'+v.nama_group+'</option>');
        }
      });
    }
  });
}


function get_project(d,id) { 
  
  var data = '';
  data  += '<select name="e_mutasi_to" id="project_all" class="mt-2 form-control form-control-sm">';
  data  += '</select>';
  d.html(data);

  $('#project_all').html('');
  $.ajax({
   type: "POST",
   url: "../Project/get_projek_all",
   dataType: "json",
   success: function (r) {
     r.forEach(v => {
      if(id == v.id) {
        $('#project_all').append('<option selected value="'+v.id+'">'+v.service+'</option>');
      }else{
        $('#project_all').append('<option value="'+v.id+'">'+v.service+'</option>');
      }
     });
   }
 });
}

function get_device(id) { 
   $.ajax({
        type: "POST",
        url: "get_device/"+id,
        dataType: "json",
        success: function (r) {
          $('input[name="e_id"]').val(r.id);
          $('select[name="e_category"]').val(r.category);
          $('select[name="e_status"]').val(r.status);
          $('input[name="e_sn"]').val(r.sn);
          $('input[name="e_purchase_date"]').val(r.purchase_date);
          $('select[name="e_mutation"]').val(r.mutation);
          $('input[name="e_alokasi_dvc"]').val(r.alokasi_dvc);
          $('input[name="e_handover_date"]').val(r.handover_date);
          $('input[name="e_return_date"]').val(r.return_date);
          select_mutation(r.mutation,r.mutation_to);
            get_merk(r.merek_id); 
            setTimeout(() => {
              get_type(r.type_id,r.merek_id);
            }, 200);
        }
    });
}

function get_merk() { 
     $('#merk').html('');
     $.ajax({
      type: "POST",
      url: "get_dvc_merek",
      dataType: "json",
      success: function (r) {
        r.forEach(v => {
          $('#merk').append('<option value="'+v.id+'">'+v.merek+'</option>');
        });
      }
    });
}

function get_type(id='',merk='') { 
    $('#type').html('');

    $.ajax({
     type: "POST",
     url: "get_dvc_type/"+$('#merk').val(),
     dataType: "json",
     success: function (r) {
       r.forEach(v => {
         if(v.id == id){
           $('#type').append('<option selected value="'+v.id+'">'+v.type+'</option>');
         }else{
          $('#type').append('<option value="'+v.id+'">'+v.type+'</option>');
         }
       });
     }
   });
}

// function del_asset(id='') { 
//   $(id).remove();
// }

function showtable() {
	//console.log('list');
    $('#tabel_all').DataTable({
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
          "url": 'dt_all_inventory',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }

  function showtable_property() {
	//console.log('list');
    $('#tabel_property').DataTable({
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
          "url": 'dt_all_inventory',
          "type": "POST",
          "data" : {
              'category' : '1'
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }

  function showtable_elec() {
	//console.log('list');
    $('#tabel_electronic').DataTable({
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
          "url": 'dt_all_inventory',
          "type": "POST",
          "data" : {
              'category' : '2'
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }

  function showtable_project() {
	//console.log('list');
    $('#tabel_project').DataTable({
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
          "url": 'dt_all_inventory',
          "type": "POST",
          "data" : {
              'category' : '3'
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }