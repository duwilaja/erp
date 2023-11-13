var url = "http://202.134.4.212";
var actArr = [];

function setSelected(v,v2) { 
    if (v == v2) {
        return "selected";
    }else{
        return v +''+ v2;
    }
}

function ninp(nama='') {
    return parseInt($('input[name="'+nama+'"]').val());
}

function sinp(nama='',value='') {
    return $('input[name="'+nama+'"]').val(value);
}

function sel(nama='') {
    return $('select[name="'+nama+'"]');
}

function stxt(nama='',value='') {
   return  $('#'+nama).text(value);
}

function formatNumber(num) {
        return (new Intl.NumberFormat(['ban', 'id']).format(num));
  }

function getAct(act_id='',level='') { 
    $.ajax({
        type: "GET",
        url: url+"SelMa/getAct?pipe_id="+act_id+'&act_id='+level,
        dataType: "json",
        success: function (r) {
            actArr.push(r);
        }
    });
}

function ok2(ok2=''){
    
    if (ok2 == '') {
        ok = ok;  
    }else{
        ok = ok2;
    }

    return ok;
}

function getAllCustomer(id,name) { 
    $.ajax({
      type: "get",
      url: url+"customers/getCustomer",
      dataType: "json",
      success: function (r) {
          var sol = '';

          r.forEach(v => {
            sol += '<option '+(id == v.id ? 'selected' : '')+' value="'+v.id+'">'+v.nama_customer+'</option>';
          });
          
          $('select[name="'+name+'"]').html(sol);

      }
    });
}

function getAllEndCustomer(id,name) { 
    $.ajax({
      type: "get",
      url: url+"customers/getEndCustomer",
      dataType: "json",
      success: function (r) {
          var sol = '';

          r.forEach(v => {
            sol += '<option '+(id == v.id ? 'selected' : '')+' value="'+v.id+'">'+v.nama_end_customer+'</option>';
          });
          
          $('select[name="'+name+'"]').html(sol);

      }
    });
}

function getAllSolution(id,name) { 
    $.ajax({
      type: "get",
      url: url+"SelMa/getSolution",
      dataType: "json",
      success: function (r) {
          
          var sol = '';

          r.forEach(v => {
            sol += '<option '+(id == v.id ? 'selected' : '')+' value="'+v.id+'">'+v.solution+'</option>';
          });
          
          $('select[name="'+name+'"]').html(sol);

      }
    });
 }

 function getAllProduct(id,id_solution,name) { 
   
    var solu = '';
    if (id_solution != '') {
        solu = '?id_solution='+id_solution;
    }else{
        solu = '';
    }

    $.ajax({
      type: "get",
      url: url+"SelMa/getProduct"+solu,
      dataType: "json",
      success: function (r) {

          var sol = '';
          r.forEach(v => {
            sol += '<option '+(id == v.id ? 'selected' : '')+' value="'+v.id+'">'+v.product+'</option>';
          });
          $('select[name="'+name+'"]').html(sol);

      }
    });
 }

//  Request

function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return JSON.parse(xmlHttp.responseText);
}

function cekv(v,np='') { 
  if (v != '' ) {
      return v;
  }else{
      if (np != '') {
          return np;
      }else{
          return '';
      }
  }

}

function cnull(v,np='') { 
    if (v != false) {
        return v;
    }else{
        if (np != '') {
            return np;
        }else{
            return '';
        }
    }
}
