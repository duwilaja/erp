var txtRFile1 = [];
var txtRFile2 = [];

$(document).ready(function () {
    dtcuse();
    getCust();
    getCustEnd();
});

function dtcuse() { 
    $('.card-all').html('');
    $.ajax({
        type: "GET",
        url: 'apiGetKontrak',
        dataType: "json",
        success: function (r) {
            console.log(r);
            if (r.status) {
                r.data.forEach(v => {
                        let ok = `
                        <div class="card" data-toggle="tooltip" title="Klik untuk melihat selengkapnya" style="cursor: pointer;">
                        <div class="card-body" data-toggle="collapse" href="#collaps${v.projek_id}" role="button" aria-expanded="false" aria-controls="collaps${v.projek_id}">
                            <div class="row">
                                <div class="col-md-4">
                                    <p style="font-size: small;color:#dc3545;">${v.customer != null ? v.customer +' - ' : ''}${v.custend}</p>
                                    <div style="font-size: 12px;"><a href="#"><span class="badge badge-light">${v.no_kontrak}</span><br>${v.service}</a></div>
                                </div>
                                <div class="col-md-2">
                                    <p style="font-size: small;color:#555;">Masa Kontrak</p>
                                    <div style="font-size: 12px;color:#999;">${v.masa_kontrak}</div>
                                </div>
                                <div class="col-md-2">
                                    <p style="font-size: small;color:#555;">Periode Kontrak</p>
                                    <div style="font-size: 12px;color:#666;">${v.start_date != '0000-00-00' ? v.start_date : '' } - ${v.end_date != '0000-00-00' ? v.end_date : ''}</div>
                                </div>
                                <div class="col-md-2">
                                    <p style="font-size: small;color:#555;">Nominal Kontrak</p>
                                    <div style="font-size: 12px;color:#28a745;" id="txtTerbayar${v.total_tagihan}">
                                        ${v.total_tagihan}
                                    </div>
                                </div>
                                <div class="col-md-2 box">
                                    <a href="detail_kontrak?id=${v.projek_id}" class="b btn btn-default" style="font-size: 14px;width: 100%;">Detail</a>
                                </div>
                            </div>
                            <div class="collapse multi-collapse" id="collaps${v.projek_id}">
                                <div class="bord" style="border: dashed 1px #DDD;margin:10px 0;"></div>
                                <div class="row" style="font-size: 14px;">
                                    <div class="col-md-12">
                                        <div class="bord" ></div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p>Dibuat</p>
                                                <div class="nc" style="background: floralwhite;border: solid 1px #d4d4d4;padding: 1px 10px;border-radius: 10px;">${v.sales}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;   
                    $('.card-all').append(ok);
                });
            }
        }
    });
}

function getCust() {
    var customers = '';

    $.ajax({
      type: "GET",
      url: "../Customers/getCustomer",
      dataType: "json",
      success: function (r) {
        customers += '<option>-- Pilih Customer --</option>';
        r.forEach(k => {
          customers += '<option value="'+k.id+'">'+k.customer+'</option>';
        });
        $('#customers').html(customers);
      }
    });

    $('#customers').select2({
        dropdownParent: $("#addCustomer"),
    });

  }

  function getCustEnd() {
    var endcust = '';

    $.ajax({
      type: "GET",
      url: "../Customers/getEndCustomer",
      dataType: "json",
      success: function (r) {
        endcust += '<option>-- Pilih End Customer --</option>';
        r.forEach(k => {
          endcust += '<option value="'+k.id+'">'+k.custend+'</option>';
        });
        $('#endcust').html(endcust);
      }
    });

    $('#endcust').select2({
        dropdownParent: $("#addCustomer"),
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

$('#add_projek_existing').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "./add_project_existing",
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
                dtcuse();
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
                  $('#add_projek_existing')[0].reset();
                  $('.loading').hide();
            }else{
                alert('Failed to add data');
            }
            $('#addCustomer').modal('hide');
            $('.loading').hide();
            // $('.modal-backdrop').hide();
        },
        error: function () {
          Swal.fire(
            'Gagal',
            'Terjadi gangguan sistem, mohon hubungi developer',
            'error'
          );
          $('.loading').hide();
        }
    });
});

var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  var ok = this.value.replace(/[^0-9\.]+/g, '');
  var nominal = ok.replaceAll('.','');
  $('#nominal').val(nominal);
  rupiah.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
}
