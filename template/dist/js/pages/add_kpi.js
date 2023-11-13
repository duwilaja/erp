
var x = 1; //initlal text box count
var max_fields = 10; //maximum input boxes allowed

$(document).ready(function() {
    $('select[name="jabatan"]').select2({
        tags : true,
        placeholder: 'Please Select Position'
      });
});

function hapus(id=''){
	$('.ok'+id).remove(); x--;
}

function add(){
	if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $('.ts').after('<tr  class="ok'+x+'"> <td><input class="form-control" name="pg[]" placeholder="Performance Goal"></td> <td><input class="form-control" name="weight[]" placeholder="Weight"></td> <td><input class="form-control" name="kpi[]" placeholder="KPI"></td> <td><input class="form-control" name="target[]" placeholder="Target"></td> <td><button type="button" class="btn btn-danger btn-sm w-100" onclick="hapus('+x+')">Hapus</button></td> </tr>'); //add input box
	}
}
