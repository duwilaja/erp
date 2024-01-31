
$(document).ready(function () {
    showtable();
});

function mappicker(lat,lng){
	window.open("map?lat="+$(lat).val()+"&lng="+$(lng).val(),"MapWindow","width=830,height=500,location=no").focus();
}

function det(id='') { 
    $.ajax({
        type: "get",
        url:'get/'+id,
        dataType: "json",
        success: function (r) {
			$.each(r, function(key,val){
				$('input[name="'+key+'"]').val(val);
				$('select[name="'+key+'"]').val(val);
			});
        }
    });
}
function de(id='') {
	if(confirm('Anda ingin menghapus data ini?')){	
    $.ajax({
        type: "get",
        url:'del/'+id,
        dataType: "json",
        success: function (r) {
			if (r.status) {
                Swal.fire(
                  'Berhasil',
                  r.msg,
                  'success'
                );
                showtable();
                $('#exampleForm')[0].reset();
                $('#exampleModal').modal('hide');
            }else{
                Swal.fire(
                  'Gagal',
                  r.msg,
                  'error'
                );
            }
        }
    });
	}
}

function nyu(){
	$("#exampleForm")[0].reset();
	$('input[name="id"]').val(0);
}

$('#exampleForm').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "sv",
        secureuri: false,
        contentType: false,
        cache: false,
        processData:false,
        data: new FormData(this),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                Swal.fire(
                  'Berhasil',
                  r.msg,
                  'success'
                );
                showtable();
                $('#exampleForm')[0].reset();
                $('#exampleModal').modal('hide');
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
            "url": 'dt',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            // "targets": [0],
            "orderable": false
        }]
    });
}