$(document).ready(function () {
    showtable();
    editModal();
});

function showtable() {
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
          "url": 'dt_Projek',
          "type": "POST",
          "data": {
              'status' : ''
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,5],
          "orderable": false
        }]
      });
}

function getPK(id){
    $.ajax({
      type: "GET",
      url: "getPM",
      data: {id : id },
      dataType: "json",
      success: function (r) { 
        rx = r.data;
        //   Edit
        $('#pk_id').val(rx.id);
        $('#pm_id').val(rx.pm);
        $('#service').val(rx.service);
        $('#qty').val(rx.qty);
        $('#po').html(rx.po);
        $('#pp').html(rx.pp);
        $('#status').val(rx.status);
        $('#remark').val(rx.remarks);

        $('#g_service').text(rx.service);
        $('#g_qty').text(rx.qty);
        $('#g_po').html(rx.po);
        $('#g_pp').html(rx.pp);
        $('#g_status').text(rx.status);
        $('#g_remark').text(rx.remarks);

        getPMstatus(rx.pm);
        getPm(rx.pm_id,'#pm');
      }
    });
}

function getPMstatus(pm_id='') { 
    $('#tml').html('');
    $.ajax({
        type: "GET",
        url: "getPMStatus?pm_id="+pm_id,
        dataType: "json",
        success: function (r) {
               r.forEach(e => {
                  $('#tml').append(`<li class="timeline-event">
                  <label class="timeline-event-icon"></label>
                  <div class="timeline-event-copy">
                      <p class="timeline-event-thumbnail" id="ctdDate">${e.ctdDate}</p>
                      <h4><strong id="g_status">${e.status}</strong></h4>
                  </div>
              </li>`);
               });
        }
    });
}

function getPm(id='',d='') { 
    $(d).html('<option value="">-- Pilih PM --</option>');
    $.ajax({
        type: "GET",
        url: "../karyawan/getKaryawanLevel?level=10",
        dataType: "json",
        success: function (r) {
               r.forEach(e => {
                   if(id == e.id) $(d).append('<option value="'+e.id+'" selected>'+e.nama+'</option>');
                   if(id != e.id) $(d).append('<option value="'+e.id+'">'+e.nama+'</option>');
               });
        }
    });
 }

 function editModal() {
    $('#editPM').submit(function (e) { 
      e.preventDefault();
      var dt = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "upPM",
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
            $('#editModal').modal('hide');
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