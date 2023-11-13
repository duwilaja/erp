$(document).ready(function () {
	dtSerdev();
	dtDevelopment();
	dataSerdev();
	dataAll();
    addTimeline();
    file_timeline();
    addDRM();
    getDRM();
    getFileDRM();
    dtHistori();
});

function dtSerdev() {
    $('#tabel_serdev').DataTable({
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
          "url": '../dt_serdev',
          "type": "POST",
          "data": {
              'pk_id' : $('#idUpdatePK').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,2,3],
          "orderable": false
        }]
      });
}

function dtDevelopment() {
    $('#tabel_development').DataTable({
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
          "url": '../dt_development',
          "type": "POST",
          "data": {
              'id' : $('#idUpdatePK').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,3],
          "orderable": false
        }]
      });
}

function dataSerdev() {
	var id = $('#idUpdatePK').val()
	$.ajax({
        type: "POST",
        url: "../sdv_total",
		data: {pk_id:id},
        dataType: "json",
        success: function (v) {
            $('#st_task').html(v.task);
            $('#st_complete').html(v.complete);
            $('#st_progress').html(v.progress);
            $('#st_pending').html(v.pending);
            $('#st_persentase').html(v.persentase+'%');
        }
    });
}

function dataAll() {
	var idpk = $('#idUpdatePK').val()
	var iddiv = $('#idDivision').val()
	$.ajax({
        type: "POST",
        url: "../total_all",
		data: {pk_id:idpk,devision:iddiv},
        dataType: "json",
        success: function (v) {
            $('#task').html(v.task);
            $('#complete').html(v.complete);
            $('#progress').html(v.progress);
            $('#pending').html(v.pending);
			$('#persentase').html(v.persentase+'%');
        }
    });
}


$(document).on('change','#status', function() {
	var id = $('#idUpdate').val();
    var idpk = $('#idUpdatePK').val();
		var status = $('#status').val();
		$.ajax({
			type: "POST",
			url: '../setStatusPm',
			data : {status : status, id : id,pk_id:idpk},
			dataType: "json",
			success: function (r) {
				if (r.status) {
					Swal.fire(
						'Berhasil',
						r.msg,
						'success'
					);
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

$(document).on('change','#devision', function() {
	var id = $('#idUpdatePK').val();
		var devision = $('#devision').val();
		$.ajax({
			type: "POST",
			url: '../setDevisionPm',
			data : {devision : devision, id : id},
			dataType: "json",
			success: function (r) {
				if (r.status) {
					Swal.fire(
						'Berhasil',
						r.msg,
						'success'
					);
					setTimeout(() => {
						location.reload()
					}, 3000);
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

function modal_edit()
{
    $('#modal_edit').modal('show'); // show bootstrap modal
}

function modal_upload_timeline()
{
    $('#addTimeline')[0].reset(); // reset form on modals
    $('#modal_upload_timeline').modal('show'); // show bootstrap modal

    $('#btnTimeline').text('Upload'); //change button text
    $('#btnTimeline').attr('disabled',false); //set button disable 
}

function addTimeline() { 
    var link = '../addTimeline'; 
    $('#addTimeline').submit(function (e) { 
         $('#btnTimeline').text('Mengupload...'); //change button text
         $('#btnTimeline').attr('disabled',true); //set button disable 
         e.preventDefault();
         $.ajax({
            type: "POST",
            url:link,
            secureuri: false,
            contentType: false,
            cache: false,
            processData:false,
            data: new FormData(this),
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    $('#modal_upload_timeline').modal('hide');
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                      );
                    file_timeline();
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
   
 }

 function file_timeline() {
    $('#f_timeline').html('');
    var pk_id = $('#idUpdatePK').val();
    $.ajax({
        type: "GET",
        url: "../getFilePM",
		data: {get_where:"pk_id",where:pk_id},
        dataType: "json",
        success: function (v) {
            let extension = v[0].file.split('.').pop();
                if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
                    extensionn = 'image'
                }else if(extension == 'docx'){
                    extensionn =  'word'
                }else if(extension == 'xlsx') {
                    extensionn =  'excel'
                }else if(extension == 'pdf') {
                    extensionn =  'pdf'
                }else{
                    extensionn = 'alt'
                }
            $('#f_timeline').append(`
                <a href="../../data/projek/file/${v[0].file}">
                    <i class="fas fa-file-${extensionn}" style="font-size: 100px;"></i> <br>
                    ${v[0].nama_file}
                </a>
            `);
        }
    });
 }
 
 function addDRM() { 
    var link = '../addDRM'; 
    $('#form_drm').submit(function (e) { 
         $('#btnDRM').text('Mengupload...'); //change button text
         $('#btnDRM').attr('disabled',true); //set button disable 
         e.preventDefault();
         $.ajax({
            type: "POST",
            url:link,
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
                      $('#btnDRM').html('<i class="fa fa-upload"></i> Upload'); //change button text
                      $('#btnDRM').attr('disabled',false); //set button disable 
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
   
 }

 function getDRM() {
    var id = $('#idUpdatePK').val();
    $.ajax({
        type: "POST",
        url: "../getDRM",
		data: {pk_id:id},
        dataType: "json",
        success: function (v) {
            $('#catatan').text(v.catatan)
        }
    });
 }

 function getFileDRM() {
    $('#bfile').html('');
    var id = $('#idUpdatePK').val();
    $.ajax({
        type: "GET",
        url: "../getFilePM",
		data: {get_where:'pk_id',where:id,status:1},
        dataType: "json",
        success: function (l) {
            let no = 0
            l.forEach(v => {
                let n = no++;
                $('#bfile').append(`
                <tr id="tr${n}">
                    <td><input type="text" class="form-control" name="" value="${v.nama_file}" disabled></td>
                    <td><input type="text" class="form-control file"" value="${v.file}" disabled></td>
                    <td><select name="" class="form-control" disabled>
                        <option value="BAI" ${v.jenis == "BAI" ? 'selected' : ''}>BAI</option>
                        <option value="BST" ${v.jenis == "BST" ? 'selected' : ''}>BST</option>
                        </select>
                    </td>
                    <td class="text-center" ><a href="javascript:void(0)" class="btn btn-danger"><i class="fas fa-trash text-white" onClick="delete_file(${v.id})"></i></a></td>
                </tr>
                `)
            });
        }
    });
 }

 function delete_file(id)
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
            var link = '../set_nonaktif_fdrm/'+id; 
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
                        getFileDRM();
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

 function dtHistori() {
    $('#tabel_histori').DataTable({
        // Processing indicator
        "bAutoWidth": false,
        "destroy": true,
        "searching": true,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // "scrollX": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
          "url": '../dt_pk_histori',
          "type": "POST",
          "data": {
              'pk_id' : $('#idUpdatePK').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,2,3],
          "orderable": false
        }]
      });
}