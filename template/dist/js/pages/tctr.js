var x = 1;

$(document).ready(function() {
    $('#ctr').select2({
        placeholder: 'Please Select Customers'
      });

      add_tcustomer();
      showtable();
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
          "url": url+'oprations/dttctr',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }

function hapus(id=''){
	$('.ok'+id).remove(); x--;
}

function add(){
	if(x < 20){ //max input box allowed
        x++; //text box increment
        $('.ts').after(' <tr class="ok'+x+'"> <td><input type="text" name="device[]" class="form-control"></td> <td><input type="text" name="ip[]" class="form-control"></td> <td><input type="text" name="access[]" class="form-control"></td> <td><input type="text" name="port[]" class="form-control"></td> <td><input type="text" name="user[]" class="form-control"></td> <td><input type="text" name="password[]" class="form-control"></td> <td><input type="text" name="enable[]" class="form-control"></td> <td><button type="button" class="btn btn-warning btn-sm w-100" onclick="hapus('+x+')">Hapus</button></td></td> </tr>'); //add input box
	}
}

function add_tcustomer() { 
    $('#addtcustomer').submit(function (e) { 
        e.preventDefault();
       $.ajax({
           type: "POST",
           url: url+"Oprations/intctr",
           data: $(this).serialize(),
           dataType: "json",
           success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });

                window.location = url+"oprations/tcustomers_data";
           }
       }); 
    });
 }