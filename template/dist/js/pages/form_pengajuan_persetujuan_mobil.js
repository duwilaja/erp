$('#btn_simpan').on('click',function(){
    var pnjm_id = $('#pnjm_id').val();
    var km_start = $('#km_start').val();
    $.ajax({
        type : "POST",
        url  : "SCM/update_pengajuan_mobil",
        dataType : "JSON",
        data : {pnjm_id:pnjm_id , km_start:km_start},
        success: function(data){
            alert('sukses');
        }
    });
    return false;
});

// $('input[name="extend"]').daterangepicker({
//     autoUpdateInput: false,
//     singleDatePicker: true,
//     timePicker: true,
//     startDate: moment().startOf('hour'),
//     endDate: moment().startOf('hour').add(32, 'hour'),
//     timePicker24Hour : true,
//     locale: {
//       format: 'YYYY-MM-DD HH:mm'
//     }
//   });

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
