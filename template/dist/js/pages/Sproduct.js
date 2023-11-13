$(document).ready(function() {
    showtable();
    formAddProduct();
    upProduct();
});

function showtable() {
    $('#tabelP').DataTable({
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
          "url": 'dtproduct',
          "type": "POST",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
  }

  function getProduct(id) { 
    $.ajax({
        type: "get",
        url: "getProduct/"+id,
        dataType: "json",
        success: function (r) {
            $('input[name="e_id"]').val(r.id);
            $('input[name="e_product"]').val(r.product);
        }
    });
 }

 function getSolutionAll(id) { 
    $.ajax({
      type: "get",
      url: "getSolution",
      dataType: "json",
      success: function (r) {
          
          var sol = '';

          r.forEach(v => {
            sol += '<option '+(id == v.id ? 'selected' : '')+' value="'+v.id+'">'+v.solution+'</option>';
          });
          
          $('select[name="e_solution"]').html(sol);

      }
    });
 }

  function upProduct() { 
    $('#formUpProduct').submit(function (e) { 
        e.preventDefault();
           $.ajax({
               type: "post",
               url: "upProduct",
               data : $(this).serialize(),
               dataType: "json",
               success: function (r) {
                   if(r.status == 1){
                       Swal.fire({
                           icon: 'success',
                           title: 'Success',
                           text: r.msg,
                       })
                       showtable();
                       $('#editProduct').modal('hide');
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

  function formAddProduct() { 
      $('#formAddProduct').submit(function (e) { 
          e.preventDefault();
            $.ajax({
                type: "post",
                url: "inProduct",
                data : $(this).serialize(),
                dataType: "json",
                success: function (r) {
                    if(r.status == 1){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: r.msg,
                        })
                        showtable();
                        $('#addProduct').modal('hide');
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

  function delProduct(id){
      var r = confirm("Are you sure to delete this data ? ");
    if (r == true) {
        txt = "You pressed OK!";
          $.ajax({
            type: "post",
            url: "delProduct",
            data: {
                'id' : id
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response)
                if(response.status == 1){
                  Swal.fire({
                      icon: 'success',
                      title: 'Success',
                      text: response.msg,
                    })
                  showtable();
                }else{
                  Swal.fire({
                      icon: 'error',
                      title: 'Gagal',
                      text: response.msg,
                    })
                }
              
            }
        });
    } else {
        txt = "You pressed Cancel!";
    }
  }