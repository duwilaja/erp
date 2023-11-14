<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Data Master Sales
                        </div>
                        <!-- <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-danger">Add New</a>
                        </div> -->
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tableSa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sales</th>
                                <th>Last Update</th>
                                <th>Update By</th>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Sales</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
              <div class="form-row">
                  <div class="col col-md-4">
                      <label>Sales Name</label>
                  </div>
                  <div class="col col-md-8">
                      <input type="text" name="sales" class="form-control">
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Sales</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
              <div class="form-row">
                  <div class="col col-md-4">
                      <label>Sales Name</label>
                  </div>
                  <div class="col col-md-8">
                      <input type="text" name="e_sales" class="form-control">
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>