var dtRh = $('.dtRahasia').text();
var datax = [];
var his = $('input[name="history"]').val();
var idt = $('input[name="idt"]').val();

$(document).ready(function() {
    showtable();
    createTicket();
    getiCost();
    updateTicket();
    filters();
    reset();
    socket.on('chat message', function(msg){
        showtable();
    });
   
    socket.on('notif', function(){
        showtable();
    });
    dttLayanan();

    // History Ticket
    inHTicket();
    dttCategory();
    editTicCategory();
    addTicCategory();

    // Subject
    dttSubject();
    getKategori();
    addTicSubject();
    editTicSubject();

     // Layanan
     dttLayanan();
     addTicLayanan();
     editTicLayanan();
     getProvinsi();

    if (his == 'true' && idt != '') {
        $("#modal-history").modal('show');
        getTicket2(idt);
    }

});

$('#opencreate').click(function (e) { 
    e.preventDefault();
    getProvinsi();
});

// Tic Layanan
function getAddTicLayanan() { 
    getLayanan();
    $('select[name="layanan"]').select2({
        tags : true,
        dropdownParent: $("#mAddTicLayanan")
    });
    getCost('','customer');
    $('select[name="customer"]').select2({
        dropdownParent: $("#mAddTicLayanan")
    });
}

// LAYANAN 

function getLayanan(id='',name='') { 
    if(name == '') name = 'layanan';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'./getLayananJson',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option></option>');
                $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.layanan+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }
            });
        }
    });
}

function getCustLayanan(id='',name='') { 
    if(name == '') name = 'layananf';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'./getLayananJson?cust_end='+id,
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">All Layanan</option>');
                $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }
            });
        }
    });
}

function getCusTicLayanan(id='',name='') { 
    if(name == '') name = 'layanan';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'./getTicLayananJson?cust_end='+id,
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">All Layanan</option>');
                $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.layanan+"</option>");
                }
            });
        }
    });
}

function dttLayanan() {
    $('#tblticLayanan').DataTable({
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
            "url": './dtTicLayanan',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,3],
            "orderable": false
        }]
    });
}



function getEditTicLayanan(id) {
    var c = httpGet('./getTicLayanan/'+id);
    getLayanan('','e_layanan');
    getCost(c.cust_end_id,'e_custend');
    $('select[name="e_custend"]').select2({
        dropdownParent: $("#mEditTicLayanan")
    });

    $('input[name="e_id"]').val(c.id);
    setTimeout(() => {
        $('select[name="e_custend"]').val(c.cust_end_id);
        $('select[name="e_layanan"]').val(c.layanan_id);
         $('select[name="e_layanan"]').select2({
            dropdownParent: $("#mEditTicLayanan")
        });
    }, 500);
}

function addTicLayanan() { 
    $('#addTicLayanan').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./inTicLayanan',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    dttLayanan();
                    toastr.success(res.msg+' '+$('#layanan').val());
                    // $("#mAddTicLayanan").modal('hide');
                }
            }
        });
    });
}

function editTicLayanan() { 
    $('#edtTicLayanan').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./upTicLayanan',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    dttLayanan();
                    toastr.success(res.msg);
                    $("#mEditTicLayanan").modal('hide');
                }
            }
        });
    });
}

function deTicLayanan(id) { 
    var val = 0;
    var r = confirm("Apakah anda yakin ingin menghapus data !");
    if (r == true) {
        txt = "You pressed OK!";
        val = 1;
        $.ajax({
            type: "POST",
            url: "./deTicLayanan/",
            data : {'id' : id},
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                dttLayanan();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
 }

//  tUTUP LAYANAN

function dttCategory() {
    $('#tblticCategory').DataTable({
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
            "url": './dtTicCategory',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function dttSubject() {
    $('#tblTicSubject').DataTable({
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
            "url": './dtTicSubject',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function showtable(data='') {
    
    if (data == '') {
        data = datax;
    }

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
            "url": './'+dtRh,
            "type": "POST",
            "data" : data
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function getPIC(level='',id='',grp='') { 
    if (grp == '') {
        lev = level.value;
    }else{
        lev = grp;
    }

    $.ajax({
        type: "get",
        url:'../users/getPIC/'+lev,
        dataType: "json",
        success: function (res) {
            $('select[name="hpic"]').html('');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="hpic"]').append("<option selected value='"+value.id+"'>"+value.nama+"</option>");
                }else{
                    $('select[name="hpic"]').append("<option value='"+value.id+"'>"+value.nama+"</option>");
                }
            });
        }
    });
}

function getiPIC(level='') { 
    $.ajax({
        type: "get",
        url:'../users/getPIC/'+level.value,
        dataType: "json",
        success: function (res) {
            $('select[name="i_pic"]').html('<option value="">all</option>');
            $.each( res, function( key, value ) {
                $('select[name="i_pic"]').append("<option value='"+value.id+"'>"+value.nama+"</option>");
            });
        }
    });
}

function getCost(id='',name='') { 
    if(name == '') name = 'customer';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'../customers/getEndCustomer/',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Pilih Customer --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.custend+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.custend+"</option>");
                }
            });
        }
    });
}

function getiCost(id='') { 
    $('select[name="i_customer"]').html('');
    $.ajax({
        type: "get",
        url:url+'customers/getEndCustomer/',
        dataType: "json",
        success: function (res) {
            $('select[name="i_customer"]').html('<option value="">-- Pilih Customer --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="i_customer"]').append("<option selected value='"+value.id+"'>"+value.custend+"</option>");
                }else{
                    $('select[name="i_customer"]').append("<option value='"+value.id+"'>"+value.custend+"</option>");
                }
            });
        }
    });
}

function createTicket() {
    $('#createticket').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./inCreateTicket',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function() {
                // setting a timeout
                $('#btn_loading').show();
                $('#btn_submit').hide();
            },
            success: function (res) {
                if (res.status == 1) {
                    socket.emit('chat message', 'Ticket baru dibuat #'+res.no_ticket);
                    showtable();
                    toastr.success(res.msg);
                    $('#createticket')[0].reset();
                    $("#modal-lg").modal('hide');
                    $('#btn_loading').hide();  
                    $('#btn_submit').show(); 
                }
            },
            error: function() {
                toastr.error('Terjadi kesalahan, harap hubungi developer');
                $('#btn_loading').hide(); 
                $('#btn_submit').show();
            }
        });
    });
}

function updateTicket() {
    $('#updateticket').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./upTicket',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    showtable();
                    toastr.success(res.msg);
                    $("#modal-lg-up").modal('hide');
                }
            }
        });
    });
}

function editTicket(id='') {
    $("#modal-lg-up").modal('show');
    clearinp();
    $.ajax({
        type: "post",
        url:'./getTicket/'+id,
        data : $(this).serialize(),
        dataType: "json",
        success: function (res) {
           setTimeout(() => {
            getCost('','customert');
            getCusTicLayanan(res.customer,'layanant');
            getProvinsi(res.prov_id);
            get_node(res.tic_node_id,'node_id');
            getKota(res.prov_id,res.kota_id);
            getKategori(res.tic_ktg_id);
            setTimeout(() => {
                getSubject(res.tic_subject_id);
            }, 300);
            $('input[name="reporter"]').val(res.reporter);
            setTimeout(() => {
                $('select[name="customert"]').val(res.customer);
                $('select[name="layanant"]').val(res.tic_layanan_id);
                console.log(res.tic_layanan_id);
            }, 500);
            $('input[name="h_ticket_id"]').val(res.id);
            $('input[name="id"]').val(res.id);
            $('input[name="dtm"]').val(res.dtm);
            $('input[name="ticketno"]').val(res.ticketno);
            $('input[name="node_id"]').val(res.node_id);
            $('input[name="createdBy"]').val(res.createdBy);
            $('input[name="alamat"]').val(res.alamat);
            
            $('select[name="subject"]').html('<option value=""></option> <option value="problem" '+cekSelected(res.subject,'problem')+'>Problem</option> <option value="change" '+cekSelected(res.subject,'change')+'>Change Request</option> <option value="information" '+cekSelected(res.subject,'information')+'>Information</option>');
            
            //$('select[name="grp"]').html('<option value=""></option> <option '+cekSelected(res.grp,'oprlvl1')+' value="oprlvl1">C3</option> <option '+cekSelected(res.grp,'oprlvl1bali')+' value="oprlvl1bali">C3 Bali</option> <option '+cekSelected(res.grp,'oprlvl2')+' value="oprlvl2">OPR Level 2</option> <option '+cekSelected(res.grp,'oprlvl3')+' value="oprlvl3">OPR Level 3</option> <option '+cekSelected(res.grp,'oprlvl4')+' value="oprlvl4">Level 4</option><option '+cekSelected(res.grp,'oprlvl5')+' value="oprlvl5">Level 5</option>');
            $('select[name="grp"]').val(res.grp);
			
            //$('select[name="status"]').html('<option value=""></option> <option '+cekSelected(res.status,'new')+' value="new">new</option> <option '+cekSelected(res.status,'pending')+' value="pending">pending</option> <option '+cekSelected(res.status,'progress')+' value="progress">progress</option> <option '+cekSelected(res.status,'resolved')+' value="resolved">resolved</option> <option '+cekSelected(res.status,'closed')+' value="closed">closed</option>');
			$('select[name="status"]').val(res.status);
			
            $('select[name="sla"]').html('<option value=""></option> <option '+cekSelected(res.sla,'1')+' value="1">Critical</option> <option '+cekSelected(res.sla,'2')+' value="2">High</option> <option '+cekSelected(res.sla,'3')+' value="3">Medium</option> <option '+cekSelected(res.sla,'4')+' value="4">Low</option>');

            getPIC('',res.pic,res.grp);

            $('textarea[name="body"]').text(res.body);
            $('textarea[name="notes"]').text(res.notes);

           }, 700);
            
        }
    });
}

function ticketAgree(id='',pic='') { 
    
    var val = 0;
    var r = confirm("Apakah anda yakin ingin menerima tugas ini ? ");
    if (r == true) {
        txt = "You pressed OK!";
        val = 1;
        $.ajax({
            type: "POST",
            url: "./ticketAgree/",
            data : {'val' : val,'id' : id ,'pic' : pic},
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtable()
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}

// History Ticketing

function historyTicket(id=''){
    $("#modal-history").modal('show');
    getTicket2(id);
}

function getTicket2(id) {
    var idk = $('input[name="idk"]').val();
    var usru = $('#upd_user');
    usru.hide();

    $.ajax({
        type: "post",
        url:'./getTicket2/'+id,
        data : $(this).serialize(),
        dataType: "json",
        success: function (res) {
           setTimeout(() => {
           
            if(idk == res.pic) usru.show();
            
            getPIC('',res.pic,res.grp);

            $('input[name="h_ticket_id"]').val(id);

            //$('select[name="hgrp"]').html('<option value=""></option> <option '+cekSelected(res.grp,'oprlvl1')+' value="oprlvl1">C3</option> <option '+cekSelected(res.grp,'oprlvl1bali')+' value="oprlvl1bali">C3 Bali</option> <option '+cekSelected(res.grp,'oprlvl2')+' value="oprlvl2">OPR Level 2</option> <option '+cekSelected(res.grp,'oprlvl3')+' value="oprlvl3">OPR Level 3</option><option '+cekSelected(res.grp,'oprlvl4')+' value="oprlvl4">Level 4</option><option '+cekSelected(res.grp,'oprlvl5')+' value="oprlvl5">Level 5</option>');
            $('select[name="hgrp"]').val(res.grp);
			
            $('.txtNoTicket').text(res.ticketno);
            $('.txtLayanan').text(res.layanan);
            $('.txtCustomer').text(res.customer);
            $('.txtNodeID').text(res.node_id);
            $('.txtReportBy').text(res.reporter);
            
            $('.txtWP').html(res.wp);
            $('.txtSLAUrgency').html(res.sla);
            $('.txtCategory').text(res.category);
            $('.txtSubject').text(res.subject);
            $('.txtStatus').text(res.status);
            $('.txtLastUpdate').text(res.lastupd);
            $('.txtDetail').text(res.detail);
            $('.txtAlamat').text(res.alamat);
           
            $('.txtAssign').text(res.kpic);
            $('.txtProv').text(res.provinsi);
            $('.txtKota').text(res.kota);

            $('select[name="h_status"]').val(res.status);
            get_sclosed(res.s_closed_id);

            $('.txtFile').html(`<a target="_blank" href="${url+'data/ticket/'+res.file}">${res.file}</a>`);
            getHTicket();

           }, 300);
        }
    });
}

function getHTicket() { 
    var link = '';
    $('#konten_history').html('');
    $.ajax({
        type: "get",
        url:'./getHTicket/'+$('input[name="h_ticket_id"]').val(),
        dataType: "json",
        success: function (res) {
            $.each( res, function( k, v ) {
 
              if (v.file != '') {
                  link = url+'data/ticket/'+v.file;
              }
               var k = `<div class="col-md-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6"><div class="nama"><b>${v.nama}</b></div></div>
                                    <div class="col-md-6 text-left"><div class="status" id="c${v.status}">${v.status}</div></div>
                                    <div class="col-md-8">
                                       <div class="pesan">${v.note}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="file"><a href="${link}" target="_blank">${v.file}</a></div>
                                    </div>
                                </div>
                                <div class="tgl" style="font-size:12px;">${v.created_date}</div>
                            </div>
                        </div>
                    </div>`;
              $('#konten_history').append(k);
            });


        }
    });
}


function filters() {
  $('#filters').submit(function (e) { 
      e.preventDefault();
      var d = $(this).serializeToJSON();
      showtable(d);
  }); 
}

function reset() {
    $('button[type="reset"]').click(function (e) { 
        showtable();
    }); 
  }

function cekSelected(id,value) {
    if (id == value) {
        return "selected";
    }else{
        return "";
    }
  }

function opencreate() { 
    $('#opencreate').click(function (e) { 
        e.preventDefault();
        $(".modal-title").text('Create Ticket');
    });
}

function clearinp() { 
    $('input[name="reporter"]').val('');
    $('input[name="id"]').val('');
    $('input[name="dtm"]').val('');
    $('input[name="ticketno"]').val('');
    $('input[name="node_id"]').val('');
    $('input[name="createdBy"]').val('');
    
    $('select[name="subject"]').html('');
    
    $('select[name="grp"]').html('');
    $('select[name="alamat"]').html('');
    
    $('select[name="status"]').html('');

    $('select[name="sla"]').html('');

    $('textarea[name="body"]').text('');

    $('textarea[name="notes"]').text('');
 }

// Ticket Category
 function getKategori(id='') { 
    $('select[name="kategori"]').html('');
    $('select[name="e_kategori"]').html('');
    $.ajax({
        type: "get",
        url:'./getKategoriJson',
        dataType: "json",
        success: function (res) {
            $('select[name="kategori"]').html('');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="kategori"]').append("<option selected value='"+value.id+"'>"+value.nama_kategori+"</option>");
                    $('select[name="e_kategori"]').append("<option selected value='"+value.id+"'>"+value.nama_kategori+"</option>");
                }else{
                    $('select[name="kategori"]').append("<option value='"+value.id+"'>"+value.nama_kategori+"</option>");
                    $('select[name="e_kategori"]').append("<option value='"+value.id+"'>"+value.nama_kategori+"</option>");
                }
            });
        }
    });
}

function getEditTicCategory(id) {
    var c = httpGet('./getTicCategory/'+id);
    $('input[name="e_id"]').val(c.id);
    $('input[name="e_category"]').val(c.nama_kategori);
}

function addTicCategory() { 
    $('#addTicCategory').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./inTicCategory',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    dttCategory();
                    toastr.success(res.msg);
                    $("#mAddTicCategory").modal('hide');
                }
            }
        });
    });
}

function editTicCategory() { 
    $('#edtTicCategory').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./upTicCategory',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    dttCategory();
                    toastr.success(res.msg);
                    $("#mEditTicCategory").modal('hide');
                }
            }
        });
    });
}

function deTicCategory(id) { 
    var val = 0;
    var r = confirm("Apakah anda yakin ingin menghapus data !");
    if (r == true) {
        txt = "You pressed OK!";
        val = 1;
        $.ajax({
            type: "POST",
            url: "./deTicCategory/",
            data : {'id' : id},
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                dttCategory();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
 }

// Ticket Subject

function getSubjectTicCategory(id) {
    var c = httpGet('./getTicSubject/'+id);
    $('input[name="e_id"]').val(c.id);
    getKategori(c.tic_ktg_id);
    $('input[name="e_category"]').val(c.nama_kategori);
    $('input[name="e_subject"]').val(c.nama_subject);
}

function getSubject(id='') { 
    var idKat = $('select[name="kategori"]').val();
    $('select[name="subject"]').html('');
    $.ajax({
        type: "get",
        url:'./getSubjectJson/?tic_ktg_id='+idKat,
        dataType: "json",
        success: function (res) {
            $('select[name="subject"]').html('');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="subject"]').append("<option selected value='"+value.id+"'>"+value.nama_subject+"</option>");
                }else{
                    $('select[name="subject"]').append("<option value='"+value.id+"'>"+value.nama_subject+"</option>");
                }
            });
        }
    });
}

function getFSubject(id='') { 
    var idKat = $('select[name="f_kategori"]').val();
    $('select[name="f_subject"]').html('');
    $.ajax({
        type: "get",
        url:'./getSubjectJson/?tic_ktg_id='+idKat,
        dataType: "json",
        success: function (res) {
            $('select[name="subject"]').html('');
            $('select[name="f_subject"]').html('<option value=""></option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="f_subject"]').append("<option selected value='"+value.id+"'>"+value.nama_subject+"</option>");
                }else{
                    $('select[name="f_subject"]').append("<option value='"+value.id+"'>"+value.nama_subject+"</option>");
                }
            });
        }
    });
}

function addTicSubject() { 
    $('#addTicSubject').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./inTicSubject',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    dttSubject();
                    toastr.success(res.msg);
                    $("#mAddTicSubject").modal('hide');
                }
            }
        });
    });
}

function editTicSubject() { 
    $('#edtTicSubject').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./upTicSubject',
            data : $(this).serialize(),
            dataType: "json",
            success: function (res) {
                if (res.status == 1) {
                    dttSubject();
                    toastr.success(res.msg);
                    $("#mEditTicSubject").modal('hide');
                }
            }
        });
    });
}

function deTicSubject(id) { 
    var val = 0;
    var r = confirm("Apakah anda yakin ingin menghapus data !");
    if (r == true) {
        txt = "You pressed OK!";
        val = 1;
        $.ajax({
            type: "POST",
            url: "./deTicSubject/",
            data : {'id' : id},
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                dttSubject();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
 }


function inHTicket() {
    $('#inHTicket').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url:'./inHTicket',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            beforeSend: function() {
                // setting a timeout
                $('#btn_loading2').show();
                $('#btn_submit2').hide();
            },
            success: function (res) {
                if (res.status == 1) {
                    toastr.success(res.msg[0]);
                    if ($('input[name="idk"]').val() != $('select[name="hpic"]').val()) {
                        console.log('das');
                        socket.emit('notif',{
                            to : $('select[name="hpic"]').val(),
                            msg : res.msg[1]
                        });
                    }   
                    getHTicket();
                    showtable();
                    getTicket2($('input[name="h_ticket_id"]').val());
                    $('#inHTicket').trigger("reset");

                    $('#btn_loading2').hide();
                    $('#btn_submit2').show();
                }
            },
            error: function () {
                $('#btn_loading2').hide();
                $('#btn_submit2').show();
                toastr.error('Terjadi kesalahan sistem, harap hubungi developer');
            }
        });
    });
}

 function pilihSubject(id) { 
    $('#i_subject').html('');
    $.ajax({
        type: "GET",
        url: './getSubjectJson?tic_ktg_id='+id,
        dataType: "json",
        success: function (r) {
            var subject = '';
            
            r.forEach(v => {
                subject +=  '<option value="'+v.id+'">'+v.nama_subject+'</option>';
            });

            $('#i_subject').html(subject);
        }
    });
 }

//  Privinsi
function getProvinsi(id) { 
    $('select[name="i_provinsi"]').html('');
    $.ajax({
        type: "get",
        url:'./getProvinsiJson',
        dataType: "json",
        success: function (res) {
            $('select[name="i_provinsi"]').html('');
            $('select[name="i_provinsi"]').append("<option selected value=''></option>");
            $('select[name="provinsi"]').append("<option selected value=''></option>");
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="provinsi"]').append("<option selected value='"+value.id+"'>"+value.name+"</option>");
                }else{
                    $('select[name="provinsi"]').append("<option value='"+value.id+"'>"+value.name+"</option>");
                    $('select[name="i_provinsi"]').append("<option value='"+value.id+"'>"+value.name+"</option>");
                }
            });
            // $('select[name="i_provinsi"]').select2({
            //     dropdownParent: $("#modal-lg")
            // });
        }
    });
}

// Kota 
function getKota(id='',kota_id='') { 
    if(id == '') id = $('select[name="i_provinsi"]').val();
    $('select[name="i_kota"]').html('');
    $('select[name="kota"]').html('');
    $.ajax({
        type: "get",
        url:'./getKotaJson?provinsi_id='+id,
        dataType: "json",
        success: function (res) {
            $('select[name="i_kota"]').html('');
            $.each( res, function( key, value ) {
                if (value.id == kota_id) {
                    $('select[name="kota"]').append("<option selected value='"+value.id+"'>"+value.name+"</option>");
                }else{
                    $('select[name="kota"]').append("<option value='"+value.id+"'>"+value.name+"</option>");
                    $('select[name="i_kota"]').append("<option value='"+value.id+"'>"+value.name+"</option>");
                }
            });

            $('select[name="i_kota"]').select2({
                dropdownParent: $("#modal-lg")
            });
            
        }
    });
}

$('select[name="h_status"]').change(function (e) { 
    e.preventDefault();
    get_sclosed();
});


function get_sclosed(id=''){
    $('.sclosed').html('');
    if ($('select[name="h_status"').val() == 'closed') {
        $('.sclosed').html('<div class="row mb-2"><div class="col-md-3">Action</div><div class="col-md-9"><select name="s_closed" class="form-control form-control-sm" required></select></div></div>');
        sclosed(id);
    }
}

function sclosed(id='') { 
    $('select[name="s_closed"]').html('');
    $.ajax({
        type: "GET",
        url:'./jsn_s_closed',
        dataType: "json",
        success: function (res) {
            $('select[name="s_closed"]').append("<option selected value=''></option>");
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="s_closed"]').append("<option selected value='"+value.id+"'>"+value.s_closed+"</option>");
                }else{
                    $('select[name="s_closed"]').append("<option value='"+value.id+"'>"+value.s_closed+"</option>");
                }
            });
        }
    });
}

function get_node_cl(id='',name='i_node') { 
    var cust = $('select[name="i_customer"]').val();
    var layanan = $('select[name="i_layanan"]').val();

    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'./get_node_cl?cust='+cust+'&layanan='+layanan,
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">All Node</option>');
                $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.node+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.node+"</option>");
                }
            });
        }
    });
}

function get_node(id='',name='node_id') { 

    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'./get_node?id='+id,
        dataType: "json",
        success: function (res) {
            $('input[name="'+name+'"]').val(res.node);
        }
    });
}



