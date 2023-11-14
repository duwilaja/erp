<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col">
                            Ticket Category
                        </div>
                        <div class="col-md-6 col text-right">
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#mAddTicCategory"><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tblticCategory" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>#</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="mAddTicCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Ticket Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="addTicCategory">
              <div class="form-group">
                  <label for="">Category</label>
                  <input type="text" name="category" id="category">
              </div>
                <div class="xna text-right">
                    <input type="submit" class="btn btn-warning" value="Save">
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="mEditTicCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Ticket Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="edtTicCategory">
              <div class="form-group">
                  <label for="">Category</label>
                  <input type="hidden" name="e_id">
                  <input type="text" name="e_category" class="form-control" id="category">
              </div>
                <div class="xna text-right">
                    <input type="submit" class="btn btn-warning" value="Save">
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>