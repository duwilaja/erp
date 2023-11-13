$(document).ready(function() {
    // showtable();
    $('select[name="barang"]').select2();
});

function get_detail(id='',jml='') { 
    let no = 1;
    $('#list_sn').html('');
    $('#txt_jml').text('('+jml+')');
    for (let i = 0; i < jml; i++) {
       var n = no++;
       $('#list_sn').append(`<tr id="sn${n}">
       <td>${n}</td>
        <td><select name="sn[]" class="form-control form-control-sm"></select></td>
       </tr>`);        
    }
}

function showtable() {
	//console.log('list');
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
          "url": 'dt_req_list',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
        //   "targets": [2],
          "orderable": false
        }]
      });
  }
