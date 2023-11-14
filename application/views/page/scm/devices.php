<style>
  tr td{
        white-space: nowrap;
    }
</style>
<section class="content">
   
    <form action="javascript:void(0);" id="filter_devices">
    <div class="row mb-4">
        <div class="col-md-2">
            <select name="device" id="device" class="form-control form-control-sm">
               <option value="">-- Select Device --</option>
               <?php foreach ($device->result() as $v) { ?>
                <option value="<?=$v->val;?>" <?=$this->input->get('device') == $v->val ? 'selected' : ''?> ><?=$v->val;?></option>
               <?php } ?>                
            </select>
        </div>
        <div class="col-md-2">
            <select name="project" id="project" class="form-control form-control-sm">
                <option value="">-- Select Project --</option>
                <?php foreach ($project->result() as $v) { ?>
                    <option value="<?=$v->project;?>"><?=$v->val;?></option>
                <?php } ?>                
            </select>
        </div>
        <div class="col-md-2">
            <select name="condition" id="condition" class="form-control form-control-sm">
                <option value="">-- Select Condition --</option>
                <?php foreach ($status->result() as $v) { ?>
                    <option value="<?=$v->val;?>"><?=$v->val;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="used" id="used" class="form-control form-control-sm">
                 <option value="">-- Select Used --</option>
                <?php foreach ($used->result() as $v) { ?>
                    <option value="<?=$v->val;?>"><?=$v->val;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="allocation" id="allocation" class="form-control form-control-sm">
                 <option value="">-- Select Allocation --</option>
                <?php foreach ($allocation->result() as $v) { ?>
                    <option value="<?=$v->val;?>"><?=$v->val;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-danger btn-sm">Filter</button>
            <button type="reset" class="btn btn-default btn-sm" onclick="showtable()">Reset</button>
        </div>
    </div>
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">List All Device <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal_import_device">Import Data</a>
                        <a href="<?=site_url('SCM/form_device')?>" class="btn btn-success btn-sm">Add Device</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table" style="overflow: scroll;
                    overflow: auto; ">
                        <thead>
                            <tr>
                                <td>S/N</td>
                                <td>Device</td>
                                <td>PO#</td>
                                <td>Received</td>
								<td>Project</td>
								<td>Delivered</td>
								<td>Condition</td>
								<td>Allocation</td>
								<td>Used</td>
								<td>Desc</td>
								<td>&nbsp;</td>
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