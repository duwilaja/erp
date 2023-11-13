$(document).ready(function() {
    showtablePelamar();
} );

function showtablePelamar(s='') {
    $('#tabel_pelamar').DataTable({
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
          "url": url+'hcm/dtPelamar/'+$('input[name="id"]').val(),
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }

  function ubahPelamar() {
    $.ajax({
        type: "post",
        url: url+"hcm/upPelamarStatus/"+$('input[name="idp"]').val()+"/1",
        data: {
            'status' : $('select[name="status"]').val(),
            'id' : $('input[name="idp"]').val()
        },
        dataType: "json",
        success: function (r) {
            if (r.status == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                })

                showtablePelamar();
                $('#exampleModal').modal('hide');
            }
        }
    });
 }

 function getStatusPelamar(id) {
    $.ajax({
        type: "get",
        url: url+"hcm/getPelamar/"+id,
        dataType: "json",
        success: function (r) {
           var status = '';
           status += " <option value='1' "+setSelected('1',r.status)+">Pending</option>";
           status += "<option value='2' "+setSelected('2',r.status)+">Diterima</option>";
           status += "<option value='3' "+setSelected('3',r.status)+">Wawancara</option>";
           status += "<option value='4' "+setSelected('4',r.status)+">Blacklist</option>";
           status += "<option value='5' "+setSelected('5',r.status)+">Ditolak</option>";
           $('select[name="status"]').html(status);
           $('#idp').val(r.id);
        }
    });
 }