<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Data Master Products
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#addProduct" class="btn btn-outline-danger">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabelP">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Last Update</th>
                                <th>Created By</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- add Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript.void(0);" method="post" id="formAddProduct">
              
              <div class="row">
                  <div class="col col-md-4">
                      <label>Product Name</label>
                  </div>
                  <div class="col col-md-8">
                      <input type="text" name="product" class="form-control">
                  </div>
               </div>

               <div class="row">
                <div class="col-md-12 text-right mt-2">
                    <button type="submit" class="btn btn-danger" name="btn">Save</button>
                </div>
              </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- edit Modal -->
<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form action="javascript.void(0);"  method="post" id="formUpProduct">
                <div class="row">
                  <div class="col col-md-4">
                      <label>Product Name</label>
                  </div>
                  <div class="col col-md-8">
                      <input type="hidden" name="e_id" class="form-control">
                      <input type="text" name="e_product" class="form-control">
                  </div>
               </div>
               <div class="row">
                <div class="col-md-12 text-right mt-2">
                    <button type="submit" class="btn btn-danger" name="btn">Save</button>
                </div>
              </div>

            </form>

        </div>
      </div>
    </div>
  </div>