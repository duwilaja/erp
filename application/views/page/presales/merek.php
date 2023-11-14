<style>
.select2{
  width:100% !important;
}
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col">
                             Merk
                        </div>
                        <div class="col-md-6 col text-right">
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#model_form_add" ><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tbl_merek" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Solution</th>
                                <th>Merk</th>
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
<div class="modal fade" id="model_form_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Merk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="form_add">
              <div class="form-group">
                  <label for="">Merk</label>
                  <input  name="merek" class="form-control form-control-sm" id="merek">
              </div>
              <div class="form-group">
                  <label for="">Solution</label>
                  <select class="form-control" name="solution"></select>
              </div>
              <div class="xna text-right">
                  <input type="submit" class="btn btn-warning" value="Simpan">
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="model_form_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Merk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="form_edit">
              <div class="form-group">
                  <label for="">Merk</label>
                  <input type="hidden" name="e_id">
                  <input type="text"  name="e_merek" class="form-control form-control-sm" id="e_merek">
              </div>
              <div class="form-group">
                  <label for="">Solution</label>
                  <select class="form-control" name="e_solution"></select>
              </div>
              <div class="xna text-right">
                  <input type="submit" class="btn btn-warning" value="Simpan">
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>