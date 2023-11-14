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
                             Layanan
                        </div>
                        <div class="col-md-6 col text-right">
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#mAddTicLayanan" onclick="getAddTicLayanan()"><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tblticLayanan" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Layanan</th>
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
<div class="modal fade" id="mAddTicLayanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Layanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="addTicLayanan">
              <div class="form-group">
                  <label for="">Customer</label>
                  <br>
                  <select  name="customer" id="customer" required></select>
              </div>
              <div class="form-group">
                  <label for="">Layanan</label>
                  <select  name="layanan" class="form-control form-control-sm" id="layanan"></select>
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
<div class="modal fade" id="mEditTicLayanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Layanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="edtTicLayanan">
              <div class="form-group">
                  <label for="">Customer</label>
                  <select  name="e_custend" id="custend"></select>
              </div>
              <div class="form-group">
                  <label for="">Layanan</label>
                  <input type="hidden" name="e_id">
                  <select  name="e_layanan" class="form-control form-control-sm" id="e_layanan"></select>
              </div>
                <div class="xna text-right">
                    <input type="submit" class="btn btn-warning" value="Simpan">
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>