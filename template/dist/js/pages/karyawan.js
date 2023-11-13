$(document).ready(function() {
    showtable();
    get_jabatan();
    $('select[name="f_jabatan"]').select2();
} );

function showtable(s='') {
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
          "url": url+'karyawan/dt/'+s,
          "type": "POST",
          "data" : {
            'jabatan' : $('#f_jabatan').val() 
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }

  function get_jabatan(id='',name='') { 
    if(name == '') name = 'f_jabatan';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'../Hcm/get_jabatan',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Pilih Jabatan --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.nma_jabatan+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.nma_jabatan+"</option>");
                }
            });
        }
    });
}

$('#filter_karyawan').submit(function (e) { 
  e.preventDefault();
  showtable();
});

function reset_form() { 
    $('#filter_karyawan')[0].reset();
    setTimeout(() => {
      showtable();
    }, 300);
  }


  function checkListEmployes(v='',b=''){
    showtable(v);
    $('#txtLE').text(' - '+b);
  }