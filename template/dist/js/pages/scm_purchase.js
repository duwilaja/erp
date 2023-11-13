$(document).ready(function() {
    showtable();
	showtable_rpt();
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
          "url": 'dt_purchase',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [6],
          "orderable": false
        }]
      });
  }

function showtable_rpt() {
    $('#tabel_rpt').DataTable({
		"dom": "lrftipB",
		"buttons": ["copy","csv"],
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
          "url": 'dt_purchase_rpt',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0,12],
          "orderable": false
        }]
      });
  }  
  
var latest=0;
var c=0;
function build_row(i,v){
	var res='<tr id="item_'+i+'">'+
				'<td><button class="btn btn-danger" onclick="del_row('+i+');"><i class="fa fa-trash"></i></button></td>'+
				'<td><input type="text" class="form-control" name="nr_'+i+'" value="'+v.nr+'"></td>'+
				'<td><input type="text" class="form-control" name="partnr_'+i+'" value="'+v.partnr+'"></td>'+
				'<td><input type="text" class="form-control" name="dscr_'+i+'" value="'+v.dscr+'"></td>'+
				'<td><input type="text" class="form-control" name="qty_'+i+'" value="'+v.qty+'"></td>'+
				'<td><input type="text" class="form-control" name="unit_'+i+'" value="'+v.unit+'"></td>'+
				'<td><input type="text" class="form-control" name="price_'+i+'" value="'+v.price+'"></td>'+
				'<td><input type="text" class="form-control" name="curr_'+i+'" value="'+v.curr+'"></td>'+
				'<td><input type="text" class="form-control" name="status_'+i+'" value="'+v.status+'"></td>'+
			'</tr>';
	return res;
}

function add_row(){
	var v={nr:(c+1),partnr:'-',dscr:'',qty:1,unit:'Unit',price:'1',curr:'IDR',status:'-'};
	var t=$("#totitem").val();
	t++;
	if(c==0){
		//console.log('0');
		$("#tbody").html(build_row(t,v));
	}else{
		//console.log('>0-'+latest);
		$("#item_"+latest).after(build_row(t,v));
	}
	c++;
	latest=t;
	$("#totitem").val(t);
	//console.log("latest="+latest+" c="+c+" t="+t);
}

function getLatest(){
	var zz=latest;
	ret=latest-1;
	for(z=zz;z>0;z--){
		if($("#item_"+z).length) { ret=z; break; }
	}
	return ret;
}

function del_row(i){
	c--;
	$("#item_"+i).remove();
	if(i==latest){
		latest=getLatest();
	}
}

function save_item(u){
	var frmdata=new FormData($("#f_po_items")[0]);
	$.ajax({
		type: "post",
		url:u,
		data : frmdata,
		cache: false,
		contentType: false,
		processData: false,
		success: function (res) {
			console.log (res);
			toastr.success(res);
		}
	});
}

function get_item(u,id=""){
	if(id!="") $("#poid").val(id);
	$.ajax({
		type: "get",
		url:u,
		data : {},
		success: function (res) {
			//console.log (res);
			var data=JSON.parse(res);
			var html='';
			for(i=0;i<data.length;i++){
				html+=build_row((i+1),data[i]);
			}
			$("#tbody").html(html);
			c=data.length;
			latest=c;
			$("#totitem").val(c);
		}
	});
}