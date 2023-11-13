$(document).ready(function () {
    $('select[name="induk_jabatan"]').select2({
        dropdownParent: $("#modal_form_jabatan")
    });

    $('select[name="f_induk_jabatan"]').select2();
    
    get_induk_jabatan();
    get_induk_jabatan('','f_induk_jabatan');
    get_grp_jabatan();
    showData();
});

$('#filter_jabatan').submit(function (e) { 
    e.preventDefault();
    showData();
  });

function reset_form() { 
    $('#filter_jabatan')[0].reset();
    setTimeout(() => {
      showData();
    }, 300);
  }

$('#form_jabatan').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "in_jabatan",
        data: $(this).serialize(),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
               
                document.getElementById("form_jabatan").reset();
                showData();
                $('#modal_form_jabatan').modal('hide');
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

$('#e_form_jabatan').submit(function (e) { 
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "up_jabatan",
        data: $(this).serialize(),
        dataType: "json",
        success: function (r) {
            if (r.status) {
                
                Swal.fire(
                    'Berhasil',
                    r.msg,
                    'success'
                  );
               
                document.getElementById("e_form_jabatan").reset();
                $('#modal_form_edt_jabatan').modal('hide');
                showData();
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

function edit_form_jabatan(id='') { 
    $.ajax({
        type: "GET",
        url: "get_jabatan_id",
        data : {
            'id' : id
        },
        dataType: "json",
        success: function (r) {
            get_induk_jabatan(r.parent_id,'e_induk_jabatan');
            get_grp_jabatan(r.grp_jabatan_id,'e_group');
            $('input[name="e_jabatan"]').val(r.nma_jabatan);
            $('select[name="e_leader"]').val(r.leader);
            $('input[name="e_id"]').val(r.id);
        }
    });
}


function get_grp_jabatan(id='',name='') { 
    if(name == '') name = 'group';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'get_jabatan_grp',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Pilih Group --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.nama_group+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.nama_group+"</option>");
                }
            });
        }
    });
}

function get_induk_jabatan(id='',name='') { 
    if(name == '') name = 'induk_jabatan';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'get_jabatan',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Pilih Induk Jabatan --</option>');
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

 function showData() {
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
            "url": 'dt_jabatan',
            "type": "POST",
            "data" : {
                'leader' : $('#f_leader').val(),
                'parent' : $('#f_induk_jabatan').val(),
            }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function hapus_jabatan(id)
 {
    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {         
            var link = 'del_jabatan/'+id; 
            $.ajax({
                type: "POST",
                url: link,
                data : $(this).serialize(),
                dataType: "json",
                success: function (r) {
                    if (r.status) {
                        Swal.fire(
                            'Berhasil',
                            r.msg,
                            'success'
                        );
                        showData();
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
      })
 }