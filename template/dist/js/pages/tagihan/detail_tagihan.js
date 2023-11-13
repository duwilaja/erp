var txtRFile1 = [];
var txtRFile2 = [];

var p = $('input[name="projek_id"]').val();
var tlid = $('input[name="tgh_list_id"]').val();


$(document).ready(function () {
    list_doc();
    dtHistory();
    formUbahStatus();
});

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
        url: "../../uploadDok",
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
                Swal.fire(
                    'Berhasil',
                    'Upload Dokumen',
                    'success'
                  );

                list_doc();
                dtHistory();
            }else{
                Swal.fire(
                    'Gagal',
                    'Upload Dokumen',
                    'error'
                  );
            }
            $('#uploadmodal').modal().hide();
            $('.loading').hide();
            $('.modal-backdrop').hide();

            txtRFile1.forEach(v => {
                $(v).text('...');
            });
            
            txtRFile2.forEach(v => {
                $(v).val('');
            });
        },
        done:function () {
          $('.loading').hide();
        }
    });
});

function list_doc() { 
    $('#list_doc').html('');
    $.ajax({
        type: "GET",
        url: "../../apiGetDokProjek/"+p+"/"+tlid,
        dataType: "json",
        success: function (r) {
            if (r.status) {
                $('#tdoc').hide();
                r.data.forEach(v => {
                    let ok = `
                    <li class="chat-item pr-1 mt-3">
                    <div class="dropdown">
                    <a href="javascript:;" class="d-flex align-items-center" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <figure class="mb-0 mr-2">
                        <i class=" fa fa-file  rounded-circle sfile" alt="file"></i>
                        <div class="status offline"></div>
                      </figure>
                      <div class="d-flex justify-content-between flex-grow border-bottom w-100">
                        <div>
                          <p class="text-body">${v.jl}</p>
                          <p class="text-muted text-sm">${v.nama}</p>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                          <p class="text-muted text-sm mb-1">${v.ctdDate}</p>
                        </div>
                      </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="padding-top:0px;">
                        <span class="badge badge-default" style="font-size:12px;padding:6px;">${v.file}</span>
                        <a class="dropdown-item" href="${url+'data/projek/'+p+'/'+tlid+'/'+v.jl+'/'+v.file}">Download</a>
                        <a class="dropdown-item" href="#" onclick="removeFile('${v.jl}','${v.file}')">Hapus</a>
                    </div>
                    </div>
  
                </li>
                    `;

                    $('#list_doc').append(ok);
                });
            }
        }
    });
 }

 function removeFile(jl,file) { 
    var r = confirm("Apakah anda yakin ingin menghapus file ini ?");
    if (r == true) {
      txt = "You pressed OK!";
      console.log(txt);
        $.ajax({
            type: "POST",
            url: "../../rmFile",
            data : {
                'p' : p,
                'tlid' : tlid,
                'jl' : jl,
                'file' : file
            },
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    Swal.fire(
                        'Berhasil',
                        'Hapus Dokumen '+jl,
                        'success'
                      );

                    list_doc();
                    dtHistory();
                }else{
                    Swal.fire(
                        'Gagal',
                        'Hapus Dokumen '+jl,
                        'error'
                      );
                }
            }
        });
    } else {
      txt = "You pressed Cancel!";
    }
  }

// Set Uabh Status

function setUbahStatus() { 
    setTimeout(() => {
    
    var tb = $('#tterbayar').val();
    var tgls = $('#ttglsubmit').val();
    var th = $('#tterhutang').val();
    var k = $('#kett').val();

    $('#terbayar').val(tb);
    $('#tglsubmit').val(tgls);
    $('#terhutang').val(th);
    $('#ket').text(k);
    }, 200);

 }

//   Form Ubah Status

function formUbahStatus() { 
    $('#formUbahStatus').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../../upUbahStatus",
            data: $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    Swal.fire(
                        'Berhasil',
                        'Ubah Status',
                        'success'
                      );
                    
                    $('#ttglsubmit').val(r.data.ttglsubmit);
                    $('#tterbayar').val(r.data.tterbayar);
                    $('#tterhutang').val(r.data.tterhutang);
                    $('#kett').val(r.data.ket);

                    $('#txtTglsubmit').text(r.data.tglsubmit);
                    $('#txtTerbayar').text(r.data.terbayar);
                    $('#txtTerhutang').text(r.data.terhutang);
                    $('#txtStatus').text(r.data.status);
                    $('#txtKeterangan').text(r.data.ket);
                    dtHistory();
                }else{
                    Swal.fire(
                        'Gagal',
                        'Ubah Status',
                        'error'
                      );
                }
            }
        });
    });
   
 }

//   Datatble History
  function dtHistory() {
	//console.log('list');
    $('#table').DataTable({
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
          "url": '../../dtProjekTghH',
          "type": "POST",
          'data' : {
              'p' : p,
              'tlid' : tlid
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "orderable": false
        }]
      });
  }
 
// Form Upload Data

var ld = $('#list_doc_file');
var no = 1;
$('#tambah').click(function (e) { 
  e.preventDefault();
  let n = no++;
  ld.append(`<tr id="no${n}">
      <td><input type="text" name="namaDoc@${n}" class="form-control form-control-sm"></td>
      <td><input type="file" name="doc@${n}" class="form-control form-control-sm"></td>
      <td><button type="button" onclick="hapusDoc('${'#no'+n}')" class="btn btn-danger btn-sm w-100"><i class="fa fa-trash"></i></button></td>
  </tr>`);
});

function hapusDoc(n) { 
  $(n).remove();
}

$('#uploadx').click(function (e) { 
  e.preventDefault();
  ld.html('');
});

$('#terbayar').change(function (e) { 
  e.preventDefault();
  var tt = $('#ttotal');
  var th = $('#terhutang');

  th.val(0);
  var total = tt.val() - $(this).val();
  if (total > 0) th.val(total);

});
