$(document).ready(function() {
    showtable();
    
    $('select[name="karyawan[]"]').select2({
        placeholder: 'Pilih Karyawan'
    });
    
    
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
            "url": url+'training/dt',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function formStatusPelatihan(v) { 
    $.ajax({
        type: "post",
        url: url+'training/upStatusTraining/',
        data: {
            'idp' : $('#idp').val(),
            'status' : v,
        },
        dataType: "json",
        success: function (r) {
            if (r.status == 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                })
                
                showtable();
                $('#exampleModal').modal('hide');
            }
        }
    });
    
}

function getStatusPelatihan(id) {
    $.ajax({
        type: "get",
        url: url+"training/getTrainingId/"+id,
        dataType: "json",
        success: function (r) {
            var status = '';
            status += " <option value='1' "+setSelected('1',r.status)+">Pending</option>";
            status += "<option value='2' "+setSelected('2',r.status)+">Diterima</option>";
            status += "<option value='3' "+setSelected('3',r.status)+">Ditolak</option>";
            status += "<option value='4' "+setSelected('4',r.status)+">Sedang Berjalan</option>";
            status += "<option value='5' "+setSelected('5',r.status)+">Lulus</option>";
            status += "<option value='6' "+setSelected('6',r.status)+">Tidak Lulus</option>";
            $('select[name="status"]').html(status);
            $('#idp').val(r.id);
        }
    });
}