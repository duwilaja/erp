
var txtRFile1 = [];
var txtRFile2 = [];

$(document).ready(function () {
    dtLaporanData();
});

function dtLaporanData() { 
    $('.card-all').html('');
    $.ajax({
        type: "GET",
        url: 'apiGetTgh?aksi=2',
        dataType: "json",
        success: function (r) {
            if (r.status) {
                r.data.forEach(v => {
                    let ok = `
                    <div class="card" >
                    <div class="card-body" data-toggle="collapse" href="#collaps${v.projek_id}" role="button" aria-expanded="false" aria-controls="collaps${v.projek_id}">
                        <div class="row">
                            <div class="col-md-8">
                                <p style="font-size: small;color:#d81b60; display:inline;">${v.customer != null ? v.customer +' - ' : ''}${v.custend}</p>
                                <div style="font-size:14px;">${v.service2}</div>
                            </div>
                            <div class="col-md-2">
                                <p style="font-size: small;color:#DDD;">Tanggal Tagihan</p>
                                <div style="font-size: medium;">${v.tghDate}</div>
                            </div>
                            <div class="col-md-2 box">
                                <a href="#" class="b btn btn-default" style="font-size: 14px;"  data-toggle="modal" data-target="#laporanUpload" onclick="getjl('${v.projek_id}','${v.tgh_list_id}')">Upload Data</a>
                            </div>
                        </div>
                        <div>
                            <hr>
                            <ul class="dkp">
                              ${ pjl(v.projek_id,v.tgh_list_id,v.doc) }
                            </ul>
                        </div>
                    </div>
                </div>`;
                    $('.card-all').append(ok);
                });
            }
        }
    });
}

function pjl(p,tlid,doc) { 
    let q = '';
     doc.forEach(r => {
        q += `<li><a  class="dkp-list" href="${url+'data/projek/'+p+'/'+tlid+'/'+r.jl+'/'+r.file}">${r.jl}</a></li>`;
     });

     return q;
 }

 function getjl(p,tlid) { 
    let jl = $('#jenis_lamp');
    jl.html('');
     $.ajax({
         type: "GET",
         url: "apiJl",
         dataType: "json",
         success: function (r) {

            $('#projek_id').val(p);
            $('#tgh_list_id').val(tlid);

            $.each(r, function (i, x) { 
                obj = `<div class="col-md-5">
                <div class="custom-file mb-3">
                  <input type="file" class="custom-file-input" onchange="pilihFile(this,'${x.id}')" id="jl${x.id}" name="f${x.id}">
                  <label class="custom-file-label" for="jl${x.id}">${x.jl}</label>
                </div>
                </div>
                <div class="col-md-7">
                  <div class="txtRFile${x.id}"  style="font-size:12px;background:#FAFAFA;border:solid 1px #DDD;border-radius: 4px;padding:8px;">
                    ...
                  </div>
                  <input type="hidden" id="txtRFile${x.id}" name="tf${x.id}">
                 
                </div>`;

                jl.append(obj);
            });
         }
     });
  }

  function pilihFile(v,id) {
    var fileName = $(v).val().split("\\").pop();
    $('.txtRFile'+id).text(fileName);
    $('#txtRFile'+id).val(fileName);
    
    txtRFile1.push(".txtRFile"+id);
    txtRFile2.push("#txtRFile"+id);
}

$('#formUpload').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "uploadDok",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (r) {
            if (r.status) {
                alert('Success upload data');
                dtLaporanData();
            }else{
                alert('Failed to upload data');
            }
            $('#laporanUpload').modal().hide();
            $('.loading').hide();
            $('.modal-backdrop').hide();

            txtRFile1.forEach(v => {
                $(v).text('...');
            });
            
            txtRFile2.forEach(v => {
                $(v).val('');
            });
        }
    });
});