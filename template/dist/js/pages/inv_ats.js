$(document).ready(function() {
    $('.js-example-basic-single').select2();
    showtable();
    total_data();
    approve();
    reject();
    no_action();
    reset();
    $("#UpdForm").submit(function(event){
      upd_ats();
      reset();
      return false;
    });
    $("#filters").submit(function(event){
        showtable();
        return false;
    });
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
          "url": 'inv_dt_tbl',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          // "targets": [5],
          // "orderable": false
        }]
      });
  }


  function edit_ats(obj){
    var id = obj.getAttribute("value");
    $('#Upd-modal').modal('show');
    $('#id_upd').val(obj.getAttribute("value"));
  }

  function upd_ats(){
    $.ajax({
    type: "POST",
    url: "../SCM/upd_ats",
    cache:false,
    data: $('form#UpdForm').serialize(),
    success: function(response){
          $("#Upd").html(response)
          $("#Upd-modal").modal('hide');
          Swal.fire(
            'Berhasil',
            'Mengupdate Data!',
            'success'
          );
          showtable();
          total_data();
          approve();
          reject();
          no_action();
    },
    error: function(){
      alert("Error");
    }
    });
  }

  function refreshPage() { 
    location.reload(); 
  }
  function reset() {
    $('button[type="reset"]').click(function (e) { 
        showtable();
        refreshPage();
    }); 
  }


function total_data(){
    $.ajax({
        type: "POST",
        url: "../SCM/inv_total_ats",
        cache:false,
        data:{status: ''},
        success: function(response){
            // alert(response);
            $("#total_data").html("<b>"+response+"</b>");
        },
        error: function(){
          alert("Error");
        }
    });
}
function approve(){
    $.ajax({
      type: "POST",
      url: "../SCM/inv_total_ats",
      cache:false,
      data:{status: '1'},
      success: function(response){
          // alert(response);
          $("#approve").html("<b>"+response+"</b>");
      },
      error: function(){
        alert("Error");
      }
  });

}

function reject(){

    $.ajax({
      type: "POST",
      url: "../SCM/inv_total_ats",
      cache:false,
      data:{status: '2'},
      success: function(response){
          // alert(response);
          $("#reject").html("<b>"+response+"</b>");
      },
      error: function(){
        alert("Error");
      }
  });
  
}
function no_action(){
    $.ajax({  
      type: "POST",
      url: "../SCM/inv_total_ats",
      cache:false,
      data:{status: '3'},
      success: function(response){
          // alert(response);
          $("#no_action").html("<b>"+response+"</b>");
      },
      error: function(){
        alert("Error");
      }
  });
  
}
  