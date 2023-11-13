
var x = 1; //initlal text box count
var max_fields = 10; //maximum input boxes allowed

$(document).ready(function() {

    $('#project').select2({
        placeholder: 'Please Select Project'
    });

});

function hapus(id=''){
	$('.ok'+id).remove(); x--;
	cekInput();
}

function add(){
	if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $('.ts').after('<tr class="ok'+x+'"> <td> <select class="form-control" name="period[]"> <option>Tidak Ada</option> <option value="1">1 Bulan</option> <option value="2">2 Bulan</option> <option value="3">3 Bulan</option> <option value="4">4 Bulan</option> <option value="5">5 Bulan</option> <option value="6">6 Bulan</option> <option value="7">7 Bulan</option> <option value="8">8 Bulan</option> <option value="9">9 Bulan</option> <option value="10">10 Bulan</option> <option value="11">11 Bulan</option> <option value="12">12 Bulan</option> </select> </td> <td><input type="date" class="form-control" name="target[]" placeholder="Target Date"></td> <td><input type="date" class="form-control" name="start[]" placeholder="Start Date"></td> <td><input type="number" class="form-control" name="amount[]" placeholder="Total Amount"></td> <td><input type="text" class="form-control" name="total_amount[]" placeholder="Note"></td> <td> <select class="form-control" name="status[]"> <option value="1">Belum Lunas</option> <option value="2">Lunas</option> </select> </td> <td><button class="btn btn-danger" style="font-size:20px;cursor:pointer;" onclick="hapus('+x+')"><i class="fa fa-trash"></i></button></td> </tr>'); //add input box
	}
}

function cekInput() {

	var amount_hard = $('input[name^=amount_hardware]').map(function(idx, elem) {
		return parseInt($(elem).val());
	  }).get();

	var amount_soft = $('input[name^=amount_software]').map(function(idx, elem) {
		return parseInt($(elem).val());
	  }).get();

	var amount = $('input[name^=amount_pricing]').map(function(idx, elem) {
		return parseInt($(elem).val());
	  }).get();
	
	  console.log(amount_hard,' hard = '+ amount_hard.reduce(sum));
	  console.log(amount_soft,' soft = '+ amount_soft.reduce(sum));
	  console.log(amount,' amount_pricing = '+ amount.reduce(sum));

	  var ah;
	  ah = amount_hard.reduce(sum);
	  if (isNaN(ah)) {
		  ah = 0;
	  }

	  var ams;
	  ams = amount_soft.reduce(sum);
	   if (isNaN(ams)) {
		  ams = 0;
	  	}

	  var a;
	  a = amount.reduce(sum);
	  if (isNaN(a)) {
		a = 0;
	  }

	  $('#total_margin').text(currencyFormat(ah + ams + a));
	  $('input[name="i_total_margin"]').val(ah + ams + a);
}

function sum(total, num) {
	return total + num;
}

function currencyFormat(num) {
  return 'Rp. ' + num.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}
