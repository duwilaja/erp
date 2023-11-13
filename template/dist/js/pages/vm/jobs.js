function jobs() {
    $('#jobs').html('');
    
    last_start = 3; 
    start = 0

    $.ajax({
        type: "POST",
        url: "get_vnd_prt_job",
        data:{
            'limit' :last_start,
            'start' : start, 
            'search' : $('#srch').val(),
            'location' : $('#lct').val()
        },
        dataType: "json",
        success: function (v) {
        if(v == '')
        {
            $('#load_data_message').html('<div class="text-muted d-flex"><h4 class="mx-auto">No More Result Found</h4></div>');
            action = 'active';
        }
        else
        {
            v.forEach(e => {
                $('#jobs').append(`
                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:void(0);" onclick="detailJob(${e.id});" class="card shadow-sm" style="border-radius:25px;">
                            <div class="card-body">
                                <div class="row p-2">
                                    <div class="col-md-1 icon-jobs">
                                        <i class="fa fa-server pt-3"></i>
                                    </div>
                                    <div class="col ml-4">
                                        <h4 class="text-gray">${e.job_name}</h4>
                                        <h6 class="text-muted"><i class="fa fa-map-marker-alt text-red"></i> ${e.addreas}, ${e.kota}, ${e.provinsi}</h6>
                                    </div>
                                    <div class="ml-auto" style="margin-right:3rem;">
                                        <h4 class="text-gray">Rp ${formatrp(e.price)}</h4>
                                        <p class="text-gray text-right">${dateToHowManyAgo(e.ctdDate)}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>`)
            });
                $('#load_data_message').html("");
                action = 'inactive';
        }
        }
    });
}

var limit = 3;
var start = 0;
var last_start = 3;
var action = 'inactive';

$(document).ready(function() {

    addJob();
    upJob();
    getProvinsi();
    $('#provinsi').select2({
        dropdownParent: $('#formAddJob')
    });
    $('#lct').select2();

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="dot-flashing mx-auto"></div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(1);


    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#jobs").height() && action == 'inactive')
      {
        lazzy_loader(1);
        action = 'active';
        start = start + limit;
        last_start = start;
        setTimeout(function(){
          load_data(limit, last_start);
        }, 1000);
      }
    });
});

function load_data(limit, start, del=false)
    {
      $.ajax({
        url:"get_vnd_prt_job",
        method:"POST",
        data:{
            limit:limit,
            start:start,
            'search' : $('#srch').val(),
            'location' : $('#lct').val()
        },
        cache: false,
        dataType: "json",
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="text-muted d-flex"><h4 class="mx-auto">No More Result Found</h4></div>');
            action = 'active';
            if (del) {
                $('#jobs').html('');
            }
          }
          else
          {
            if (del) {
                $('#jobs').html('');
            }
            data.forEach(e => {
                $('#jobs').append(`
                <div class="row">
                    <div class="col-md-12">
                        <a href="javascript:void(0);" onclick="detailJob(${e.id},${e.rowid - 1});" class="card shadow-sm" style="border-radius:25px;">
                            <div class="card-body">
                                <div class="row p-2">
                                    <div class="col-md-1 icon-jobs">
                                        <i class="fa fa-server pt-3"></i>
                                    </div>
                                    <div class="col ml-4">
                                        <h4 class="text-gray">${e.job_name}</h4>
                                        <h6 class="text-muted"><i class="fa fa-map-marker-alt text-red"></i> ${e.addreas}, ${e.kota}, ${e.provinsi}</h6>
                                    </div>
                                    <div class="ml-auto" style="margin-right:3rem;">
                                        <h4 class="text-gray">Rp ${formatrp(e.price)}</h4>
                                        <p class="text-gray text-right">${dateToHowManyAgo(e.ctdDate)}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>`)
            });
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

function addModal()
{
    $('#addJob')[0].reset(); // reset form on modals
    $('#formAddJob').modal('show'); // show bootstrap modal

    $('#btnSave').text('Simpan'); //change button text
    $('#btnSave').attr('disabled',false); //set button disable 
}

function getProvinsi(id='',dom='.lct') {
    // $(dom).html('');
    $.ajax({
        type: "GET",
        url: "getProvinsi",
        dataType: "json",
        success: function (r) {
            r.forEach(v => {
                $(dom).append(`<option ${id == v.id ? "selected" : ""} value="${v.id}" >${v.name}</option>`);
            });
        }
    });
    
  }

function getKota(id_p,kota_id='',dom='#kota') {
    $(dom).html('');
    console.log('dasdsa');
    $.ajax({
        type: "GET",
        url: "getKota?id_p="+id_p,
        dataType: "json",
        success: function (r) {
            r.forEach(v => {
                $(dom).append(`<option ${kota_id == v.id ? "selected" : ""} value="${v.id}" >${v.name}</option>`);
            });
        }
    });
  }

  $( "#provinsi" ).change(function() {
      let id_p = $('#provinsi').val();
      if ($('#provinsi').val() != "0") {
        getKota(id_p);
        $('#kota').select2({
            dropdownParent: $('#formAddJob')
        });
        $('#kota').html('<option value="0">--Pilih Kota--</option>');
        $('#kota').attr('disabled',false);
      }else {
        $('#kota').html('<option value="0">--Pilih Kota--</option>');
        $('#kota').attr('disabled',true);
        $('#addreas').val('');
        $('#addreas').attr('disabled',true);
      }
  });

  $( "#kota" ).change(function() {
    if ($('#kota').val() != "0") {
      $('#addreas').attr('disabled',false);
    }else {
      $('#addreas').val('');
      $('#addreas').attr('disabled',true);
    }
});

function addJob() { 
    $('#addJob').submit(function (e) { 
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "inVndJob",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled',false);
                    $('#formAddJob').modal('hide');
                    jobs();
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

function deleteJob(id, rowid){
    console.log(last_start,rowid);

    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {         
            var link = 'delVndJob'; 
            $.ajax({
                type: "POST",
                url: link,
                data: {
                    'id' : id,
                },
                dataType: "json",
                success: function (r) {
                    if (r.status) {

                        Swal.fire(
                            'Berhasil',
                            r.msg,
                            'success'
                        );
                        load_data(last_start, 0 , true);
                        $('#detailJob').modal('hide');
                    }else{
                        Swal.fire(
                            'Gagal',
                            r.msg,
                            'error'
                        );
                    }
                    
                }
            });
        }
      })
 }

 function upJob() { 
    $('#formEditJob').submit(function (e) { 
        $('#btnUbah').text('Mengubah...'); //change button text
        $('#btnUbah').attr('disabled',true); //set button disable 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "upVndJob",
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if(r.status == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: r.msg,
                    })
                    $('#btnUbah').text('Ubah');
                    $('#btnUbah').attr('disabled',false);
                    $('#editJob').modal('hide');
                    $('#detailJob').modal('hide');
                    jobs();
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

function detailJob(id,rowid)
{
    console.log(rowid);
    $('#detailJob').modal('show');
    $('#d_fot').html(``);
    $.ajax({
        type: "GET",
        url: "get_vnd_prt_job?id="+id,
        dataType: "json",
        success: function (v) {
            v.forEach(r => {
                $('#d_jobName').text(r.job_name);
                $('#d_price').text(`Rp ${formatrp(r.price)}`);
                $('#d_description').text(r.description);
                $('#d_provinsi').text(r.provinsi);
                $('#d_kota').text(r.kota);
                $('#d_addreas').text(r.addreas);
            });
            $('#d_fot').append(`
            <a href="javascript:void(0);" onclick="editJob(${id});" class="btn btn-warning text-white"><i class="fa fa-edit"></i> Edit</a>
            <a href="javascript:void(0);" onclick="deleteJob(${id}, ${rowid});" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a>
            `)
        }
    });
}

function editJob(id)
{
    // $('#detailJob').modal('hide');
    $('#editJob').modal('show');
    $.ajax({
        type: "GET",
        url: "get_vnd_prt_job?id="+id,
        dataType: "json",
        success: function (v) {
            v.forEach(r => {
                $('#e_id').val(r.id);
                $('#e_jobName').val(r.job_name);
                $('#e_price').val(format(r.price));
                $('#e_description').val(r.description);
                // $('#e_provinsi').val(r.provinsi_id);
                // $('#e_kota').val(r.kota_id);
                getProvinsi(r.provinsi_id,'#e_provinsi');
                getKota(r.provinsi_id,r.kota_id,'#e_kota');
                $('#e_addreas').val(r.addreas);
            });
        }
    });
}

function dateToHowManyAgo(stringDate){
    var currDate = new Date();
    var diffMs=currDate.getTime() - new Date(stringDate).getTime();
    var sec=diffMs/1000;
    if(sec<60)
        return parseInt(sec)+' Second'+(parseInt(sec)>1?'s':'')+' Ago';
    var min=sec/60;
    if(min<60)
        return parseInt(min)+' Minute'+(parseInt(min)>1?'s':'')+' Ago';
    var h=min/60;
    if(h<24)
        return parseInt(h)+' Hour'+(parseInt(h)>1?'s':'')+' Ago';
    var d=h/24;
    if(d<30)
        return parseInt(d)+' Day'+(parseInt(d)>1?'s':'')+' Ago';
    var m=d/30;
    if(m<12)
        return parseInt(m)+' Month'+(parseInt(m)>1?'s':'')+' Ago';
    var y=m/12;
    return parseInt(y)+' Year'+(parseInt(y)>1?'s':'')+' Ago';
}

function formatrp(bilangan) {

    var	number_string = bilangan.toString(),
        sisa 	= number_string.length % 3,
        rupiah 	= number_string.substr(0, sisa),
        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
            
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return rupiah;
}


$("#price").keyup(function(e){
    $(this).val(format($(this).val()));
});
$("#e_price").keyup(function(e){
    $(this).val(format($(this).val()));
});
let format = function(num){
    let str = num.toString().replace(/[^,\d]/g, ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(",") > 0) {
        parts = str.split(",");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(let j = 0, len = str.length; j < len; j++) {
        if(str[j] != ".") {
        output.push(str[j]);
        if(i%3 == 0 && j < (len - 1)) {
            output.push(".");
        }
        i++;
        }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
};