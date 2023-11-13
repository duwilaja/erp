let bsub = $('#bsub');
let sub_block = [];
let sub_blocks = [];
let levels = [];
let blocks = [];
let submenus = [];
var id_menu = $('#idm').val(); 

$(document).ready(function () {
    $('#level').select2();
    $('#block').select2();
    addSubmenu();
    addHakAkses();
    getLevel();
    getidMS();
});

window.hapus = function(id='',id2='') { 
    
    if (id != '' && id2 == '') {
        $(id).remove();
    }

    if (id2 != '') {
        var r = confirm("Apakah anda yakin ingin menghapus data in ?");
        if (r == true) {
            txt = "You pressed OK!";
            $.ajax({
                type: "POST",
                url: "deMenuSub",
                data: {id : id2},
                dataType: "json",
                success: function (r) {
                    console.log('sukses');
                }
            });
            $(id).remove();
        } else {
          txt = "You pressed Cancel!";
        }
    }
}

function addSubmenu() { 
    let no = 0;
    bsub.html('');    
    $('#add').click(function (e) { 
        
        let n = no++;
        e.preventDefault();
        bsub.append(`<tr class="${'t'+n}">
        <td style="width: 100px;"><input type="hidden" class="form-control form-control-sm" name="id_sub[]" id="id_sub" value=""><input type="number" class="form-control form-control-sm" name="no[]" id="no"></td>
        <td><input type="text" class="form-control form-control-sm" name="submenu[]" id="submenu"></td>
        <td><input type="text" class="form-control form-control-sm" name="sub_target[]" id="sub_target"></td>
        <td>
            <select class="form-control w-100" class="form-control" name="sub_block[]" id="sub_block${n}" multiple>
            </select>
        </td>
        <td><button type="button" id="del" class="btn btn-sm btn-danger" onclick="hapus('${'.t'+n}')"><i class="fa fa-trash"></i></button></td>
        </tr>
        `);
                
        setTimeout(() => {
            sub_block[0].forEach((v,i) => {
                $('#sub_block'+n).append('<option value="'+v.id+'">'+v.nama+'</option>'); 
            });
            setTimeout(() => {
                $('#sub_block'+n).select2();
            }, 300);
        }, 800);
        
    });
 }

 function addHakAkses() { 
    var link = 'addHakAkses'; 
    if (id_menu != '') link = 'upHakAkses';
     $('#formHakAkses').submit(function (e) { 
         e.preventDefault();
         $.ajax({
            type: "POST",
            url: link,
            data : $(this).serialize(),
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    Swal.fire(
                        'Berhasil',
                        r.msg,
                        'success'
                      );
                }else{
                    Swal.fire(
                        'Gagal',
                        r.msg,
                        'error'
                      );
                }
            }
        });
     });
   
 }

 function getLevel() { 
    $('#level').val('');
     $.ajax({
         type: "GET",
         url: "../karyawan/getJabatanKaryawan",
         dataType: "json",
         success: function (r) {
            setTimeout(() => {
             r.karyawan.forEach(v => {
                $('#level').append('<option value="'+v.idj+'" '+cekSelected(v.idj,levels)+'>'+v.nama+' - '+v.nma_jabatan+'</option>');
             });
             setTimeout(() => {
                getKaryawanLevel();
             }, 100);
        }, 300);
         }
     });
  }
 
  function getKaryawanLevel() { 
    $('#block').html('');
    sub_block = [];
    let ok = ''; 
    $('#level').val().forEach((r) => {
        ok += r+',';
    })
     $.ajax({
         type: "GET",
         url: "../karyawan/getKaryawanLevel",
         dataType: "json",
         data : {
             'level' : ok
         },
         success: function (r) {
             r.forEach(v => {
                 $('#block').append('<option value="'+v.id+'" '+cekSelected(v.id,blocks)+' >'+v.nama+'</option>');
             });
             sub_block.push(r);
         }
     });
  }

  function getidMS() {
    if(id_menu == '') return false;

    $.ajax({
        type: "GET",
        url: "getIdMS/"+id_menu,
        dataType: "json",
        success: function (r) {
            $('#x-icon').addClass(r.menu.icon);
            $('#icon').val(r.menu.icon);

            $('#urutan').val(r.menu.urutan);
            $('#menu').val(r.menu.menu);
            $('#target').val(r.menu.target);
            
            var lvl = (r.menu.level).split(',');
            lvl.forEach(r => {
                if(r != '') levels.push(r);
            });

            var blo = (r.menu.block_id).split(',');
            blo.forEach(r => {
                if(r != '') blocks.push(r);
            });

            getSubmenu(r.submenu);
        }
    });
  }

  function getSubmenu(submen) { 
    bsub.html('');
     let no = 0;
     submen.forEach(v => {
         let n = no+v.id;
        bsub.append(`<tr class="${'t'+n}">
        <td style="width: 100px;"><input type="hidden" class="form-control form-control-sm" name="id_sub[]" id="id_sub" value="${v.id}"><input type="number" class="form-control form-control-sm" name="no[]" id="no" value="${v.urutan}"></td>
        <td><input type="text" class="form-control form-control-sm" name="submenu[]" id="submenu" value="${v.submenu}"></td>
        <td><input type="text" class="form-control form-control-sm" name="sub_target[]" id="sub_target" value="${v.target}"></td>
        <td>
            <select class="form-control w-100" class="form-control" name="sub_block[${v.id}][]" id="sub_block${n}" multiple>
            </select>
        </td>
        <td><button type="button" id="del" class="btn btn-sm btn-danger" onclick="hapus('${'.t'+n}',${v.id})"><i class="fa fa-trash"></i></button></td>
        </tr>
        `);

        var blo = (v.sub_block_id).split(',');
        blo.forEach(r => {
            if(r != '') sub_blocks.push([v.id,r]);
        });

        setTimeout(() => {
            sub_block[0].forEach(r => {
                $('#sub_block'+n).append('<option value="'+r.id+'" '+cekSelectedUp(r.id,sub_blocks,v.id)+' >'+r.nama+'</option>'); 
            });
            setTimeout(() => {
                $('#sub_block'+n).select2();
            }, 200);
        }, 1000);
       
        // $('#sub_block'+n).append('<option value="'+x[i].id+'">'+x[i].nama+'</option>'); 
        
        // sub_block.forEach((x,i) => {
            
        //     console.log(x[i].id);
        // });

    });

   }

   $('#icon').change(function (e) { 
       e.preventDefault();
       $('#x-icon').removeClass();
       $('#x-icon').addClass($(this).val());
   });


function cekSelectedUp(id,arr,v) { 
    var ok = '';
    arr.forEach(ar => {
        console.log(ar[0],v);
        if (ar[0] == v) {
            if (ar[1].indexOf(id) != -1) ok = 'selected';
        }
    });
   
    return ok;
    
 }
 
 function cekSelected(id,arr) { 
    if (arr.indexOf(id) != -1) return 'selected';
 }
