$(document).ready(function() {
    upMenu();
    dt_pm();
});

function getStatusPrev(id) { 
    $('#e_id').val(id);
}

function get_pm(id) { 
   $.get("get_pm?id="+id,
       function (data, textStatus, jqXHR) {
        $('#e_id').val(data.id);
        $('#e_result').val(data.hasil);
        $('#e_date').val(data.tanggal);
        $('#e_desc').val(data.desc);
        $('#e_status').val(data.status);
       },
       "json"
   );
 }

 function upMenu(){
    $('#form-up').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:url+'/oprations/upPm/',
            data : {
                'id' : $('#e_id').val(),
                'hasil' : $('#e_result').val(),
                'tanggal' : $('#e_date').val(),
                'description' : $('#e_desc').val(),
                'status' : $('#e_status').val()
            },
            dataType: "json",
            success: function (res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Success update status',
                })
                dt_pm();
            }
        });
    
    });
    
}

function dt_pm() {
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
            "url": './dt_pm',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

 var dat = [];
 function setPrev(id = ''){
    dat = httpGet(url+"oprations/setpm/"+id)[0];
     
    document.getElementById('id').value = dat.id;
    document.getElementById('status').value = dat.status;
    document.getElementById('date').value = dat.tanggal;
    document.getElementById('result').value = dat.hasil;
    document.getElementById('desc').value = dat.description;
    
 }
