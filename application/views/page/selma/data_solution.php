<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Data Master Solution
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#addSolution" class="btn btn-outline-danger">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabelSolution">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Solution</th>
                                <th>Product</th>
                                <th>Last Update</th>
                                <th>Update By</th>
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
<div class="modal fade" id="addSolution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Solution</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript.void(0)" id="formAddSolution">
              <div class="form-row">
                  <div class="col col-md-4">
                      <label>Solution Name</label>
                  </div>
                  <div class="col col-md-8">
                      <input type="text" name="solution" class="form-control">
                  </div>
              </div>
              <div class="form-row">
                  <div class="col col-md-4">
                      <label>Product</label>
                  </div>
                  <div class="col col-md-8">
                      <select name="product" class="form-control"></select>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-right mt-2">
                    <button type="submit" class="btn btn-default" name="btn" >Save</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- edit Modal -->
<div class="modal fade" id="editSolution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Solution</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form  action="javascript.void(0)" id="formUpSolution">
              <div class="form-row">
                  <div class="col col-md-4">
                      <label>Solution Name</label>
                  </div>
                  <div class="col col-md-8">
                      <input type="hidden" name="e_id" class="form-control">
                      <input type="text" name="e_solution" class="form-control">
                  </div>
              </div>
              <div class="form-row mt-2">
                  <div class="col col-md-4">
                      <label>Product</label>
                  </div>
                  <div class="col col-md-8">
                    <select name="e_product" class="form-control"></select>
                  </div>
              </div>
              <div class="row mt-3">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-default" name="btn" >Save</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>