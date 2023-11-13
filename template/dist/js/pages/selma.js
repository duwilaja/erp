var objc = [];
var categori = [
    ['pp','Potential Prospect'],
    ['pt','Potential Target'],
    ['qo','Qualified Opportunity'],
];

var activity = [
    [1, 'Contact Potential'],
    [2, 'Persentation'],
    [3, 'POC'],
    [4, 'SPH'],
    [5, 'BAKN'],
    [6, 'PO'],
    [7, 'LOST']
];

$(document).ready(function() {
    $('#jdlFrom').text('Add Pipeline');

    showtable();
    showtableEnd();
    
    formCustomer();
    formEdtCustomer();
    
    formEndCustomer();
    formEdtEndCustomer();
    
    // Pipeline
    showtablePipeline();
    formAddPipeline();
    formEditPipeline();
    
    // Marketing Program
    addMarkProg();
    dtMarProg();
    editMarkProg();
    
    // Sales
    dtSales();
    
    // Solution
    dtSolution();
    addSolution();
    upSolution();

    get_product();
    
    $('#cust').select2({
        dropdownParent: $("#addModal"),
        tags : true
    });
    $('#custend').select2({
        dropdownParent: $("#addModal"),
        tags : true
    });
});


function showtable() {
    $('#tabelC').DataTable({
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
            "url": url+'customers/dt',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

// Get Pipeline
function getPipeline(id) { 
    $.ajax({
        type: "get",
        url: "get_pipeline?id="+id,
        dataType: "json",
        success: function (r) {
            $('input[name="e_eid"]').val(id);
            $('input[name="e_projek"]').val(r.projek);
            setTimeout(() => {
                $('select[name="e_customer"]').val(r.cust_id);
                $('select[name="e_end_cust"]').val(r.end_cust_id);
                // $('select[name="e_solution"]').val(r.solution_id);
                // $('select[name="e_product"]').val(r.product_id);
                get_product(r.product_id,'e_product',r.product_id);
                $('select[name="e_catgeory"]').val(r.category);
            }, 600);
            setTimeout(() => {
                get_solution(r.solution_id,'e_solution',r.product_id);
            }, 800);
            $('textarea[name="e_note"]').val(r.note);
        }
    });
}

function get_product(id='',name='') { 
    if(name == '') name = 'product';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'getProduct',
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Select --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.product+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.product+"</option>");
                }
            });
        }
    });
}

function get_solution(id='',name='',product='') { 
    if(name == '') name = 'solution';
    $('select[name="'+name+'"]').html('');
    $.ajax({
        type: "get",
        url:'getSolution?product='+product,
        dataType: "json",
        success: function (res) {
            $('select[name="'+name+'"]').html('<option value="">-- Select --</option>');
            $.each( res, function( key, value ) {
                if (value.id == id) {
                    $('select[name="'+name+'"]').append("<option selected value='"+value.id+"'>"+value.solution+"</option>");
                }else{
                    $('select[name="'+name+'"]').append("<option value='"+value.id+"'>"+value.solution+"</option>");
                }
            });
        }
    });
}

function selCategory(id) { 
    var sol = '';   
    categori.forEach(v => {
        sol += '<option '+(id == v[0] ? 'selected' : '')+' value="'+v[0]+'">'+v[1]+'</option>';
    });
    
    $('select[name="category"]').html(sol);
    
}

function selActivity(id) { 
    var sol = '';   
    activity.forEach(v => {
        if (v[0] >= id ) {
            sol += '<option '+(id == v[0] ? 'selected' : '')+' value="'+v[0]+'">'+v[1]+'</option>';
        }
    });
    
    $('select[name="activity"]').html(sol);
    
}


function detailCus(id='') { 
    $.ajax({
        type: "GET",
        url: url+"customers/getCustomer/"+id,
        dataType: "json",
        success: function (r) {
            $('input[name="e_id"]').val(r.id);
            $('input[name="e_customer"]').val(r.customer);
            $('input[name="pic"]').val(r.pic);
            $('input[name="telp"]').val(r.kontak_cus);
            $('input[name="email"]').val(r.email);
            $('textarea[name="alamat"]').val(r.alamat);

        }
    });

    var tc = $('#cust option:selected').text();
    $('input[name="tcustomer"]').val(tc);

}

function deCus(id='') { 
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "GET",
            url: url+"customers/deCust/"+id,
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtable();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}

function formCustomer() { 
    $('#formCustomer').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'customers/inCust',
            data: $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtable();
                $('#exampleModal').modal('hide');
            }
        });
    });
}

function formEdtCustomer() { 
    $('#formEdtCustomer').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'customers/upCust',
            data: $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtable();
                $('#editCust').modal('hide');
            }
        });
    });
}

// END Customer

function showtableEnd() {
    $('#tabelendC').DataTable({
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
            "url": url+'customers/dtEnd',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function detailEndCus(id='') { 
    $.ajax({
        type: "GET",
        url: url+"customers/getEndCustomer/"+id,
        dataType: "json",
        success: function (r) {
            $('input[name="e_id"]').val(r.id);
            $('input[name="e_custend"]').val(r.custend);
            $('input[name="pic_end"]').val(r.pic);
            $('input[name="telp_end"]').val(r.kontak_cus);
            $('input[name="email_end"]').val(r.email);
            $('textarea[name="alamat_end"]').val(r.alamat);
        }
    });

    var tc = $('#custend option:selected').text();
    $('input[name="tcustend"]').val(tc);
}

function deEndCus(id='') { 
    
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "GET",
            url: url+"customers/deEndCust/"+id,
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtableEnd()
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}

function formEndCustomer() { 
    $('#formEndCustomer').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'customers/inEndCust',
            data: $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtableEnd();
                $('#exampleModal').modal('hide');
            }
        });
    });
}

function formEdtEndCustomer() { 
    $('#formEndEdtCustomer').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'customers/upEndCust',
            data: $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                showtableEnd();
                $('#editEndCust').modal('hide');
            }
        });
    });
}

// Pipeline
function showtablePipeline() {
    $('#tpipeline').DataTable({
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
            "url": url+'SelMa/dtPipeline',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function formAddPipeline() { 
    $('#formAddPipeline').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'SelMa/inPipeline',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                $('#addModal').modal('hide');
                showtablePipeline();
                document.getElementById("formAddPipeline").reset();
            }
        });
    });
}

function formEditPipeline() { 
    $('#formEditPipeline').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'SelMa/editPipeline',
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                $('#editModal').modal('hide');
                showtablePipeline();
            }
        });
    });
}

function pilihPipelineActivity(act='',pipe='') {
    var elem = '';
    var x12 = '';
    var http = '';
    var vHttp = {
        'mom' : '',
        'cust_need' : '',
        'req_presales' : '',
        'start_date' : '',
        'end_date' : '',
        'present_date' : '',
        'judul_p' : '',
        'no' : '',
        'nominal' : '',
        'sph' : '',
        'created_date' : '',
        'service_title' : '',
        'bakn' : '',
        'po' : '',
    };

    $('#xdata').html('');
    
    if (act == '1') {
        http = cnull(httpGet(url+"SelMa/getAct?pipe_id="+pipe+'&act_id='+act),vHttp);

        elem += '<div class="form-row"> <div class="col-md-4 col"> <label for="">Start Date</label> </div> <div class="col-md-8 col"> <input type="date" name="start_date" class="form-control" value="'+cekv(http.start_date)+'"></div></div>';
    }else if (act == '2') {

        http = cnull(httpGet(url+"SelMa/getAct?pipe_id="+pipe+'&act_id='+act),vHttp);
       
        var rq = '';
        var mom = '<div class="col-md-4 col"> <label for="">Upload MOM</label> </div> <div class="col-md-8 col"> '+cekv(http.mom,'')+' </div>';
        var cust_end = '<div class="col-md-4 col mt-3"> <label for="">Customers Need</label> </div> <div class="col-md-8 col mt-3">'+cekv(http.cust_need,'<input type="file" name="cust_need" class="form-control">')+' </div>';
        var pricing = `<div class="col-mt-4 col mt-3">
             <label>Pricing</label>
        </div>
        <div class="col-mt-8 col mt-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="1">
                    <label class="form-check-label">Capex</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="inlineRadioOptions" id="inlineRadio1" value="2">
                    <label class="form-check-label">Opex</label>
                </div>
        </div>`;

        if (http.req_presales != '') {
            rq = http.req_presales == '1' ? 'Ya' : 'Tidak';
        }else{
            rq = '<select name="req_presales" class="form-control"><option value="1">Ya</option><option value="0">Tidak</option></select>';
        }

        var req_presales = '<div class="col-md-4 col mt-3"> <label for="">Request Presales</label> </div> <div class="col-md-8 col mt-3"> '+rq+'</div>';

        elem += '<div class="form-row"> <div class="col-md-4 col"> <label for="">Present Date</label> </div> <div class="col-md-8 col"> <input type="date" name="present_date" class="form-control" value="'+cekv(http.present_date)+'"> </div> </div> <div class="form-row mt-4">'+mom+cust_end+req_presales+pricing;  
    
    }else if (act == '3') {
        http = cnull(httpGet(url+"SelMa/getAct?pipe_id="+pipe+'&act_id='+act),vHttp);

        elem += '<div class="form-row"> <div class="col-md-4 col"> <label for="">Present Date</label> </div> <div class="col-md-8 col"> <input type="date" name="present_date" value="'+cekv(http.created_date)+'" class="form-control"></div></div>';   
    }else if (act == '4') {
        http = cnull(httpGet(url+"SelMa/getAct?pipe_id="+pipe+'&act_id='+act),vHttp);

        elem += '<div class="form-row"> <div class="col-md-4 col"> <label for="">No SPH</label> </div> <div class="col-md-8 col"> <input type="text" name="no_sph" placeholder="025/SPH/MMT/II/2020" value="'+cekv(http.no)+'" class="form-control"> </div> </div> <div class="form-row mt-4"> <div class="col-md-4 col"> <label for="">Judul Pekerjaan</label> </div> <div class="col-md-8 col"> <textarea name="judul_p" class="form-control">'+cekv(http.judul_p)+'</textarea> </div> </div> <div class="form-row mt-4"> <div class="col-md-4 col"> <label for="">SPH</label> </div> <div class="col-md-8 col"> '+cekv(http.sph,'<input type="file" name="sph"  class="form-control">')+'</div></div>';    
        // x12 += '<div class="dsadas"> dasdas</div>';
    }else if (act == '5') {
        http = cnull(httpGet(url+"SelMa/getAct?pipe_id="+pipe+'&act_id='+act),vHttp);
        
        elem += '<div class="form-row"> <div class="col-md-4 col"> <label for="">Service Title</label> </div> <div class="col-md-8 col"> <textarea name="service_title" class="form-control">'+cekv(http.service_title)+'</textarea> </div> </div> <div class="form-row mt-4"> <div class="col-md-4 col"> <label for="">Upload BAKN</label> </div> <div class="col-md-8 col"> '+cekv(http.bakn,'<input type="file" name="bakn"  class="form-control">')+ '</div> </div> <div class="form-row mt-4"> <div class="col-md-4 col"> <label for="">Nominal BAKN</label> </div> <div class="col-md-8 col"> <input type="text" name="nominal_bkan" value="'+cekv(http.nominal)+'" class="form-control"> </div> </div>';   
    }else if (act == '6') {

        http = cnull(httpGet(url+"SelMa/getAct?pipe_id="+pipe+'&act_id='+act),vHttp);

        elem += '<div class="form-row"> <div class="col-md-4 col"> <label for="">No Po</label> </div> <div class="col-md-8 col"> <input type="text" name="no_po"  value="'+cekv(http.no)+'" class="form-control"> </div> </div> <div class="form-row mt-4"> <div class="col-md-4 col"> <label for="">Service Title</label> </div> <div class="col-md-8 col"> <textarea name="service_title" class="form-control">'+cekv(http.service_title)+'</textarea> </div> </div> <div class="form-row mt-4"> <div class="col-md-4 col"> <label for="">Nominal PO</label> </div> <div class="col-md-8 col"> <input type="text" name="nominal"  value="'+cekv(http.nominal)+'" class="form-control"> </div> </div> <div class="form-row mt-4"> <div class="col-md-4 col"> <label for="">Period</label> </div> <div class="col-md-3 col"> <input type="date" value="'+cekv(http.start_date)+'" name="start_date" class="form-control"> </div> <div class="col-md-2 col"> <label for="">Until</label> </div> <div class="col-md-3 col"> <input type="date" value="'+cekv(http.end_date)+'" name="end_date" class="form-control"> </div><div class="col-md-4 mt-4"> <label>Upload PO</label></div> <div class="col-md-8 col mt-4"> '+cekv(http.po,'<input type="file" name="po"  class="form-control">')+'</div> </div>' ;   
    } 
    
    $('#xdata').html(elem);

    // $('#x12').html(x12);
}

function getEdit(id) { 
    $('#jdlFrom').text('Edit Pipeline');

    $.ajax({
        type: "GET",
        url: url+"SelMa/getPipeline/"+id,
        dataType: "json",
        success: function (r) {            
            $('input[name="pic"]').val(r.pic); 
            $('input[name="id"]').val(r.id); 
            $('input[name="telp"]').val(r.telp); 
            $('input[name="email"]').val(r.email); 
            $('textarea[name="address"]').val(r.email); 
            getAllCustomer(r.cust_id,'customer');
            getAllEndCustomer(r.end_cust_id,'end_cust');
            getAllSolution(r.solution_id,'solution');
            getAllProduct(r.product_id,'product');
            selCategory(r.category);
            selActivity(r.activity);
            pilihPipelineActivity(r.activity,r.id);
        }
    });
}

// Marketing Program

function dtMarProg() {
    $('#tabelMarProg').DataTable({
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
            "url": url+'SelMa/dtMarkProg',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function addMarkProg() {
    $('#addMarkProg').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'SelMa/inMarkProg',
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                $('#addMarkProg')[0].reset();
                $('#exampleModal').modal('hide');
                dtMarProg();
            }
        });
    });
}

function editMarkProg() {
    $('#editMarkProg').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'SelMa/upMarkProg',
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                $('#editModal').modal('hide');
                dtMarProg();
            }
        });
    });
}

function getMarProg(id='') { 
    $.ajax({
        type: "GET",
        url: url+"SelMa/getMarProg/"+id,
        dataType: "json",
        success: function (r) {
            r = r[0];
            sinp('e_id',r.id);
            sinp('e_title',r.title);
            sinp('e_start_date',r.start_date);
            sinp('e_end_date',r.end_date);
            $('textarea[name="e_description"]').val(r.desc);
        }
    });
}

function delMarProg(id='') { 
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "GET",
            url: url+"SelMa/delMarProg/"+id,
            dataType: "json",
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });
                
                dtMarProg();
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}

// Data Sales

function dtSales() {
    $('#tableSa').DataTable({
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
            "url": url+'SelMa/dtSales',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

// Data Solution

function dtSolution() {
    $('#tabelSolution').DataTable({
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
            "url": url+'SelMa/dtSolution',
            "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });
}

function getSolution(id) { 
    $.ajax({
        type: "get",
        url: "getSolution/"+id,
        dataType: "json",
        success: function (r) {
            $('input[name="e_id"]').val(r.id);
            $('input[name="e_solution"]').val(r.solution);
            get_product(r.product_id,'e_product');
        }
    });
}

function addSolution() { 
    $('#formAddSolution').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "inSolution",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtSolution();
                    $('#addSolution').modal('hide');
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: r.msg,
                    })
                }
            }
        }); 
    });
}

function upSolution() { 
    $('#formUpSolution').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "upSolution",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtSolution();
                    $('#editSolution').modal('hide');
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: r.msg,
                    })
                }
            }
        }); 
    });
}


function delSolution(id) { 
    var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
        $.ajax({
            type: "post",
            url: "delSolution",
            data: {
                'id' : id,
            },
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    dtSolution();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: r.msg,
                    })
                }
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
}
