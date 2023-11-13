
var x = 1; //initlal text box count
var max_fields = 10; //maximum input boxes allowed

$(document).ready(function() {

    $('#customer').select2({
        placeholder: 'Please Select Customer'
      });
    $('#ae').select2({
        tags: true,
        placeholder: 'Please select Account Executive'
      });
    $('#pm').select2({
        placeholder: 'Please select Project Manager'
      });
      $('#product').select2({
        tags: true,
        placeholder: 'Please select Product'
      });

});

function hapus(id=''){
	$('.ok'+id).remove(); x--;
	cekInput();
}
function add(){
	if(x < max_fields){ //max input box allowed
        x++; //text box increment
        $('.ts').after('<tr class="ok'+x+'"> <td> <select class="form-control w-100" name="product[]" id="product'+x+'"> <option value="">  </option> </select> </td> <td><input class="form-control" name="amount[]" placeholder="Amount"></td> <td><input class="form-control" name="direct_cost[]" placeholder="Direct Cost"></td> <td>-</td> <td><button type="button" class="btn btn-danger btn-sm w-100" onclick="hapus('+x+')">Hapus</button></td> </tr>'); //add input box
        $('#product'+x).select2({
            tags: true,
            placeholder: 'Please select Product'
        });
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
