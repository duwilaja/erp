<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detail Customer Device</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 id="custend">-</h4>
                            <h5><strong id="service">-</strong></h5>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-left">
                                <p>Import Data Device disini</p>
                                <a href="<?=site_url('oprations/download_cd/'.$this->uri->segment(3))?>" class="btn btn-success btn-sm mr-2">Download Sempel Import</a><a href="#" data-toggle="modal" data-target="#modal_import_device" class="btn btn-warning btn-sm mr-2">Import Device</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Node ID</th>
                                    <th>SN</th>
                                    <th>Device</th>
                                    <th>IP</th>
                                    <th>Access</th>
                                    <th>Port</th>
                                    <!-- <!-- <th>User</th> -->
                                    <th>Enable</th>
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

 <!-- Modal -->
<div class="modal fade" id="modal_import_device" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Data Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" id="form_import"  enctype="multipart/form-data">
        <div class="modal-body">
            <p>* Data yang ingin di upload harus data Excel dari <b>Sempel Import</b> yang sudah didownload dan tidak boleh diganti nama filenya</p>
            <input type="file" name="device">
            <input type="hidden" name="id" id="id" value="<?=$this->uri->segment(3)?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
    </div>
  </div>
</div>
