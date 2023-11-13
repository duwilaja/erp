function projek() {
    $('#card').html('')
    $.ajax({
        type: "GET",
        url: "../PM/getFilePm",
        data:{
          'projek' : $('#pjk').val(),
          'kategori' : $('#ktg').val(),
          'cari' : $('#search').val()
        },
        dataType: "json",
        success: function (data) {
          if(data == '')
          {
            $('#load_data_message').html('<div class="text-muted d-flex"><h4 class="mx-auto">No More Result Found</h4></div>');
            action = 'active';
          }
          else
          {
            data.forEach(v => {
                let extension = v.file.split('.').pop();
                if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
                    extensionn = 'image'
                }else if(extension == 'docx'){
                    extensionn =  'word'
                }else if(extension == 'xlsx') {
                    extensionn =  'excel'
                }else if(extension == 'pdf') {
                    extensionn =  'pdf'
                }else{
                    extensionn = 'alt'
                }
                var file = v.file.replace(/\.[^.]*$/,'')
                    $('#card').append(`
                    <div class="col-xl-3 col-md-6 cari">
                    <div class="card">
                        <div class="mx-auto pt-3">
                            <i class="fas fa-file-${extensionn} font-100 op02"></i> <br>
                        </div>
                        <hr>
                        <a href="../data/projek/file/${v.file}" class="a">
                            <div class="card-body pt-0">
                                <h5 class="card-title float-none"><i class="fas fa-file-${extensionn} op02 mr-3" style="font-size: 15px;"></i>${v.nama_file}</h5>
                                <p class="card-text"><small class="text-muted"></small></p>
                            </div>
                        </a>
                    </div>
                    </div>
                `)
                // $('#pagination_link').html(r.pagination_link);
            });
            $('#load_data_message').html("");
            action = 'active';
          }
        }
      });
}

var limit = 4;
var start = 0;
var action = 'inactive';
$(document).ready(function () {
    $('#pjk').select2();
    getProjek()

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

function load_data(limit, start)
    {
      $.ajax({
        url:"../PM/getFilePm",
        method:"POST",
        data:{limit:limit, start:start},
        cache: false,
        dataType: "json",
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<div class="text-muted d-flex"><h4 class="mx-auto">No More Result Found</h4></div>');
            action = 'active';
          }
          else
          {
            // $('#card').append(data);
            data.forEach(v => {
                let extension = v.file.split('.').pop();
                if (extension == 'jpg' || extension == 'jpeg' || extension == 'png') {
                    extensionn = 'image'
                }else if(extension == 'docx'){
                    extensionn =  'word'
                }else if(extension == 'xlsx') {
                    extensionn =  'excel'
                }else if(extension == 'pdf') {
                    extensionn =  'pdf'
                }else{
                    extensionn = 'alt'
                }
                var file = v.file.replace(/\.[^.]*$/,'')
                    $('#card').append(`
                    <div class="col-xl-3 col-md-6 cari">
                    <div class="card">
                        <div class="mx-auto pt-3">
                            <i class="fas fa-file-${extensionn} font-100 op02"></i> <br>
                        </div>
                        <hr>
                        <a href="../data/projek/file/${v.file}" class="a">
                            <div class="card-body pt-0">
                                <h5 class="card-title float-none"><i class="fas fa-file-${extensionn} op02 mr-3" style="font-size: 15px;"></i>${v.nama_file}</h5>
                                <p class="card-text"><small class="text-muted"></small></p>
                            </div>
                        </a>
                    </div>
                    </div>
                `)
                // $('#pagination_link').html(r.pagination_link);
            });
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#card").height() && action == 'inactive')
      {
        lazzy_loader(1);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });

    // $("#search").on("keyup", function() {
    //     var value = $(this).val().toLowerCase();
 
    //     $("#card .cari").filter(function() {
        
    //         $(this).toggle($(this).html().toLowerCase().indexOf(value) > -1)
        
    //     });
        
    // });
});

function getProjek() {
    $.ajax({
        type: "GET",
        url: "../PM/getProjek",
        dataType: "json",
        success: function (r) {
            r.forEach(v => {
            $('#pjk').append('<option value="'+v.id+'" >'+v.service+'</option>');
            });
        }
    });
  }

