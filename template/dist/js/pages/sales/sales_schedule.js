$(document).ready(function() {
    showtable();
    formAddSchedule();
    formEditSchedule();
} );

function showtable() {
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
          "url": 'dtSalesSchedule',
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
    var http = httpGet('getSchedule?id='+id).data;

    $('input[name="e_id"]').val(id);
    $('input[name="e_title"]').val(http.title);
    $('input[name="e_date"]').val(http.date);
    $('input[name="e_location"]').val(http.location);
    $('textarea[name="e_description"]').text(http.description);
}

  function formAddSchedule() { 

    $('#formAddSchedule').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: 'inSchedule',
            data: $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if (r.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })

                    showtable();
                    $('#formAddSchedule')[0].reset();
                    $('#new_schedule').modal('hide');
                }
            }
        });
    });

  }

  function formEditSchedule() { 

    $('#formEditSchedule').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: 'upSchedule',
            data: $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if (r.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })

                    showtable();
                    $('#editSalesSchedule').modal('hide');
                }
            }
        });
    });

  }

  function deSalesSchedule(id) { 

    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "GET",
            url: 'deSchedule?id='+id,
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtable();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }

  }