<div class="card">
    <div class="card-header">Create PO</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                  <div class="ket mb-4">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="projek"><span class="txt-projek"><?=$projek->service?></span></div>
                        <div style="font-size:14px;"><span class="txt-cust"><?=$projek->customer?></span> | <span><?=$projek->custend?></span></div>
                      </div>
                      <div class="col-md-6">
                        <div class="files" style="position:absolute;right:0;top:2px;">
                        <span class="txt-file"><a href="<?=$file['kontrak']?>"  target="_blank" class="btn btn-sm btn-default">File Kontrak</a> <a href="<?=$file['po']?>" target="_blank" class="btn btn-sm btn-default">File PO</a></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                    <div class="float-right mb-2">
                     <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_create_po"><i class="fa fa-plus"></i> Create PO</button>
                    </div>
                    <table class="table" id="tabel_list_po">
                        <thead>
                        <tr>
                            <td>No PO</td>
                            <td>Vendor</td>
                            <td>Purchase Date</td>
                            <td>Date Received</td>
                            <td>Total Device</td>
                            <td>File</td>
                            <td></td>
                        </tr>
                        <thead>
                        <tbody id="list_vendors">
                           
                        </tbody>
                    </table>
                </div>
            </div>       
        </div>
</div>

<!-- Modal Import Data-->
<div class="modal fade" id="detail_device" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <div class="row" >
          <form action="<?=site_url('SCM/device_sample')?>" method="post"  enctype="multipart/form-data" id="form_device">
            <div class="col-md-12">
                <div class="data-add-device mb-3">
                    <input type="hidden" name="po_id">
                    <input type="hidden" name="p_id" value="<?=$this->input->get('id');?>">
                    <button type="button" class="btn btn-success btn-sm" onclick="add_device()"><i class="fa fa-plus"></i> Add Device</button>
                </div>
                <div class="list-device">
                </div>
                <div class="data-download-device">
                    <table class="table table-bordered">
                        <tr>
                            <td>Anda dapat mendowload Sampel SN untuk dapat mengimport data device disini.</td>
                            <td><button class="btn btn-sm btn-default" type="submit">Download Sample SN Device</button></td>
                        </tr>
                        <tr>
                            <td>Upload File SN disini</td>
                            <td><input type="file" class="form-control form-control-sm" name="file_device" style="width:200px;"></td>
                        </tr>
                    </table>
                </div>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="btn-import" class="btn btn-warning">Import</button>
        <button class="btn btn-primary" id="btn-import-loading" style="display:none;" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
        </button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Create PO-->
<div class="modal fade" id="modal_create_po" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add PO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="post" id="form_create_po" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="project_id" value="<?=$this->input->get('id');?>">
        <div class="row" >
            <div class="col-md-12">
                <div class="data-add-device mb-3">
                    <button type="button" class="btn btn-success btn-sm" onclick="add()"><i class="fa fa-plus"></i> Add PO</button>
                </div>
            </div>
            <div class="col-md-12">
               <table class="table" id="tabel_list_po">
                <thead>
                <tr>
                    <td>No PO</td>
                    <td>Vendor</td>
                    <td>Purchase date</td>
                    <td>Date Received</td>
                    <td>File</td>
                    <td></td>
                </tr>
                <thead>
                <tbody id="list_vendor">
                </tbody>
               </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" id="btn-save" class="btn btn-warning">Save</button>
        <button class="btn btn-primary" id="btn-save-loading" style="display:none;" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
        </button>
      </div>
      </form>
    </div>
  </div>
</div>