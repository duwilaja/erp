
var x = 1; //initlal text box count
var x2 = 1; //initlal text box count
var x3 = 1; //initlal text box count
var max_fields = 10; //maximum input boxes allowed
var $amount_hardware = [];

$(document).ready(function() {

	var hardware   		= $(".th"); //Fields hardware
	var add_hardware      = $("#add_field_button"); //Add button ID

	var software   		= $(".tambah_software"); //Fields hardware
	var add_software     = $(".add_software"); //Add button ID
	
	$('#add_field_button').click(function(e){ //on add input button click
		e.preventDefault();
		console.log('dsad');
		
	});

	$(add_software).click(function(e){ //on add input button click
		e.preventDefault();
		if(x2 < max_fields){ //max input box allowed
			x2++; //text box increment
			$('.th').after('<div class="pricing'+x2+'"><div class="row"> <div class="col-sm-6"><div class="form-group"> <label>Pilih Software</label> <select class="form-control" name="hardware"> <option>Tidak Ada</option> <option>option 1</option> <option>option 2</option> <option>option 3</option> <option>option 4</option> <option>option 5</option> </select> </div> </div> <div class="col-sm-6"> <div class="form-group"> <div class="input-group" style="position: relative;top: 32px;"> <div class="input-group-prepend"> <span class="input-group-text"> Rp </span> </div> <input type="number" class="form-control" name="harga_hardware"> <div class="input-group-append" onclick="hapusSoftware('+x2+')"> <span class="input-group-text text-danger"><i class="fa fa-trash"></i></span> </div> </div> </div> </div> </div></div>'); //add input box
		}
	});

    $('#customer').select2();
    $('#pd').select2();
    $('#partner').select2();
    $('#delivery_location').select2();

});

function hapusOk(id=''){
	$('.ok'+id).remove(); x--;
	cekInput();
}

function hapusSoftware(id=''){
	$('.ok2'+id).remove(); x2--;
	cekInput();
}

function hapusPricing(id=''){
	$('.pc'+id).remove(); x3--;
	cekInput();
}

function addHardware(){
	if(x < max_fields){ //max input box allowed
		x++; //text box increment
		$('.th').after(' <tr class="ok'+x+'" style="background: aliceblue;"> <td><input class="form-control form-control-sm" readonly name="text-hardware" value="Hardware"></td> <td> <select class="form-control form-control-sm" name="hardware[]"> <option>Tidak Ada</option> <option>option 1</option> <option>option 2</option> </select> </td> <td><input class="form-control form-control-sm" name="amount_hardware[]" onkeyup="cekInput()" placeholder="Amount"></td> <td><button type="button" class="btn btn-danger btn-sm w-100" onclick="hapusOk('+x+')">Hapus</button></td> </tr>'); //add input box
	}
}

function addSoftware(){
	if(x2 < max_fields){ //max input box allowed
		x2++; //text box increment
		$('.ts').after(' <tr class="ok2'+x2+'" style="background: #9df5932e;"> <td><input class="form-control form-control-sm" readonly name="text-softwre" value="Software"></td> <td> <select class="form-control form-control-sm" name="software[]"> <option>Tidak Ada</option> <option>option 1</option> <option>option 2</option> </select> </td> <td><input class="form-control form-control-sm" name="amount_software[]" onkeyup="cekInput()" placeholder="Amount"></td> <td><button type="button" class="btn btn-danger btn-sm w-100" onclick="hapusSoftware('+x2+')">Hapus</button></td> </tr>'); //add input box
	}
}

function addPricing(){
	if(x3 < max_fields){ //max input box allowed
		x3++; //text box increment
		$('.pcs').after('<tr class="pc'+x3+'"> <td colspan="1"><input class="form-control form-control-sm"  name="product[]" value=""></td> <td colspan="2"><input class="form-control form-control-sm" type="number" name="amount_pricing[]" placeholder="Amount" onkeyup="cekInput()"></td> <td><button type="button" class="btn btn-danger btn-sm w-100" onclick="hapusPricing('+x3+')">Hapus</button></td> </tr>'); //add input box
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
