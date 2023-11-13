let status = '';
let limit = '';

let no_data = ` <div class="card">
<div class="card-body text-center">
    Belum Ada Data
</div>
</div>`;

$(document).ready(function () {
    $('#projek').select2({
        dropdownParent: $("#modalAddTagihan")
    });
    getProjek();
});

$('#formAddTagihan').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "addTagihan",
        data: $(this).serialize(),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
                getTgh(nm);
                document.getElementById("formAddTagihan").reset();
                $('#modalAddTagihan').modal('hide');
            }else{
                Swal.fire(
                    'Gagal',
                    r.msg,
                    'error'
                  );
            } 
        }
    });
});

function getProjek() { 
    $('#projek').html();
    $.ajax({
        type: "GET",
        url: "../Project/getProjek",
        dataType: "json",
        success: function (r) {
            if (r.status) {
                r.data.forEach(e => {
                    $('#projek').append('<option value="'+e.id+'">'+e.service+'</option>');
                });
            }
        }
    });
}


function getTgh(aksi='') { 
        status = $('#sel-filter').val();
        limit = $('#sel-urutan').val();
        cari = $('#cari').val();

    $('.card-all').html('');
    fetch('apiGetTgh?aksi='+aksi+'&status='+status+'&limit='+limit+'&cari='+cari)
    .then(response => response.json())
    .then(data => {
       let d = [];
       let obj = '';
       if (data.status) {
           d = data.data;

            $.each(d, function (i, x) { 
                    obj = `
                        <div class="card" data-toggle="tooltip" title="Klik untuk melihat selengkapnya" style="cursor: pointer;">
                        <div class="xstatus s${x.tstatus}">${x.status}</div>
                        <div class="card-body" data-toggle="collapse" href="#collaps${x.tgh_list_id}" role="button" aria-expanded="false" aria-controls="collaps${x.projek_id}">
                            <div class="row">
                                <div class="col-md-4">
                                    <p style="font-size: small;color:#dc3545;">${x.customer != null ? x.customer +' - ' : ''}${x.custend}</p>
                                    <div style="font-size: 12px;"><a href="detail_projek/${x.projek_id}"><span class="badge badge-light">${x.no_kontrak}</span><br>${x.service2}</a></div>
                                </div>
                                <div class="col-md-2">
                                    <p style="font-size: small;color:#555;">Tanggal Tertagih</p>
                                    <div style="font-size: 16px;color:#999;">${x.tghDate}</div>
                                </div>
                                <div class="col-md-2">
                                    <p style="font-size: small;color:#555;">Estimasi Tagihan</p>
                                    <div style="font-size: 16px;color:#666;">${x.tghTotal}</div>
                                </div>
                                <div class="col-md-2">
                                    <p style="font-size: small;color:#555;">Terbayar</p>
                                    <div style="font-size: 16px;color:#28a745;" id="txtTerbayar${x.tgh_list_id}">
                                    ${cekTerbayar(x)}
                                    </div>
                                </div>
                                <div class="col-md-2 box">
                                    <a href="#" class="b btn btn-default" style="font-size: 14px;width: 100%;" onclick="detailTgh(${x.projek_id+','+x.tgh_list_id})">Detail</a>
                                </div>
                            </div>
                            <div class="collapse multi-collapse" id="collaps${x.tgh_list_id}">
                                <div class="bord" style="border: dashed 1px #DDD;margin:10px 0;"></div>
                                <div class="row" style="font-size: 14px;">
                                    <div class="col-md-2">
                                        <p>Total Nilai Tagihan</p>
                                        <div class="nc">${x.total_kon_ppn}</div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>Nilai Tagihan Terjadwal</p>
                                        <div class="nc">${x.tghTotal}</div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>Terbayar</p>
                                        <div class="nc">${x.nterbayar}</div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>Terhutang</p>
                                        <div class="nc">${x.terhutang}</div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>Sisa Tagihan</p>
                                        <div class="nc">${x.sisa_tagihan}</div>
                                    </div>
                                    <div class="col-md-2">
                                        <p>Update Terakhir</p>
                                        <div class="nc">${x.updDate == '' ? '-' : x.updDate}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="bord" style="border: dashed 1px #DDD;margin:10px 0;"></div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p>Keterangan</p>
                                                <div class="nc" style="background: floralwhite;border: solid 1px #d4d4d4;padding: 1px 10px;border-radius: 10px;">${x.ket}</div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex flex-column">
                                                    <div class="x" style="overflow-y: scroll;width: 280px;">
                                                        <div class="d-flex justify-content-center">
                                                            <p>Dokumen Tersedia</p>
                                                            <p style="color: #AAA;"></p>
                                                        </div>
                                                    </div>
                                                    <div class="x">
                                                        <div>
                                                            ${ projek_dok_list(x.doc) }
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                    $('.card-all').append(obj);
                });
        }else{
            $('.card-all').html(no_data);
        }
       
    })
    .catch(error => console.error(error))
}

function projek_dok_list(doc) { 
    let q = '';
     doc.forEach(r => {
         q += '<span style="margin-top: 4px;background-color: #20c997;text-transform: uppercase;" class="badge badge-success ml-1">'+r.jl+'</span>';
     });

     return q;
 }

function detailTgh(projek_id='',tgh_list_id='') { 
    if (projek_id != '' && tgh_list_id != '') {
        window.location = "detail_tagihan/"+projek_id+'/'+tgh_list_id;
    }
 }

//Terbayar

function setTerbayar(n,x,p) { 
    var r = confirm("Sudah Invoice sebesar Rp "+formatNumber(n)+" ?");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "POST",
            url: "setTerbayar",
            data: {'n' : n,'tlid' : x,'p' : p},
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                      );
                    getTgh(nm);
                }
            }
        });
    } else {
        txt = "You pressed Cancel!";
        $('#terbayar'+x).val('');
    }
}

//cekTerbayar

function cekTerbayar(x) { 
    if (x.terbayar == '' || x.terbayar == 0) {
       return  `
       <div class="input-group mb-3">
       <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon1" style="font-size: 14px;padding: 0 4px;">Rp</span>
       </div>
       <input type="number" class="form-control" id="terbayar${x.tgh_list_id}" onchange="setTerbayar(this.value,${x.tgh_list_id+","+x.projek_id})" style="font-size: 14px;padding:1px 2px;height:auto;" placeholder="Terbayar" aria-label="Terbayar" aria-describedby="basic-addon1">
       </div>`;
    }else{
        return x.terbayar;
    }
}

// Cari

$('#cari').keyup(function (e) { 
    getTgh(nm);    
});

