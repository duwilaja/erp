<input type="hidden" name="edit" id="edit" value="<?=$this->input->get('edit')?>">
<input type="hidden"  id="device_idx" value="<?=$this->input->get('device_id')?>">

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">RMA</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Device</th>
                                    <th>SN</th>
                                    <th>Status</th>
                                    <th>Desc</th>
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
    </div>
</section>

<!-- Add Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit RMA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="form_edit_rma_device">
              <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered w-100">
                        <tbody>
                            <tr>
                                <td id="txt_device">HSG-1029</td>
                                <td id="txt_sn">SN#21398721</td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5"><label for="">Date RMA</label></div>
                        <div class="col-md-7">
                            <input type="date" name="date_rma" class="form-control" required>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="device_id" id="device_id">
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Status</label></div>
                        <div class="col-md-7">
                            <select name="status" id="status" class="custom-select" required>
                                <option value=""></option>
                                <option value="1">Diperbaiki</option>
                                <option value="2">Di Ganti Baru</option>
                                <option value="3">Sudah Diperbaiki</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="form-group">
                                <div class="nma"><label>Description</label></div>
                                <textarea class="form-control form-control-sm" name="ket" id="ket" placeholder="Fill this description"></textarea>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
              <br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>


