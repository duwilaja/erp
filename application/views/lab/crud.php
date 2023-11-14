<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if($this->session->userdata('leader') == 1){ ?>
            <div class="row">
            <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                    <form method="post" action="javascript.void(0);" id="form_cari">
                      <div class="row">
                        <div class="col-md-4">
                          <label>Pilih Karyawan</label>
                          <select class="form-control" name="karyawan" id="karyawan">
                          <option value="">-- Pilih Karyawan --</option>
                          <?php foreach ($kary as $v) { ?>
                            <option value="<?=$v->id;?>"><?=$v->nama;?></option>
                          <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" >
                        </div>
                        <div class="col-md-3">
                            <div style="position:absolute;bottom:0;">
                            <input type="submit" class="btn btn-warning" value="Filter">
                            </div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
              </div>
            </div>
            <?php } ?>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                      <div class="col-md-6 col">
                          CRUD
                        </div>
                        <div class="col-md-6 col text-right">
                            <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <?php foreach ($data['list_name'] as $v) { ?>
                                    <th><?=$v;?></th>
                                <?php } ?>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="formAddTask">
              <?=$data['inp'];?>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="formEditDaily">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="e_tgl" class="form-control" id="e_tgl">
              </div>
              <div class="form-group">
                  <label for="">Task</label>
                  <input type="hidden" name="e_id" id="e_id">
                  <textarea name="e_task" id="e_task" class="form-control"></textarea>
              </div>
                <div class="xna text-right">
                    <input type="submit" class="btn btn-warning" value="Save">
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>