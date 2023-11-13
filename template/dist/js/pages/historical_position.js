$(document).ready(function() {
    showtable();

    // $('select[name="jabatan"]').select2({
    //     placeholder: 'Please Select Position'
    //   });

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
          "url": url+'karyawan/dtJabatan',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }

  function cekJabatanKaryawan(id) { 
    $('.ok').html('');
    $('#jabatan').html('');

    $.ajax({
        type: "get",
        url: url+"karyawan/getJabatanKaryawan/"+id,
        dataType: "json",
        success: function (r) {
            var jabatan = '';
            $('.ok').html('<input type="hidden" id="idk" value="'+r.karyawan.id+'">');
            $.each(r.jabatan, function (k, v) { 
                jabatan += '<option value="'+v.id+'" '+setSelected(v.id,r.karyawan.idj)+'>'+v.nma_jabatan+'</option>';
            });
            $('#jabatan').html(jabatan);
        }
    });
   }

   function addJabatan() { 

        $('#addJabatan').submit(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "post",
                url: url+'hcm/inHjabatan',
                data: $(this).serialize(),
                dataType: "json",
                success: function (r) {
                    if (r.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: r.msg,
                        })
        
                        window.location.assign = url+"hcm/historical_detail";
                    }
                }
            });
        });

   }