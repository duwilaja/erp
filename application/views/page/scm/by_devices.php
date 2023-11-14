<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">List By Device <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="<?=site_url('SCM/form_device')?>" class="btn btn-success btn-sm">Add Device</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Device</td>
                                <td>Total</td>
                                <td>Used</td>
                                <td>Stock</td>
                                <td>Good</td>
                                <td>Broken</td>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<!-- Modal Import Data-->
<div class="modal fade" id="modal_import_device" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="post" id="upload_device" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="ket mb-3" style="
    background: cornsilk;
    padding: 7px;
    border-radius: 4px;
">Download sempel excel untuk dapat mengimport data device </br><a href="<?=site_url('SCM/down_sd')?>">sempel_excel_device.xls</a></div>
        <div class="file_upload">
            <p>Upload file <span class="text-success">sempel_excel_device.xls</span> yang sudah dimodifikasi datanya</p>
            <input type="file" name="device" id="device" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" id="btn-import" class="btn btn-primary">Import</button>
        <button class="btn btn-primary" id="btn-import-loading" style="display:none;" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
        </button>
      </div>
      </form>
    </div>
  </div>
</div>