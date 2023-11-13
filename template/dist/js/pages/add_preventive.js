$(document).ready(function() {
    
    $('#ctr').select2({
        placeholder: 'Please Select Customers'
      });

      $('#teknisi').select2({
        placeholder: 'Please Select Teknisi'
      });
    
});

var x = 2;
var b = 1;

function add(){
    if(x < 8){
        
        $('<br><div class="row" id="maint'+x+'"><div class="col-md-4"><label for="">Maintenance ke '+x+'</label></div><div class="col-md-8"><input type="date" name="tanggal[]" class="form-control" id="tgl"></div></div>').insertAfter("#maint"+b);
        x++; //text box increment
        b++;
    }
    
}

function rem(){
  if(b > 1){
    $('#maint'+b).remove();
    b--;
    x--;
  }
}