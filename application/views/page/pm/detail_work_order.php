<style>
  .pp{
    width: 100px;
    height: 100px;
  }

  .file {
    overflow: hidden;
  }

  .nav-pills .nav-link.active,
  .nav-pills .show>.nav-link{
    color: #fff;
    background-color: #ED0714;
    border-radius: 100px;
    width: 100px;
    text-align: center;
  }

  .lblpersen {
    color: #fff;
    background-color: #ED0714;
    border-radius: 100px;
    width: 100px;
    font-size: 1.3rem;
    text-align: center;
  }

  .nav-pills .nav-link:not(.active):hover{
    color:#ED0714;
  }

  .avatar {
    border-radius : 50%;
    width: 3rem;
    height: 3rem;
    text-align: center;
    align:center;
    color: #fff;
    font-size: 2rem;
  }

  .bg-yellow, .bg-yellow>a {
    color: #fff!important;
  }
</style>

<?php
$s = $projekPm->status;

  if($s == 0){
    $s = "";
  }else if($s == 1){
    $s = "Approval";
  }else if ($s == 2) {
    $s = "DRM";
  }else if ($s == 3) {
    $s = "KOM";
  }else if ($s == 4) {
    $s = "Implementasi Projek";
  }else if ($s == 5) {
    $s = "BAST Projek";
  }else if ($s == 6) {
    $s = "Closed";
  }
  
?>

<div class="row">
  <a href="<?=site_url("PM/work_order")?>" class="btn btn-primary ml-auto mr-3 mb-2"><i class="fa fa-arrow-left"></i> Back</a>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-5">
                <div class="nama_projek">Work Order <?= $projekPm->service?></div>
            </div>
            <div class="ml-auto">
              <a href="javascript:void(0)" class="btn btn-warning" onclick="modal_edit()"><i class="fa fa-edit"></i></a>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 border-right mx-1">
              <h3 class="mb-0 text-bold"><?= $projekPm->service?></h3>
              <p class="text-muted"><?= $cust->customer?> - <?= $custend->custend?></p>
            </div>
            <div class="col-md-3 border-right mx-1">
              <p class="mb-0 text-muted">Masa Kontrak</p>
              <p class="text-bold"><?= $projekPK->start_date?> - <?= $projekPK->end_date?></p>
            </div>
            <div class="col-md-2 mx-1 border-right">
              <p class="mb-0 text-muted">Status</p>
              <p class="text-bold"><?= $s ?></p>
            </div>
            <div class="col-md-1 p-0 mx-1 border-right">
              <p class="mb-0 text-muted">Persentase</p>
              <p class="text-bold" id="persentase"></p>
            </div>
            <div class="ml-auto">
              <div class="row mr-3 mt-2">
                <?php if ($projekPK->work_devision == '1') {?>
                  <div class="avatar bg-success ml-1">D</div>
                <?php }else if($projekPK->work_devision == '2') {?>
                  <div class="avatar bg-blue mr-1">S</div>
                <?php }else if($projekPK->work_devision == '3') {?>
                  <div class="avatar bg-blue mr-1">S</div>
                  <div class="avatar bg-success ml-1">D</div>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <ul class="nav nav-pills justify-content-end mb-2">
          <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#tab1" aria-current="page" >Detail</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tab2">Timeline</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tab3">DRM</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tab4">History</a>
          </li>
      </ul>

      <div class="tab-content border-top">
        <div id="tab1" class="tab-pane fade mt-2  show in active" role="tabpanel" aria-labelledby="tab1-tab">
            <div class="row my-4">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3 id="task"></h3>

                    <p>Task</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-tasks"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3 id="complete"></h3>

                    <p>Complete</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3 id="progress"></h3>

                    <p>On Progress</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-spinner"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3 id="pending"></h3>

                    <p>Pending</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-exclamation-circle"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <?php if ($projekPK->work_devision == '1') {?>
              <div class="card p-2">
                <div class="mycard rounded">
                  <div class="row">
                    <div class="col ml-3 my-2">
                      <h4>Development</h4>
                    </div>
                    <div class="ml-auto mr-3">
                      <div class="lblpersen mt-2">90%</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa fa-tasks"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Task</span>
                          <span class="info-box-number">1,410</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-calendar-check"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Complete</span>
                          <span class="info-box-number">0</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-spinner"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">On Progress</span>
                          <span class="info-box-number">0</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fas fa-exclamation-circle"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Pending</span>
                          <span class="info-box-number">0</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <table class="table table-condensed" id="tabel_development" style="width:100%;">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date Done</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            <?php }else if($projekPK->work_devision == '2') {?>
              <div class="card p-2">
                <div class="mycard rounded">
                  <div class="row">
                    <div class="col ml-3 my-2">
                      <h4>Serdev</h4>
                    </div>
                    <div class="ml-auto mr-3">
                      <div class="lblpersen mt-2" id="st_persentase"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa fa-tasks"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Task</span>
                          <span class="info-box-number" id="st_task"></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-calendar-check"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Complete</span>
                          <span class="info-box-number" id="st_complete"></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-spinner"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">On Progress</span>
                          <span class="info-box-number" id="st_progress"></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fas fa-exclamation-circle"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Pending</span>
                          <span class="info-box-number" id="st_pending"></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <table class="table table-condensed" style="width:100%;" id="tabel_serdev">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date Done</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            <?php }else if($projekPK->work_devision == '3') {?>
              <div class="card p-2">
                <div class="mycard rounded">
                  <div class="row">
                    <div class="col ml-3 my-2">
                      <h4>Development</h4>
                    </div>
                    <div class="ml-auto mr-3">
                      <div class="lblpersen mt-2">90%</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa fa-tasks"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Task</span>
                          <span class="info-box-number">1,410</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-calendar-check"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Complete</span>
                          <span class="info-box-number">0</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-spinner"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">On Progress</span>
                          <span class="info-box-number">0</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fas fa-exclamation-circle"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Pending</span>
                          <span class="info-box-number">0</span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <table class="table table-condensed" id="tabel_development" style="width:100%;">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date Done</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card p-2">
                <div class="mycard rounded">
                  <div class="row">
                    <div class="col ml-3 my-2">
                      <h4>Serdev</h4>
                    </div>
                    <div class="ml-auto mr-3">
                      <div class="lblpersen mt-2" id="st_persentase"></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="fa fa-tasks"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Task</span>
                          <span class="info-box-number" id="st_task"></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-calendar-check"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Complete</span>
                          <span class="info-box-number" id="st_complete"></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-spinner"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">On Progress</span>
                          <span class="info-box-number" id="st_progress"></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                      <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fas fa-exclamation-circle"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">Pending</span>
                          <span class="info-box-number" id="st_pending"></span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                      <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <table class="table table-condensed" id="tabel_serdev" style="width:100%;">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Date Done</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            <?php }?>
        </div>
        
        <div id="tab2" class="tab-pane fade">
          <div class="row mt-2">
              <div class="col-md-12 text-right">
                <a href="javascript:void(0)" onclick="modal_upload_timeline()" class="btn btn-outline-success btn-sm"><i class="fas fa-upload"></i> Upload</a>
                <!-- <a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a> -->
              </div>
              <div class="col-md-12 text-center" id="f_timeline">
              </div>
            </div>
        </div>

        <div id="tab3" class="tab-pane fade">
          <div class="card mt-3">
            <h3 class="font-weight-light text-center">Catatan</h3>
          <form action="javascript:void(0);" id="form_drm" type="post">
            <div class="p-2">
              <input type="hidden" name="idpk" value="<?= $projekPK->id ?>">
              <input type="hidden" name="iddrm" value="<?= @$pm_drm->id ?>">
              <textarea name="catatan" class="form-control" placeholder="Catatan..." rows="5" id="catatan"></textarea>
            </div>
            <div class="p-2">
              <table class="table table-bordered table-striped" id='tblfile'>
                <thead>
                  <tr>
                    <th>Nama File</th>
                    <th>File</th>
                    <th>Jenis</th>
                    <th class="text-center"><a class="btn btn-success" onClick="tambah()"><i class="fas fa-plus text-white"></i></a></th>
                  </tr>
                </thead>
                <tbody id="bfile">
                  <tr id="tr1">
                    <td><input type="text" class="form-control" name="nama_file[]" id="nama1"></td>
                    <td><input type="file" class="form-control file" name="file[]" id="file1"></td>
                    <td><select name="jenis[]" id="jenis" class="form-control">
                          <option value="BAI">BAI</option>
                          <option value="BST">BST</option>
                        </select>
                    </td>
                    <td class="text-center" ><button class="btn btn-danger"><i class="fas fa-trash text-white" onClick="hapus(1)"></i></button></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <button type="submit" class="btn btn-info float-right mb-2 mr-2" id="btnDRM"><i class="fa fa-upload"></i> Upload</button>
          </form>
          </div>
        </div>

        <div id="tab4" class="tab-pane fade">
          <div class="card mt-2">
              <div class="card-body">
                <table class="table table-bordered table-striped" id="tabel_histori" style="width:100%;">
                  <thead class="bg-dark">
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Keterangan</th>
                      <th>Tanggal</th>
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
</div>

<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 col">
              <p class="font-weight-light">Nama File</p>
          </div>
          <div class="col-md-8 col">
              <p>: test.pdf</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col">
              <p class="font-weight-light">Upload By</p>
          </div>
          <div class="col-md-8 col">
              <p>: diva</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col">
              <p class="font-weight-light">Tanggal Upload</p>
          </div>
          <div class="col-md-8 col">
              <p>: 28-12-2020</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript::void(0);" id="" type="post">
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Status</label>
                </div>
                <div class="col-md-9">
                <input type="hidden" name="id" id="idUpdate" value="<?= $projekPm->id ?>">
                  <select name="status" id="status" class="form-control">
                      <option value="">-- Pilih Status Projek --</option>
                      <option value="1" <?= $projekPm->status == '1' ? 'selected' : '';?>>Approval</option>
                      <option value="2" <?= $projekPm->status == '2' ? 'selected' : '';?>>DRM</option>
                      <option value="3" <?= $projekPm->status == '3' ? 'selected' : '';?>>KOM</option>
                      <option value="4" <?= $projekPm->status == '4' ? 'selected' : '';?>>Implementasi Projek</option>
                      <option value="5" <?= $projekPm->status == '5' ? 'selected' : '';?>>BAST Projek</option>
                      <option value="6" <?= $projekPm->status == '6' ? 'selected' : '';?>>Closed</option>
                  </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Divisi</label>
                </div>
                <div class="col-md-9">
                <input type="hidden" name="idpk" id="idUpdatePK" value="<?= $projekPK->id ?>">
                <input type="hidden" name="iddiv" id="idDivision" value="<?= $projekPK->work_devision ?>">
                  <select name="devision" id="devision" class="form-control">
                      <option value="">-- Pilih Devision Projek --</option>
                      <option value="1" <?= $projekPK->work_devision == '1' ? 'selected' : '';?>>Development</option>
                      <option value="2" <?= $projekPK->work_devision == '2' ? 'selected' : '';?>>Serdev</option>
                      <option value="3" <?= $projekPK->work_devision == '3' ? 'selected' : '';?>>Development & Serdev</option>
                  </select>
                </div>
            </div>
      </div>
      <div class="modal-footer">
      </div>
		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_upload_timeline" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Timeline</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0);" id="addTimeline" type="post">
        <input type="hidden" name="idpk" value="<?= $projekPK->id ?>">
            <div class="row">
                <div class="col-md-3 my-2">
                    <label for="" class="font-weight-normal">Nama File</label>
                </div>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="nama_file_timeline" id="nama_file_timeline" value="" required>
                </div>
                
                <div class="col-md-3 my-2">
                    <label for="" class="font-weight-normal">File</label>
                </div>
                <div class="col-md-9">
                  <input type="file" class="form-control" name="file_timeline" id="file_timeline" value="" required>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnTimeline">Upload</button>
      </div>
		</form>
    </div>
  </div>
</div>

<script>

function tambah()
  {
    var tbl = $('#tblfile');
    var lastRow = tbl.find("tr").length;
    var idlast = lastRow -1;
    var emptyrows = 0;
    for (i=idlast; i<lastRow; i++) {
      if ($("#nama"+i).val() == '' || $("#file"+i).val() == '' || $("#jenis"+i).val() == '' ) {
        emptyrows += 1;
      }
    }
      
    if (emptyrows == 0 ) {
      var opt = '';
      
      var nama = '<input type="text" class="form-control" name="nama_file[]" id="nama'+lastRow+'" data-rule-required="true" multiple/>'
      var file = '<input type="file" class="form-control file pb-2" name="file[]" id="file'+lastRow+'" data-rule-required="true" multiple/>';
      var jenis = '<select name="jenis[]" id="jenis" class="form-control"><option value="BAI">BAI</option><option value="BST">BST</option></select>'
      var trash = '<button class="btn btn-danger"><i class="fas fa-trash text-white" onClick="hapus('+lastRow+')"></i></button>';
      tbl.append("<tr id='tr"+lastRow+"'><td>"+nama+"</td><td>"+file+"</td><td>"+jenis+"</td><td><center>"+trash+"</center></td></tr>");
    } else  {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Silahkan mengisi data pada baris yang tersedia terlebih dahulu, sebelum menambah baris'
      })
    }
  }

function hapus(id){
    $('#tblfile #tr'+id).remove();
  }	;

</script>
