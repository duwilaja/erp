$(document).ready(function() {
  showtable();
  show_all_device();
  show_all_device_client();

  // Daftar Subimt Add_Stock
  add_stock();
});

function add_stock() {
  $('#form_add_stock').submit(function (e) { 
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "add_stock",
      data: $(this).serialize(),
      dataType: "json",
      success: function (r) {
        if(r.status){
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: r.msg,
          })
          show_all_device();
          $('#modal_add_device').modal('hide');
          $('#form_add_stock')[0].reset();
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: r.msg,
          })
        }
      }
    });
  });
}

function showtable() {
//console.log('list');
  $('#tabel').DataTable({
      // Processing indicator
      "bAutoWidth": false,
      "destroy": true,
      "searching": true,
      "responsive": true,
      "processing": true,
      // DataTables server-side processing mode
      "serverSide": true,
      // "scrollX": true,
      // Initial no order.
      "order": [],
      // Load data from an Ajax source
      "ajax": {
        "url": '../SCM/dt_stock_device_opr',
        "type": "POST",
        'data' : {
          'allocation' : 'operation',
          'type' : 'group'
        }
      },
      //Set column definition initialisation properties
      "columnDefs": [{
        "targets": [1,2,3,4,5],
        "orderable": false
      }]
    });
}

function show_all_device() {
  //console.log('list');
    $('#tabel_device').DataTable({
        // Processing indicator
        "bAutoWidth": false,
        "destroy": true,
        "searching": true,
        "responsive": true,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // "scrollX": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
          "url": '../SCM/dt_stock_device_opr',
          "type": "POST",
          'data' : {
            'allocation' : 'operation',
            'type' : 'all'
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [1,2,3],
          "orderable": false
        }]
      });
  }

  function show_all_device_client() {
    //console.log('list');
      $('#tabel_device_client').DataTable({
          // Processing indicator
          "bAutoWidth": false,
          "destroy": true,
          "searching": true,
          "responsive": true,
          "processing": true,
          // DataTables server-side processing mode
          "serverSide": true,
          // "scrollX": true,
          // Initial no order.
          "order": [],
          // Load data from an Ajax source
          "ajax": {
            "url": '../SCM/dt_stock_device_opr',
            "type": "POST",
            'data' : {
              'allocation' : 'client',
              'type' : 'client'
            }
          },
          //Set column definition initialisation properties
          "columnDefs": [{
            "targets": [1,2,3],
            "orderable": false
          }]
        });
    }
