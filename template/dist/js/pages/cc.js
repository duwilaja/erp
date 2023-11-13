$(document).ready(function() {
    $('#ctr').select2({
        tags : true,
        placeholder: 'Please Select Customer'
    });

    showtable();
    showtableSqa();
    showtableEos();
    
    formEditPic();
    formSqa();
    formPreventiveEos();
    
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
            "url": url+'cc/dtPic/',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function showtableSqa() {
    $('#tabelSqa').DataTable({
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
            "url": url+'cc/dtSqa/',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function showtableEos() {
    $('#tabelEos').DataTable({
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
            "url": url+'cc/dtPreventiveEos/',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function editPic(id) {
    $.ajax({
        type: "get",
        url: url+'cc/getCustomer/'+id,
        dataType: "json",
        success: function (r) {
            $('input[name="id"]').val(r.id);
            $('input[name="pic"]').val(r.pic);
            $('input[name="kontak_pic"]').val(r.kontak_pic);
            $('input[name="lokasi"]').val(r.lokasi);
            $('input[name="customer"]').val(r.nama_customer);
            $('textarea[name="alamat"]').val(r.alamat);
        }
    });
}

function formEditPic() { 
    $('#formEditPic').submit(function (e) { 
        var id = $('input[name="id"]').val();
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'cc/upCustomerPic/'+id,
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtable();
                $('#exampleModal').model('hide');
                
            }
        });
    });
}

function formSqa() { 
    $('#formSqa').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'cc/inSqa/',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtableSqa();
                
            }
        });
    });
}

function delSqa(id='') { 
    
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "GET",
            url: url+"cc/deSqa/"+id,
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtableSqa();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}

function formPreventiveEos() { 
    $('#formPreventiveEos').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'cc/inPreventiveEos',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtableEos();
                
            }
        });
    });
}

function dePreventiveEos(id='') { 
    
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "GET",
            url: url+"cc/dePreventiveEos/"+id,
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtableEos();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}

