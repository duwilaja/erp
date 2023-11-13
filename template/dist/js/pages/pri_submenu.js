$(document).ready(function() {
    addMenu();
    upMenu();
    $('.jb').select2();
    showtable();
    
} );


var tes2 =  fetch(url+'privilage/getjabatan/').then(function (response) {
    // The API call was successful!
    return response.json();
}).then(function (jabatan) {
    // This is the JSON from our response
    dat = jabatan;
    
    // get reference to select element
    var sel = document.getElementById('jabatan');
    var sel2 = document.getElementById('ejabatan');
    
    
    var opt = "";
    var opt2 = "";
    for(let i =0; i< dat.length; i++){
        // create new option element
        opt += `<option value="${dat[i].id}">${dat[i].nma_jabatan}</option> `; 
        opt2 += `<option value="${dat[i].id}">${dat[i].nma_jabatan}</option> `;  
    }
    // create text node to add to option element (opt)
    sel.innerHTML = opt;
    sel2.innerHTML = opt;
    getByMenu(dat[0].id);
    
    
    
}).catch(function (err) {
    // There was an error
    console.warn('Something went wrong.', err);
});

var menu1 = document.getElementById('menu');
var menu2 = document.getElementById('emenu');
var opt3 = "";
var opt4 = "";

function getByMenu(id){
    $('#menu').empty();
    var tes2 =  fetch(url+'privilage/getmenujab/'+id).then(function (response) {
        // The API call was successful!
        return response.json();
    }).then(function (menu) {
        // This is the JSON from our response
        dat2 = menu;
        
        if(dat2.count > 0){
            if(dat2.count > 1){
                for(let i = 0; i < dat2.count; i++){
                    opt3 += `<option value="${dat2.data[i].id}">${dat2.data[i].menu}</option> `;
                    //opt3 = opt3 + '<option value="'+dat2.data[i].id+'">'+dat2.data[i].menu+'</option>';
                }
            }else {
                opt3 = `<option value="${dat2.data[0].id}">${dat2.data[0].menu}</option> `;
                console.log('tes');
            }
        }else{
            
        }
        
        menu1.innerHTML = opt3;
        opt3 = "";
        //array.slice(-1)[0] last array
        // get reference to select element 
        
    }).catch(function (err) {
        // There was an error
        console.warn('Something went wrong.', err);
    });
}

function egetByMenu(id){
    $('#emenu').empty();
    var tes2 =  fetch(url+'privilage/getmenujab/'+id).then(function (response) {
        // The API call was successful!
        return response.json();
    }).then(function (menu2) {
        // This is the JSON from our response
        dat2 = menu2;
        
        if(dat2.count > 0){
            if(dat2.count > 1){
                for(let i = 0; i < dat2.count; i++){
                    opt4 += `<option value="${dat2.data[i].id}">${dat2.data[i].menu}</option> `;
                    //opt3 = opt3 + '<option value="'+dat2.data[i].id+'">'+dat2.data[i].menu+'</option>';
                }
            }else {
                opt4 = `<option value="${dat2.data[0].id}">${dat2.data[0].menu}</option> `;
                console.log('tes');
            }
        }else{
            
        }
        
        document.getElementById('emenu').innerHTML = opt4;
        //opt4 = "";
        
    }).catch(function (err) {
        // There was an error
        console.warn('Something went wrong.', err);
    });
}




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
            "url": url+'privilage/dtSubmenu',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });    
}


function addMenu(){
    $('#form-add').submit(function (e) { 
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "inAccSubmenu",
          data: $("#form-add").serialize(),
          dataType: "JSON",
          success: function (o) {
              if(o.status == 1){
                    showtable();
                    toastr.success(o.msg);
                    document.getElementById("submenu").value = "";
                    getByMenu(dat[0].id);
              }else{
                toastr.error(o.msg);
              }
          }
      });
    });
    
}

function getSubmenu(id = ""){
    $('#emenu').empty();
    let getid = httpGet(url+"privilage/getSubmenu/"+id).data;
    let getm = httpGet(url+"privilage/getmenujab/"+getid.jabatan_id).data;
    
    var optm = "";
    for(let i = 0; i < getm.length ; i++){
        optm += `<option value="${getm[i].id}">${getm[i].menu}</option>`;
    }
    document.getElementById('emenu').innerHTML = optm;
    document.getElementById('emenu').value = getid.m_access_id;
    document.getElementById('eid').value = getid.id;
    document.getElementById('esubmenu').value = getid.submenu;
    document.getElementById("ejabatan").value = getid.jabatan_id;
      $('#form-edit').show();
      $('#form-add').hide();
    
}

document.getElementById('cancel').addEventListener('click', function(){
    $('#form-edit').hide();
    $('#form-add').show();
    getByMenu(dat[0].id);
});

function deSubmenu(id = ""){
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
          type: "POST",
          url: "deAccSubmenu",
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

function upMenu(){
    $('#form-edit').submit(function (e) { 
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "upAccSubmenu",
          data: $("#form-edit").serialize(),
          dataType: "JSON",
          success: function (o) {
              if(o.status == 1){
                    showtable();
                    toastr.success(o.msg);
                    document.getElementById("eid").value = "";
                    document.getElementById("emenu").selectedIndex = "0";
                    document.getElementById("esubmenu").selectedIndex = "0";
                    $('#form-edit').hide();
                    $('#form-add').show();
                    
                    
              }else{
                toastr.error(o.msg);
              }
          }
      });
    });
    
}