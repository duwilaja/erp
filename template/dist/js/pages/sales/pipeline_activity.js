var hasil = $('#hasil');
var idx = $('input[name="id"]').val();

$(document).ready(function () {
    formAddPipActivity();    

    var ok =  $('select[name="activity"]').val($('input[name="act"]').val());
    // cekActivity($('input[name="act"]').val());
    cekActivity($('input[name="act"]').val());
    getStatAct();

});


$('select[name="activity"]').change(function (e) { 
    e.preventDefault();
    hasil.html('');
    var v = $(this).val();

    cekActivity(v);
    setTimeout(() => {
        cekPersentasiLanjut();  
    }, 300);
});


function cekActivity(act=''){ 
    var service_title = '';
    var nominal = '';
    var no_kontrak = '';
    var start_date = '';
    var present_date = '';
    var checked = '';
    var mom = '';
    var sph = '';
    var masa_kontrak = '';
    var cust_need = '';
    var bakn = '';
    var po = '';
    var kontrak = '';
    var pl = '';

    $.ajax({
        type: "GET",
        url: "../getAct",
        data: {pipe_id : idx,'act' : act},
        dataType: "json",
        success: function (r) {
            $('textarea[name="note"]').val(r.note);
            if (act == 1) {
                // Contact Potential
                start_date = r.start_date;
                hasil.append(`<div class="col-md-12">
                <div class="mb-2 mt-2">Tanggal</div>
                    <input type="date" name="start_date" class="form-control" id="date" value="${start_date}" >
                </div>`);
            }else if (act == 2) {
                present_date = r.present_date;
                if(r.req_presales != 0) checked = "checked"; 
                
                if(r.mom != "") mom = '<div class="badge badge-light">'+r.mom+'</div>'; 
                if(r.mom == "") mom = '';

                if(r.cust_need != "") cust_need = '<div class="badge badge-light">'+r.cust_need+'</div>'; 

                // Persentation 
                hasil.append(`<div class="col-md-12">
                <div class="mb-2 mt-2">Tanggal Persentasi</div>
                <input type="date" name="present_date" class="form-control" value="${present_date}" id="pd">
             </div>
             <div class="col-md-6">
                <div class="mb-2 mt-2">MOM</div>
                <input type="file" name="mom" class="form-control" id="mom">
                 ${mom}
             </div>
             <div class="col-md-6">
                <div class="mb-2 mt-2">Customer Butuhkan</div>
                <input type="file" name="cust_need" class="form-control" id="cn">
                ${cust_need}
             </div>`);
            }else if (act == 3) {
                present_date = r.present_date;
                if(r.next_p != 0) {
                    checked = "checked"
                }
                if(r.mom != "") mom = '<div class="badge badge-light">'+r.mom+'</div>'; 
                if(r.cust_need != "") cust_need = '<div class="badge badge-light">'+r.cust_need+'</div>'; 


                // Teckhincal Persentation
                hasil.append(`<div class="col-md-12 mt-2">
                <input type="checkbox" name="pl" id="pl" ${checked} onchange="cekPersentasiLanjut(this.value)" value="1"> Persentasi Lanjutan
             </div>
            <div class="col-md-12 xall" style="display:none;">
                <div class="row">
                <div class="col-md-12">
                    <div class="mb-2 mt-2">Tanggal Persentasi</div>
                    <input type="date" name="present_date" class="form-control" id="tp" value="${present_date}">    
                </div>
                <div class="col-md-6">
                    <div class="mb-2 mt-2">MOM</div>
                    <input type="file" name="mom" class="form-control" id="mom">
                    ${mom}
                </div>
                <div class="col-md-6">
                    <div class="mb-2 mt-2">Customer Butuhkan</div>
                    <input type="file" name="cust_need" class="form-control" id="cn">
                    ${cust_need}
                </div>
                </div>
             </div>
             </div>`);
            }else if(act == 4){
                present_date = r.created_date;
                if(r.mom != "") mom = '<div class="badge badge-light">'+r.mom+'</div>'; 

                hasil.append(`<div class="col-md-12">
                <div class="mb-2 mt-2">Tanggal Poc</div>
                <input type="date" name="present_date" class="form-control" id="pd" value="${present_date}">
             </div>
             <div class="col-md-6">
                <div class="mb-2 mt-2">MOM</div>
                <input type="file" name="mom" class="form-control" id="mom">
                ${mom}
             </div>`);
            }else if(act == 5){
                nominal = r.nominal;
                if(r.ccapex != 0) var ccapex = "checked";
                if(r.copex != 0) var copex = "checked";
              
                if(r.sph != "") sph = '<input type="file" name="sph" class="form-control" id="sph">'+'<div class="badge badge-light">'+r.sph+'</div>';
               
                if(r.fcapex != "") var fcapex = '<div class="badge badge-light">'+r.fcapex+'</div>';
                if(r.fcapex == "") var fcapex = '<input type="file" class="form-control" name="fcapex">';
              
                if(r.fopex != "") var fopex = '<div class="badge badge-light">'+r.fopex+'</div>';
                if(r.fopex == "") var fopex = '<input type="file" class="form-control" name="fopex">';

                hasil.append(`<div class="col-md-12">
                    <div class="mb-2 mt-2">Pricing</div>
                     <input type="checkbox" name="ccapex" ${ccapex} id="pl" value="1"> MRC  <input type="checkbox" ${copex} name="copex" id="pl" value="1"> OTC
                </div>
             <div class="col-md-12">
                <div class="card mt-3">
                <div class="card-header">SPH</div>
                    <div class="card-body">
                     <div class="bks">
                        <div class="mt-2 mb-2">Judul Pekerjaan</div>
                        <div class="mt-2 mb-2">
                            <input type="text" class="form-control" name="jdl_pek" value="${r.judul_p}">
                        </div>
                     </div>
                     <div class="bks">
                        <div class="mt-2 mb-2">No SPH</div>
                        <div class="mt-2 mb-2">
                            <input type="text" class="form-control" name="no_sph" value="${r.no}">
                        </div>
                     </div>
                     
                     <div class="bks">
                        <div class="mt-2 mb-2">SPH</div>
                        <div class="mt-2 mb-2">
                            ${sph}
                        </div>
                     </div>

                    </div>
                </div>
             </div>`);
            }else if(act == 6){
                nominal = r.nominal;
                if(r.bakn != "") bakn = '<div class="badge badge-light">'+r.bakn+'</div>'; 
                service_title = r.service_title;

                hasil.append(`<div class="col-md-12">
                <div class="mb-2 mt-2">Judul Pelayanan</div>
                <input id="jp" class="form-control" name="service_title" value="${service_title}"/>
             </div>
             <div class="col-md-6">
                <div class="mb-2 mt-2">Nominal BAKN</div>
                <input type="number" name="nominal" class="form-control" id="nominal" value="${nominal}">
             </div>
             <div class="col-md-6">
                <div class="mb-2 mt-2">Upload BAKN</div>
                <input type="file" name="bakn" class="form-control" id="bakn">
                ${bakn}
             </div>`);
            }else if(act == 7){
                
                nominal = r.nominal;
                if(r.po != "") po = '<div class="badge badge-light">'+r.po+'</div>'; 
                service_title = r.service_title;
                no_po = r.no;
                jml = r.jml;
                masa_kontrak = r.masa_kontrak;
                start_date = r.start_date;
                end_date = r.end_date;

                hasil.append(`<div class="col-md-12">
                <div class="mb-2 mt-2">No PO</div>
                <input name="no_po" id="no_po" class="form-control" value="${no_po}"/>
             </div>
             <div class="col-md-12">
                <div class="mb-2 mt-2">Judul Pelayanan</div>
                <input name="service_title" id="jp" class="form-control" value="${service_title}"/>
             </div>
             <div class="col-md-12">
                <div class="mb-2 mt-2">Jumlah Titik/Lokasi</div>
                <input type="number" name="jml" class="form-control" id="jml_titik" value="${jml}">
             </div>
              <div class="col-md-12">
                <div class="mb-2 mt-2">Masa Kontrak</div>
                <input type="text" name="masa_kontrak" class="form-control" id="masa_kontrak" value="${masa_kontrak}">
             </div>
             <div class="col-md-12">
                <div class="mb-2 mt-2">Nominal PO</div>
                <input name="nominal" id="nominal" class="form-control" value="${nominal}"/>
             </div>
             <div class="col-md-12">
                <div class="mb-2 mt-2">Period</div>
                <div class="row">
                   <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2 mt-2">Tanggal Mulai</div>
                                <input type="date" name="start_date" class="form-control" id="tgl_mulai" value="${start_date}">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2 mt-2">Tanggal Selesai</div>
                                <input type="date" name="end_date" class="form-control" id="tgl_selesai" value="${end_date}">
                            </div>
                        </div>
                    </div>
                    </div>
                   </div>
                </div>
             </div>
             <div class="col-md-12">
                <div class="mb-2 mt-2">Upload PO</div>
                <input type="file" name="po" class="form-control" id="po">
                ${po}
             </div>`)
            }else if(act == 10){
                if(r.kontrak != "") kontrak = '<div class="badge badge-light">'+r.kontrak+'</div>'; 
                no_kontrak = r.no_kontrak;

                hasil.append(`
                <div class="col-md-12">
                <div class="mb-2 mt-2">Nomor Kontrak</div>
                <input name="no_kontrak" id="no_kontrak" type="text" class="form-control" value="${no_kontrak}"/>
             </div>
             <div class="col-md-6">
                <div class="mb-2 mt-2">Upload Kontrak</div>
                <input type="file" name="kontrak" class="form-control" id="kontrak">
                ${kontrak}
             </div>`);
            }
        }
    }); 
 }

 function cekPersentasiLanjut(v) { 
   if($('#pl').is(":checked")) {
        // checkbox is checked -> do something
        $('.xall').show();
    } else {
        // checkbox is not checked -> do something different
        $('.xall').hide();
    }
  }


 function formAddPipActivity() { 
    $('#formAddPipActivity').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'SelMa/inPipelineActivity',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                getStatAct();
            }
        });
    });
}

function getStatAct() { 
    var acx = '';
    $('.getAct').html('');
    var act = $('#actx').val();
    if(act != '') acx = '?act=2';
    $.ajax({
        type: "GET",
        url: "../getStatAct/"+idx+acx,
        dataType: "json",
        success: function (data) {
            data.forEach(v => {
                $('.getAct').append(`<div class="clist"><i class="${v.v == 1 ? 'fa fa-check text-success pr-2' : 'fa fa-window-close text-danger pr-2' }" id="act1"></i>${v.nama}</div>`);
            });
        }
    });
}