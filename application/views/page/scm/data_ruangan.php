<div class="card">
    <div class="card-header">Data Ruangan</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-right mb-2">
                     <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_in_data_ruangan"><i class="fa fa-plus"></i> Tambah Ruangan</button>
                    </div>
                    <table class="table" id="tabel_data_ruangan">
                        <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Ruangan</td>
                            <td>Status Ruangan</td>
                            <td></td>
                        </tr>
                        <thead>
                        <tbody id="daftar_data_ruangan">
                           
                        </tbody>
                    </table>
                </div>
            </div>       
        </div>
</div>

<!-- Modal Import Data-->
<div class="modal fade" id="modal_detail_data_ruangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Data Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <label>Nama Ruangan</label>
                <div id="txt_nama_ruangan"></div>
            </div>
            <div class="col-md-12">
                <label>Keterangan Ruangan</label>
                <div id="txt_status_ruangan"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Ruangan-->
<div class="modal fade" id="modal_in_data_ruangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="post" id="form_in_data_ruangan">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control form-control-sm" placeholder="Masukan nama ruangan">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
        <button type="submit" id="btn-save" class="btn btn-warning">Simpan</button>
        <button class="btn btn-primary" id="btn-save-loading" style="display:none;" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
        </button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Ruangan-->
<div class="modal fade" id="modal_up_data_ruangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Ruangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="post" id="form_up_data_ruangan">
      <div class="modal-body">
        <input type="hidden" name="id" id="id" value="">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Nama Ruangan</label>
                    <input type="text" name="e_nama_ruangan" id="e_nama_ruangan" class="form-control form-control-sm" placeholder="Masukan nama ruangan">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Status Ruangan</label>
                    <select name="e_aktif" id="e_aktif" class="form-control form-control-sm">
                        <option value=''> -- Pilih Status Ruangan --</option>
                        <option value='1'>Aktif</option>
                        <option value='0'> Non Aktif</option>
                    </select>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="btn-upd" class="btn btn-warning">Save</button>
        <button class="btn btn-primary" id="btn-upd-loading" style="display:none;" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
        </button>
      </div>
      </form>
    </div>
  </div>
</div>