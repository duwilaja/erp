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
                            Node
                        </div>
                        <div class="col-md-6 col text-right">
                            <a href="#" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#modal_import_node">Import</a>
                            <a href="#" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal_gsn_node">Generate Sample Node</a>
                            <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal_add_node"><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tabel_node" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Node</th>
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
<div class="modal fade" id="modal_add_node" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Node</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="form_add_node">
              <div class="form-group">
                <label for="node_id">Node</label>
                <input type="text" name="node" id="node" class="form-control" required>
              </div>
              <div class="form-group">
                  <label for="customer">Customer</label>
                  <br>
                  <select  name="cust" id="customer"  class="form-control" onchange="getCusTicLayanan('',this.value,'layanan')"></select>
              </div>
              <div class="form-group">
                  <label for="layanan">Layanan</label>
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
<div class="modal fade" id="modal_edit_node" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Node</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="form_edit_node">
              <div class="form-group">
                <label for="node_id">Node</label>
                <input type="hidden" name="e_id" id="e_id" class="form-control">
                <input type="text" name="e_node" id="e_node" class="form-control">
              </div>
              <div class="form-group">
                  <label for="">Customer</label>
                  <select  name="e_cust" id="e_custend" class="form-control" onchange="getCusTicLayanan('',this.value,'e_layanan')"></select>
              </div>
              <div class="form-group">
                  <label for="">Layanan</label>
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

<!-- Import Node -->
<div class="modal fade" id="modal_import_node" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import Node</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="javascript:void(0);" method="post" id="form_import_node">
        <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                      <p>Masukan file sample node untuk import data</p>
                      <input type="file" name="file_node" class="form-control form-control-sm">
                  </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" id="btn-import" class="btn btn-success">Import</button>
          <button class="btn btn-success" id="btn-import-loading" style="display:none;" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Loading...
          </button>
        </div>
        </form>
      </div>
    </div>
  </div>

<!-- Generate Sample Node -->
<div class="modal fade" id="modal_gsn_node" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Generate Sample Node</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?=site_url('Oprations/node_sample')?>" method="post" id="form_gsn_node">
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Customer</th>
                      <th>Layanan</th>
                      <th>Jumlah</th>
                      <th><button type="button" id="tmb_node_list" onclick="add()" class="btn btn-primary">tambah</button></th>
                    </tr>
                  </thead>
                  <tbody id="tbody_node">
                  </tbody>
              </table>
              <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-default float-right">Download Sample Node</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>