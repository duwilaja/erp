$(document).ready(function() {
    showtable();
    getProjek();
	showtable_rpt();
} );

$('#filter_devices').submit(function (e) { 
  e.preventDefault();
  showtable();
});

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
          "url": 'dt_device',
          "type": "POST",
          "data" : {
            'device' : $('#device').val(),
            'project' : $('#project').val(),
            'status' : $('#condition').val(),
            'used' : $('#used').val(),
            'allocation' : $('#allocation').val(),
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [9,10],
          "orderable": false
        }]
      });
  }

  function showtable_rpt() {
	 // console.log('rpt');
    $('#tabel_rpt').DataTable({
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
          "url": 'dt_device',
          "type": "POST",
        },
        dom: 'lfrtipB',
		buttons: ['copy', 'csv'],
		//Set column definition initialisation properties
        //"columnDefs": [{
        //  "targets": [8],
        //  "orderable": false
        //}]
      });
  }

function save_multi(u,flag){
	$("#flag").val(flag);
	var frmdata=new FormData($("#f_devices")[0]);
	$.ajax({
		type: "post",
		url:u,
		data : frmdata,
		cache: false,
		contentType: false,
		processData: false,
		success: function (res) {
			console.log (res);
			toastr.info(res);
		},
		error: function (xhr,status){
			toastr.error("Error, contact admin");
		}
	});
}

function getProjek() { 
  var project_id = $('#project_id').val();
  $.get("../../pm/getProjek",
    function (data, textStatus, jqXHR) {
      data.forEach(v => {
        $('select[name="project"]').append('<option '+cekSelected(v.id,project_id)+' value="'+v.id+'">'+v.service+'</option>');
      });
    },
    "json"
  );
}

function cekSelected(a,b) { 
  if (a == b) return 'selected';
 }


 $('#upload_device').submit(function (e) { 
  e.preventDefault();
  $.ajax({
      type: "POST",
      url: "import_sd",
      secureuri: false,
      contentType: false,
      cache: false,
      processData:false,
      data: new FormData(this),
      dataType: "json",
      beforeSend: function() {
         $('#btn-import').hide();
         $('#btn-import-loading').show();
      },
      success: function (r) {
          if (r.status) {
              Swal.fire(
                'Berhasil',
                r.msg,
                'success'
              );
              $('#upload_device')[0].reset();
              $('#modal_import_device').modal('hide');

              $('#btn-import').show();
              $('#btn-import-loading').hide();
              showtable();

          }else{
              Swal.fire(
                'Gagal',
                r.msg,
                'error'
              );

              $('#btn-import').show();
              $('#btn-import-loading').hide();
          } 
      },
      error: function () { 
          Swal.fire(
              'Gagal',
              'Terjadi kesalahan upload',
              'error'
            );

            $('#btn-import').show();
            $('#btn-import-loading').hide();
       }
  });
});
