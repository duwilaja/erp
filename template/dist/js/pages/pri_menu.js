$(document).ready(function() {
    showtable();
    addMenu();
    upMenu();
    $('.jb').select2();
    
  } );
  
let dat = [];

var tes2 =  fetch(url+'privilage/getjabatan/').then(function (response) {
    // The API call was successful!
    return response.json();
}).then(function (data) {
    // This is the JSON from our response
    dat = data;
    
    // get reference to select element
    var sel = document.getElementById('jabatan');
    var sel2 = document.getElementById('ejabatan');
    
    var opt = "";
    var opt2 = "";
    for(let i =0; i< dat.length; i++){
        // create new option element
        opt += `<option value="${dat[i].id}">${dat[i].nma_jabatan}</option>`; 
        opt2 += `<option value="${dat[i].id}">${dat[i].nma_jabatan}</option>`; 
    }

    sel.innerHTML = opt;
    sel2.innerHTML = opt;
    // create text node to add to option element (opt)
    
}).catch(function (err) {
    // There was an error
    console.warn('Something went wrong.', err);
});



  function showtable() {
    var table = $('#tblTicSubject').DataTable({
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
        "url": url+'privilage/dtMenu',
        "type": "POST",
      },
      //Set column definition initialisation properties
      "columnDefs": [{
        "targets": [0],
        "orderable": false
      }]
    });    
  }
  

  function getMenu(id = ""){
      let getid = httpGet(url+"privilage/getMenu/"+id).data;
      document.getElementById('emenu').value = getid.menu;
      document.getElementById('eid').value = getid.id;
      document.getElementById("ejabatan").value = getid.jabatan_id;
        $('#form-edit').show();
        $('#form-add').hide();

  }

  document.getElementById('cancel').addEventListener('click', function(){
    document.getElementById("emenu").value = "";
    document.getElementById("ejabatan").selectedIndex = "0";
    $('#form-edit').hide();
    $('#form-add').show();
    
  });

  function addMenu(){
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
                  toastr.success(o.msg);
            }else{
              toastr.error(o.msg);
            }
          }
      });
    } else {
        txt = "You pressed Cancel!";
    }

  }