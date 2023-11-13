
let div = [];
var no = 1;
var id_wo = $('#id_wo').val();
$(document).ready(function () {
    showtable();
    get_detail_projek();
});

function cek_cdp() {
    

    setTimeout(() => {
        // document.querySelector(".tabel_cd").style.width = "100%";
        document.querySelector(".dataTables_scrollHeadInner").style.width = "100%";
    }, 1000);

	//console.log('list');
    $('#tabel_cd').DataTable({
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
          "url": 'dt_cek_dvc_projek',
          "type": "POST",
          "data": {
              'id_wo' : id_wo
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
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
          "url": 'dt_install',
          "type": "POST",
          "data": {
              'id_wo' : id_wo
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
}

function get_install(id='') { 
    $.ajax({
        type: "GET",
        url: "get_install",
        data: {id : id },
        dataType: "json",
        success: function (r) { 
          $('input[name="id"]').val(r.id);
          $('input[name="pic"]').val(r.pic);
          $('input[name="location"]').val(r.location);
          $('select[name="status_exec"]').val(r.status_exec);
          $('select[name="status"]').val(r.status);
          $('select[name="exec_id"]').val(r.exec_id);
          $('input[name="install_date"]').val(r.install_date);
          $('#txt_bai').html('<a target="_blank" href="../data/sdv/bai/'+r.file_bai+'">'+r.file_bai+'</a>');
          $('#txt_bast').html('<a target="_blank" href="../data/sdv/bast/'+r.file_bast+'">'+r.file_bast+'</a>');
          $('#txt_snmp').html('<a target="_blank" href="../data/sdv/snmp/'+r.file_snmp+'">'+r.file_snmp+'</a>');
          change_exec(r.status_exec,r.exec_id);
        //   device_sn(r.id);
        }
      });
}

function get_detail_projek() { 
    $.ajax({
        type: "GET",
        url: "get_info_project",
        data: {id : id_wo },
        dataType: "json",
        success: function (r) { 
          $('#txt_service').text(r.service);
          $('#txt_no_po').text('No. PO : '+r.no_po);
          $('#txt_masa_kontrak').text(r.masa_kontrak);
          $('#txt_jml_install').text(r.jml_task+' Task');
          $('#txt_persen_install').text(r.persen_task);
        //   $('#txt_jml_install_device').text(r.jml_install_device);
          $('#txt_team_lead').text(r.team_lead);
          $('#txt_cust').text(r.cust);
          $('#txt_custend').text(r.custend);
          $('#txt_sales').text(r.sales);
          $('#txt_pm').text(r.pm);
        }
      });
}


function change_exec(s='',id='') { 
    if (s != '') {
        if (s == '1') {
            get_kary(id,'#exec_id');
        }else if(s == '2'){
            get_partner(id,'#exec_id');
        }
    }
}

function add() { 
    var n = no++;
    if (div.length <= 14) {
        $('#list_assets').append(`<div class="col-md-4 mt-2" id="n${n}">
        <div  class="row"> 
        <div class="col-md-10">
             <select name="device_id[]" id="device${n}" class="form-control form-control-sm w-100" required>
             ${get_device_for_install('','#device'+n)}
             </select>
         </div> 
         <div class="col-md-2">
             <button type="button" class="btn btn-sm btn-danger" onclick="del('#n${n}')"><i class="far fa-trash-alt"></i></button>
         </div> 
         </div>
     </div>`);
     div.push(n);
    }
 }
 
 function del(id_tr) {
    $(id_tr).remove();
    div.pop();
}

function get_kary(id='',name='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "../Karyawan/getKaryJson",
        dataType: "json",
        success: function (r) {
            r.forEach(e => {
                if (e.id == id) {
                    $(name).append(`<option selected value="${e.id}">${e.nama}</option>`);
                }else{
                    $(name).append(`<option value="${e.id}">${e.nama}</option>`);
                }
            });
        }
    });
}

function get_partner(id='',name='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: "../VM/get_partner",
        dataType: "json",
        success: function (r) {
            r.forEach(e => {
                if (e.id == id) {
                    $(name).append(`<option selected value="${e.id}">${e.name}</option>`);
                }else{
                    $(name).append(`<option value="${e.id}">${e.name}</option>`);
                }
            });
        }
    });
}

// function get_dvc_wo(id='',name='',grp='',type_id='') { 
//     $(name).html('');
//     $.ajax({
//         type: "GET",
//         url: 'get_sdv_wo_dvc',
//         data: {wo_id : id_wo,grp : grp,type_id : type_id },
//         dataType: "json",
//         success: function (r) {
//             $(name).html(''); 
//                 r.forEach(e => {
//                     if (e.device_id == id) {
//                         $(name).append(`<option selected value="${e.device_id}">${e.type+' - SN('+e.sn+')'}</option>`);
//                     }else{
//                         $(name).append(`<option value="${e.device_id}">${e.type+' - SN('+e.sn+')'}</option>`);
//                     }
//              });

//              $(name).select2({
//                 dropdownParent: $("#installation_form")
//             });
//         }
//     });
// }

function get_device_for_install(id='',name='') { 
    $(name).html('');
    $.ajax({
        type: "GET",
        url: 'get_device_for_install',
        data: {wo_id : id_wo },
        dataType: "json",
        success: function (r) {
            $(name).html(''); 
                r.forEach(e => {
                    if (e.device_id == id) {
                        $(name).append(`<option selected value="${e.device_id}">${e.type+' - SN('+e.sn+')'}</option>`);
                    }else{
                        $(name).append(`<option value="${e.device_id}">${e.type+' - SN('+e.sn+')'}</option>`);
                    }
             });

             $(name).select2({
                dropdownParent: $("#installation_form")
            });
        }
    });
}

function get_sn(id='') { 
    $('#list_sn').html('');
    $.ajax({
        type: "GET",
        url: "get_install_dvc_scm",
        data : {id : id},
        dataType: "json",
        success: function (r) {
            r.forEach(e => {
                $('#list_sn').append(`<tr>
                    <td>${e.type}</td>
                    <td>${e.sn}</td>
                </tr>`);
            });
        }
    });
}

function pilih_datek(cek='') {
    $.ajax({
        type: "POST",
        url: "pilih_datek",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData($('#form_import_datek')[0]),
        dataType: "json",
        beforeSend: function() {
        //    $('#btn-save').hide();
        //    $('#btn-save-loading').show();
        },
        success: function (r) {
           console.log(r);
           $('#file').val(r.file);
           get_select(r,'#lokasi');
           get_select(r,'#pic');
        },
        error: function () { 
            if (cek == '') {
                Swal.fire(
                    'Gagal',
                    'Terjadi gangguan sistem, harap hubungi developer',
                    'error'
                  );
            }
         }
    });
    
    if (cek != '') $('#form_import_datek')[0].reset();
}

function get_select(value='',name='') { 
    $(name).html('');
    $(name).append(`<option value="">-- Pilih --</option>`);
    value.data.forEach(e => {
        $(name).append(`<option value="${e.key}">${e.value}</option>`);
    });
}

$('#form_import_datek').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "import_datek",
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
                $('#modal_upload_datek').modal('hide');
  
                $('#btn-import').show();
                $('#btn-import-loading').hide();

                get_detail_projek();
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
                'Terjadi gangguan sistem, harap hubungi developer',
                'error'
              );
  
              $('#btn-import').show();
              $('#btn-import-loading').hide();
         }
    });
    $('#form_import_datek')[0].reset();
  });

$('#in_installation_form').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "in_installation_form",
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
                $('#in_installation_form')[0].reset();
                $('#installation_form').modal('hide');
  
                $('#btn-save').show();
                $('#btn-save-loading').hide();

                $('#list_assets').html('');
                get_detail_projek();
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
                'Terjadi gangguan sistem, harap hubungi developer',
                'error'
              );
  
              $('#btn-save').show();
              $('#btn-save-loading').hide();
         }
    });
  });