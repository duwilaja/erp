$(document).ready(function() {
    dtPartner();

    addPartner();
    upPartner();
    getProvinsi();
    getJobs();
});



function getDownloadReport() { 
    value = $('.dataTables_filter input').val();
    $.ajax({
        type: "GET",
        url: "report_partner",
        dataType: "HTML",
        data : {
            'search' : value,
        },
        success: function (res) {
            window.location = this.url;           
        }
    });
}

function dtPartner() {
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
          "url": 'dtPartner/',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
}

function getEdit(id) { 
    $.ajax({
        type: "get",
        url: "get_partner?id="+id,
        dataType: "json",
        success: function (r) {
            
            $('input[name="e_id"]').val(r.id);
            // $('input[name="e_cp_id"]').val(r.cp_id);
            $('input[name="e_name"]').val(r.name);
            $('input[name="e_kategori"]').val(r.kategori);
            $('input[name="e_area"]').val(r.area);
            $('input[name="e_location"]').val(r.location);
            $('textarea[name="e_remaks"]').val(r.remaks);
            $('input[name="e_phone"]').val(r.phone);
            $('textarea[name="e_address"]').val(r.address);
            $('select[name="e_status"]').val(r.status);
            $('select[name="e_aktif"]').val(r.aktif);

            getJobs(r.jobs_id);
            getProvinsi(r.prov_id);
            getKota(r.prov_id,r.kota_id);

            $('#dcategory').text(r.ncategory);
            $('#dname').text(r.name);
            $('#dphone').text(r.phone);
            $('#daddress').text(r.address);
            $('#darea').text(r.area);
            $('#dstatus').text(r.nstatus);
            $('#daktif').text(r.aktif);
            $('#dlocation').text(r.location);
            $('#dremark').text(r.remaks);
            $('#daktif').text(r.aktif);

            selCategory(r.cp_id);
        }
    });
}

function getDetail(id) { 
    $.ajax({
        type: "get",
        url: "get_partner?id="+id,
        dataType: "json",
        success: function (r) {
            
            $('#kategori').text(r.kategori);
            $('#nama').text(r.name);
            $('#handphone').text(r.phone);
            $('#alamat').text(r.address);
            $('#aktivitas').val(r.status);
            $('#aktif').text(r.aktif);
            $('#area').text(r.area);
            $('#location').text(r.location);
            $('#catatan').text(r.remaks);
        }
    });
}

function getJobs(id="") { 
    $('select[name="jobs_id"]').html('');
    $.ajax({
        type: "GET",
        url: "getJobs",
        dataType: "json",
        success: function (r) {
            r.jobs.forEach(v => {
            if (v.id == id) {
                $('select[name="jobs_id"]').append("<option selected value='"+v.id+"'>"+v.jobs+"</option>");
            }else{
                $('select[name="jobs_id"]').append("<option value='"+v.id+"'>"+v.jobs+"</option>");
            }
            });
        }
    });
  }

function selCategory(id='') { 
   var http = httpGet("getCategory");
   var htm = '';
   $.each(http.data, function (a, v) {
        htm += '<option '+(v.id == id ? 'selected' : '')+' value="'+v.id+'">'+v.category+'</option>'; 
   });

   $('select[name="e_cp_id"]').html(htm);
}

function addPartner() { 
    $('#addPartner').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "inPartner",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtPartner();
                    document.getElementById("addPartner").reset();
                    $('#formAddPartner').modal('hide');
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: r.msg,
                    })
                }
            }
        }); 
    });
}

function upPartner() { 
    $('#editPartner').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "upPartner",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtPartner();
                    $('#formEditPartner').modal('hide');
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: r.msg,
                    })
                }
            }
        }); 
    });
}


function delPartner(id) { 
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "post",
            url: "dePartner",
            data: {
                'id' : id,
            },
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtPartner();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: r.msg,
                    })
                }
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}

//  Privinsi
function getProvinsi(id='') { 
    $('select[name="prov_id"]').html('');
    $.ajax({
        type: "get",
        url:'../Oprations/getProvinsiJson',
        dataType: "json",
        success: function (res) {
            $('select[name="prov_id"]').html('');
            $('select[name="prov_id"]').append("<option selected value=''></option>");
            $('select[name="e_prov_id"]').append("<option selected value=''></option>");
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="e_prov_id"]').append("<option selected value='"+value.id+"'>"+value.name+"</option>");
                }else{
                    $('select[name="e_prov_id"]').append("<option value='"+value.id+"'>"+value.name+"</option>");
                    $('select[name="prov_id"]').append("<option value='"+value.id+"'>"+value.name+"</option>");
                }
            });
            // $('select[name="prov_id"]').select2({
            //     dropdownParent: $("#modal-lg")
            // });
        }
    });
}

// Kota 
function getKota(id='',kota_id='') { 
    if(id == '') id = $('select[name="prov_id"]').val();
    $('select[name="kota_id"]').html('');
    $('select[name="e_kota_id"]').html('');
    $.ajax({
        type: "get",
        url:'../Oprations/getKotaJson?provinsi_id='+id,
        dataType: "json",
        success: function (res) {
            $('select[name="kota_id"]').html('');
            $('select[name="kota_id"]').append("<option selected value=''></option>");
            $('select[name="e_kota_id"]').append("<option selected value=''></option>");
            $.each( res, function( key, value ) {
                if (value.id == kota_id) {
                    $('select[name="e_kota_id"]').append("<option selected value='"+value.id+"'>"+value.name+"</option>");
                }else{
                    $('select[name="e_kota_id"]').append("<option value='"+value.id+"'>"+value.name+"</option>");
                    $('select[name="kota_id"]').append("<option value='"+value.id+"'>"+value.name+"</option>");
                }
            });

            
        }
    });
}