<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col">
                            Ticket Classification
                        </div>
                        <div class="col-md-6 col text-right">
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#mAddTicSubject"><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tblTicKlas" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Classification</th>
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
<div class="modal fade" id="mAddTicSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Ticket Classification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="addTicKlas">
              <div class="form-group">
                  <label for="">Category</label>
                  <select name="kategori" class="form-control" >
                      <option></option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="">Classification</label>
                  <input type="text" name="class" class="form-control" >
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
<div class="modal fade" id="mEditTicSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="mTicSubject">Edit Ticket Classification</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="edtTicKlas">
              <div class="form-group">
                  <label for="">Category</label>
                  <select name="e_kategori" class="form-control" >
                      <option></option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="">Classification</label>
                  <input type="hidden" name="e_id" class="form-control" >
                  <input type="text" name="e_class" class="form-control" >
              </div>
              <div class="xna text-right">
                <input type="submit" class="btn btn-warning" value="Save">
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>