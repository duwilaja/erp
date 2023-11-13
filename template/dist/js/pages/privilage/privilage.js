var x = 1;
let tmp = [];

$(document).ready(function() {
    showtable();
    getKaryawanPriv();
    // addMenu();
    // upMenu();
    // $('.jb').select2();
    addFormPrivilage();
    
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
        "url": 'dtPrivilage',
        "type": "POST",
      },
      //Set column definition initialisation properties
      "columnDefs": [{
        "targets": [0],
        "orderable": false
      }]
    });    
  }
  

  function getPrivilage(id=""){
      let data = httpGet('detail_priv/'+id);
      let nama = $('#lnama');
      let jabatan = $('#ljabatan');
      let dt = $('#detailTabel');
      let val = '';
      
      // Set
      nama.text(data[0].nama);
      jabatan.text(data[0].jabatan);
      $.each(data[1].menu, function (i, v) { 
         val += `<tr>
         <td><label for="">${v.menu}</label></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
            </tr>`;
        
        $.each(data[2].submenu, function (i2, v2) { 
          if (v2.m_id == v.id_m) {
            val += `
                <tr>
                    <td>${v2.submenu}</td>
                    ${cekList(v2.fitur)}
                </tr>`;
              }
        });
      });

      dt.html(val);

  }

  function cekList(cek='') {
    let ok = '';
    let c = cek.split(',');
    for (let i = 0; i < 5; i++) {
      if (c[i] == 'c' || c[i] == 'u' || c[i] == 'd' || c[i] == 'h')  {
        ok += '<td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>';
      }else{
        ok += '<td></td>';
      }
      
    }

    return ok
  }

  function getKaryawanPriv(){
    let kar = '';
    let k = httpGet('getKaryawanPriv');
    $('#karyawan').html('');
    $(k).each(function (i, e) {
        kar += '<option value="'+e.id+'.'+e.jabatan_id+'">'+e.nama+'</option>';
    });
    
    $('#karyawan').html(kar);      
  }

  function getInfo(val) { 
    
    if (tmp.length > 0) {
      $.each(tmp, function (i, v) { 
        getMenu(val,v);
      });
    }

    getMenu(val);
    $('#tfitur').html('');

  }

  function getMenu(val,id='') { 
    let kar = '';
    let men = '#menu';
    let p = val.split('.');
    let k = httpGet('getMenuJab/'+p[1]).data;

    if (id != '') {
      men = '#menu'+id;
    }

    setTimeout(() => {
      getSubmenu($(men).val(),id);
    }, 150);

    $(men).html('');
    if (k.count != 0) {
      $(k).each(function (i, e) {
        kar += '<option value="'+e.id+'.'+id+'">'+e.menu+'</option>';
      });
    }
  
    $(men).html(kar);      
  }

  function getSubmenu(id='',ids='') { 
    let sub = '';
    let subs = '#submenu';
    let idx = ''; 
    let x = id.split('.');
    if (x[0] != '') {
      idx = x[0];
    }
    let s = httpGet('getSubmenuMen/'+x[0]).data;
    $('#tfitur').html('');

    if (ids != '') {
      subs = '#submenu'+ids;
    }

    $(subs).html('');
    if (s.count != 0) {
      sub += '<option value=""> -- Pilih Submenu -- </option>';
      $(s).each(function (i, e) {
        sub += '<option value="'+e.id+'.'+e.fitur+'.'+ids+'">'+e.submenu+'</option>';
      });
    }
  
    $(subs).html(sub);     

  }
  
  function addPrivilage(){
      $('#form-add').submit(function (e) { 
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: "inAccMenu",
            data: $("#form-add").serialize(),
            dataType: "JSON",
            success: function (o) {
                if(o.status == 1){
                      showtable();
                      toastr.success(o.msg);
                      document.getElementById("menu").value = "";
                      document.getElementById("jabatan").selectedIndex = "0";
                }else{
                  toastr.error(o.msg);
                }
            }
        });
      });
      
  }
  
  function upMenu(){
    $('#form-edit').submit(function (e) { 
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "upAccMenu",
          data: $("#form-edit").serialize(),
          dataType: "JSON",
          success: function (o) {
              if(o.status == 1){
                    showtable();
                    toastr.success(o.msg);
                    document.getElementById("emenu").value = "";
                    document.getElementById("ejabatan").selectedIndex = "0";
                    $('#form-edit').hide();
                    $('#form-add').show();
                    
              }else{
                toastr.error(o.msg);
              }
          }
      });
    });
    
}

  function deMenu(id){
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
          type: "POST",
          url: "deAccMenu",
          data: {id: id},
          dataType: "JSON",
          success: function (o) {
              if(o.status == 1){
                  showtable();
                  toastr.success(o.msg)
            }else{
              toastr.error(o.msg);
            }
          }
      });
    } else {
        txt = "You pressed Cancel!";
    }

  }

  function fitur(vals,id='') {
    let tfitur = '#tfitur';

    let val = vals.split('.');
    let s = httpGet('getSubmenu/'+val[0]).data;
    let f = s.fitur.split(','); 
    let tf = '';

    if (id != '') {
      tfitur = '#tfitur'+id;
    }


    $(tfitur).html('');

    $.each(f, function (i, v) { 
      if (v == 'c') {
        tf += `<div class="col-md-6">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="c" id="inlineRadio1" value="c">
            <label class="form-check-label" for="inlineRadio1">Create</label>
        </div>
      </div>`;
      }else if (v == 'u') {
        tf += `<div class="col-md-6">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="u" id="inlineRadio1" value="u">
            <label class="form-check-label" for="inlineRadio1">Update</label>
        </div>
      </div>`;
      }else if (v == 'd') {
         tf += `<div class="col-md-6">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="d" id="inlineRadio1" value="d">
            <label class="form-check-label" for="inlineRadio1">Delete</label>
        </div>
      </div>`;
      }else if (v == 'h') { 
         tf += `<div class="col-md-6">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="h" id="inlineRadio1" value="h">
            <label class="form-check-label" for="inlineRadio1">History</label>
        </div>
      </div>`;
      }

      $(tfitur).html(tf);
         
    });
  }

  function addPriv() { 

      if(x <= 10){ //max input box allowed
        x++; //text box increment
        console.log(x);
        setTimeout(() => {
          getMenu($('#karyawan').val(),x);
        }, 150);

        tmp.push(x);

        $('#tform').append(`
              <div class="col-md-6">

                  <div class="row">
                    <div class="col-md-4"><label for="">Menu</label></div>
                      <div class="col-md-7">
                        <select name="menu" id="menu${x}" onchange="getSubmenu(this.value)" class="custom-select">
                        </select>
                    </div>
                  </div>
                  <br>

              </div>

              <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-4"><label for="">Sub Menu</label></div>
                      <div class="col-md-7">
                        <select name="submenu" onchange="fitur(this.value)" data-val="${x}" id="submenu${x}" class="custom-select">
                        </select>
                    </div>
                  </div>
                  <br>

                  <div class="row">
                    <div class="col-md-4"><label for=""></label></div> 
                      <div class="col-md-7">
                          <div class="row mb-4" id="tfitur${x}">

                          </div>
                      </div>
                  </div>
              </div>
        `); //add input box
      }
   }

   function addFormPrivilage() { 
     $('#addFormPrivilage').submit(function (e) { 
       e.preventDefault();
       $.ajax({
        type: "post",
        url:'inPrivilage',
        data : $(this).serialize(),
        dataType: "json",
          success: function (res) {
              if (res.status == 1) {
                  showtable();
                  toastr.success(res.msg);
                  $('#submenu').val('');
                  $('#tfitur').html('');
              }else{
              toastr.warning(res.msg);
              }
          }
      });
     });
   }