<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            List Training
                        </div>
                        <div class="col-md-8 text-right">
                            <a href="<?=site_url('training/add_training')?>" class="btn btn-danger"><i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table  id="tabel" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Karyawan</th>
                                <th>Pelatihan</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Status</th>
                                <th>Action</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0)" id="formStatusPelatihan">
              <div class="form-group">
                  <label for="">Status</label>
                  <input type="hidden" name="idp" id="idp">
                  <select name="status" class="custom-select" onchange="formStatusPelatihan(this.value)">
                    <option value="1">Pending</option>
                    <option value="2">Diterima</option>
                    <option value="3">Ditolak</option>
                    <option value="4">Sedang Berjalan</option>
                    <option value="5">Lulus</option>
                    <option value="6">Tidak Lulus</option>
                  </select>
              </div>
          </form>
        </div>
       
      </div>
    </div>
  </div>