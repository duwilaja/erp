$(document).ready(function() {
    showtable();
    addTask();
    formEditDaily();
    form_cari();
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
            "url": 'dtListTask',
            "type": "POST",
            "data" : {
                "karyawan" : $('#karyawan').val(),
                "tanggal" : $('#tanggal').val(),
            }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function getDaily(id) {
    var g = httpGet('getDaily/'+id).data;
    $('#e_id').val(g.id);
    $('#e_tgl').val(g.tanggal);
    $('#e_task').val(g.pekerjaan);
}

function addTask() { 
    $('#formAddTask').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: url+"DailyTask/inDailyTask",
            data:$(this).serialize(),
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                $('textarea[name="task"]').val('');
                
                showtable();
                $("#exampleModal").modal('hide');
            }
        });
    });
}

function formEditDaily() { 
    $('#formEditDaily').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: 'upDaily',
            data: $(this).serialize(),
            dataType: "json",
            success: function (r) {
                var info = 'error';
                if (r.status == 1) {
                    info = 'success';
                }
                Swal.fire({
                    icon: info,
                    title: info,
                    text: r.msg,
                });
                
                showtable();
                $('#modalEdit').modal('hide');
            }
        });
    });
}

function form_cari() { 
    $('#form_cari').submit(function (e) { 
        e.preventDefault();
        showtable();
    });
 }
