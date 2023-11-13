
let p = $('.projek_id').text();
let s = '';
var no = 0;
var countTgh = [];
let nilai = 0;
var idx = $('input[name="id"]').val();

$(document).ready(function () {
    showtable();
    formEdtTagihan();
});

function addTgh() { 
  no += 1;
  countTgh.push(no);
  nilai = countTgh.length;
  $('input[name="nilai"]').val(nilai);

  $('#tgh_list').append(`<tr id="t${no}">
  <td><input type="month" class="form-control" name="bulan[]"></td>
  <td><input type="number" class="form-control" name="tagihan[]"></td>
  <td><input type="button" class="btn btn-danger" onclick="hapusTgh('${'#t'+no}')" value="Hapus"></td>
 </tr>`);
}

function hapusTgh(v) { 
  $(v).remove();
  countTgh.pop();
  nilai = countTgh.length;
  $('input[name="nilai"]').val(nilai);
}

function getDetailProjek(){
    $.ajax({
      type: "GET",
      url: "../getDetailProjekTgh/",
      data: {id : idx },
      dataType: "json",
      success: function (r) { 
        $('input[name="no_kontrak"]').val(r.no_kontrak);
        $('input[name="masa_kontrak"]').val(r.masa_kontrak);
        $('input[name="total_kon_ppn"]').val(r.nominal);
        $('input[name="start_date"]').val(r.start_date);
        $('input[name="end_date"]').val(r.end_date);
      }
    });
}

function formEdtTagihan() {
  $('#formEdtTagihan').submit(function (e) { 
    e.preventDefault();

    var dt = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "../upDetailProjekTgh",
      data: dt,
      dataType: "json",
      success: function (r) {
        if (r.status) {
          Swal.fire(
              'Berhasil',
              r.msg,
              'success'
            );
          showtable();
          $('#editTagihan').modal('hide');
          $('#tgh_list').html('');
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
}

function deTghList(id) {
  var r = confirm("Apakah anda yakin ingin menghapus data ini ?");
  if (r == true) {
    txt = "You pressed OK!";
    console.log(txt);
      $.ajax({
          type: "POST",
          url: "../rmTghList",
          data : {
              'id' : id,
          },
          dataType: "json",
          success: function (r) {
              if (r.status) {
                  Swal.fire(
                      'Berhasil',
                      'Hapus Data',
                      'success'
                    );

                  showtable();
              }else{
                  Swal.fire(
                      'Gagal',
                      'Hapus Data',
                      'error'
                    );
              }
          }
      });
  } else {
    txt = "You pressed Cancel!";
  }
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
          "url": '../dtTghList',
          "type": "POST",
          "data": {
              'projek_id' : p,
              'status' : s
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [5],
          "orderable": false
        }]
      });
  }
