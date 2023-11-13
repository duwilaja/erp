$(document).ready(function() {
  $('[data-toggle="tooltip1"]').tooltip();  
  $('[data-toggle="tooltip2"]').tooltip();  
  $('[data-toggle="tooltip3"]').tooltip();  
  $('[data-toggle="tooltip4"]').tooltip();   
    showtable();
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
          "url": 'dt_pengajuan_mobil',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [9],
          "orderable": false
        }]
      });
  }


  $(function() {

    $('input[name="extend"]').daterangepicker({
          autoUpdateInput: false,
          singleDatePicker: true,
          timePicker: true,
          startDate: moment().startOf('hour'),
          endDate: moment().startOf('hour').add(32, 'hour'),
          timePicker24Hour : true,
          locale: {
              format: 'YYYY-MM-DD HH:mm',
              cancelLabel: 'Clear'
          }
    });
  
    $('input[name="extend"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
    });
  
    $('input[name="extend"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
  
  });

  $(document).ready(function(){    
    $("#contactForm").submit(function(event){
        submitForm();
        return false;
    });
});
// function to handle form submit
// function submitForm(){
//      $.ajax({
//         type: "POST",
//         url: "save_kontak.php",
//         cache:false,
//         data: $('form#contactForm').serialize(),
//         success: function(response){
//             $("#contact").html(response)
//             $("#contact-modal").modal('hide');
//         },
//         error: function(){
//             alert("Error");
//         }
//     });
// }

  

  