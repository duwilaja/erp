$(document).ready(function () {
    $('#karyawan').select2({
        dropdownParent: $("#modalAddAnggota")
    });
    getCost('','customer');
    getAnggota();
    showAnggota();
});

$('#formAddAnggota').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "addAnggota",
        data: $(this).serialize(),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
               
                document.getElementById("formAddAnggota").reset();
                showAnggota();
                getAnggota();
                $('#modalAddAnggota').modal('hide');
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

function setKaryawan(id) { 
    $('#karyawan_ids').val(id);
 }

$('#formEditAnggota').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "editAnggota",
        data: $(this).serialize(),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
               
                document.getElementById("formEditAnggota").reset();
                $('#modalEditAnggota').modal('hide');
                showAnggota();
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

function getAnggota(id='') { 
    $('#karyawan').html('');
    $.ajax({
        type: "GET",
        url: "getAnggota?id="+id,
        dataType: "json",
        success: function (r) {
            if (r.status) {
                if (id != '') {
                    
                    $('#karyawan_id').val(r.data.id);
                    $('#e_karyawan').val(r.data.nama);
                    $('#e_group').val(r.data.group);

                    getCost('','e_customer');
                    setTimeout(() => {
                        $('select[name="e_customer"]').val(r.data.alokasi_cust);
                    }, 300);
                }else{
                    r.data.forEach(v => {
                        $('#karyawan').append('<option value="'+v.id+'|'+v.karyawan_id+'">'+v.nama+' - '+v.nma_jabatan+'</option>');
                    });
                }
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

function deAnggota(id='') { 
    if (id != '') {
        var r = confirm("Apakah anda yakin ingin menghapus data ini ?");
        if (r == true) {
            txt = "You pressed OK!";
            $.ajax({
                type: "POST",
                url: "deAnggota",
                data: {id : id},
                dataType: "json",
                success: function (r) {
                    if (r.status) {
                        Swal.fire(
                            'Berhasil',
                            r.msg,
                            'success'
                          );
                          showAnggota();
                     }else{
                         Swal.fire(
                             'Gagal',
                             r.msg,
                             'error'
                           );
                     }
                }
            });
        } else {
          txt = "You pressed Cancel!";
        }
    }
 }

function getCost(id='',name='') { 
    if(name == '') name = 'customer';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'../customers/getEndCustomer/',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Pilih Penempatan Customer --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.custend+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.custend+"</option>");
                }
            });
        }
    });
}

 function showAnggota() {
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
            "url": 'dtAnggota',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}