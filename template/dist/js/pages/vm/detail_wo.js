let id_wo = $('#id_wo').val();

$(document).ready(function () {
    get_wo();
    dt_detail_wo();
});

function get_install(id='') { 
    $.ajax({
        type: "GET",
        url: "../Serdev/get_install",
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
          change_exec(r.status_exec,r.exec_id);
          get_partner(r.exec_id,'#exec_id');
          setTimeout(() => {
              $('select[name="exec_id"]').val(r.exec_id);
          }, 300);
        //   device_sn(r.id);
        }
      });
}


function get_wo() { 
    $.ajax({
        type: "get",
        url: "get_info_project?id="+id_wo,
        dataType: "json",
        success: function (x) {
            $('#txt_service').text(x.service);
            $('#txt_cust').text(x.cust);
            $('#txt_custend').text(x.custend);
            $('#txt_jml_partner').text(x.jml_partner);
            $('#txt_jml_partner_op').text(x.jml_partner_op);
            $('#txt_jml_partner_d').text(x.jml_partner_d);
            $('#start_date').text(x.start_date);
            $('#end_date').text(x.end_date);
        }
    });
}

function dt_detail_wo() {
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
          "url": 'dt_detail_wo',
          "type": "POST",
          "data" : {
              'id' : id_wo
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,3,5],
          "orderable": false
        }]
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

$('#in_installation_form').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../Serdev/in_installation_form",
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
                get_wo();
                dt_detail_wo();
  
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
  
  function download_report() {
    new Promise((resolve, reject) => {
        $.ajax({  
            url : "export_data_partner",
            method : "POST",
            async : true,
            dataType : 'HTML',
            success: function(response){ 
                // window.location.assign('link_download?l='+response.link);
                // resolve(response.link);
                window.location = this.url; 
            }
        });
      });
  }