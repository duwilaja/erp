
var x = 1; //initlal text box count
var max_fields = 10; //maximum input boxes allowed

$(document).ready(function() {
    $('select[name="jabatan"]').select2({
        placeholder: 'Please Select Position'
      });

      $('select[name="karyawan"]').select2({
        placeholder: 'Please Select Employes'
      });

      pilihJabatan();
});

function pilihJabatan(){
    $('select[name="jabatan"]').change(function (e) { 
    e.preventDefault();
    $('.ts').html('');

     $.ajax({
       type: "get",
       url: url+"kpi/getKpiJabatan/"+$(this).val()+'/1',
       dataType: "json",
       success: function (r) {
          $.each(r, function (k, v) { 
           $('.ts').append("<tr> <td>"+v.pg+"</td> <td><input type='hidden' name='id[]' value='"+v.id+"'> "+v.weight+"</td> <td>"+v.kpi+"</td> <td>"+v.target+"</td> </tr>"); //add input box
          });
       }
     });
  });
}
