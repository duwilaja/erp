<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title" style="position: relative;top: 5px;">Inventory <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <!-- <a href="<?=site_url('SCM/form_inventory')?>" class="btn btn-success btn-sm">Add New</a> -->
                        <a href="#" data-toggle="modal" data-target="#modal_form_inventory" class="btn btn-success btn-sm">Add New</a>
                </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Purchase Date</th>
                                <th>Total Price</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>Electronic</td>
                            <td>Electronic</td> 
                            <td>Electronic</td> 
                            <td>Electronic</td> 
                            <td><a href="<?=site_url('SCM/detail_inventory_new')?>"><button class="btn btn-default btn-sm" data-target="detail_inventory"><i class="fa fa-box"></i></button></a></td>    
                        </tbody>
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

<!-- Modal Create PO-->
<div class="modal fade" id="modal_form_inventory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Inventory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="post" id="form_inventory" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
                 <div class="col-sm-12">
                    <div class="form-group">
                        <label>Purchase No</label>
                        <input type="text" class="form-control form-control-sm" name="purchaseno" value="" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" id="category" class="form-control form-control-sm">
                            <option value="1">Property</option> 
                            <option value="2">Electronic</option>
                            <option value="3">Project</option>                
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control form-control-sm" name="desc" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Purchase Date</label>
                        <input type="date" class="form-control form-control-sm" name="purchase_date" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Upload Receipt</label>
                        <input type="file" name="file_receipt" id="file_receipt" class="form-control form-control-sm">
                    </div>
                </div>
            <div class="modal-body">
                    <div id="txt_pen" style="display:none;">add</div>
                    <div class="row">
                <div class="col-md-12">
                    <div class="float-right mb-2">
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="merek" value="">
                     <button class="btn btn-success btn-sm" onclick="add()" type="button"><i class="fa fa-plus"></i> Add More</button>
                    </div>
                    <table class="table" id="tabel_list_po">
                        <thead>
                        <tr>
                            <td>Merk</td>
                            <td>Type</td>
                            <td>Qty</td>
                            <td>Price/unit</td>
                        </tr>
                        <thead>
                        <tbody id="list_devices">
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
                <div class="col-md-12">
                    <div id="form_sn">
                        <table class="table table-bordered" id="tabel_sn" style="display:none;">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                </tr>
                            </thead>
                            <tbody id="list_sn">
                                
                            </tbody>
                        </table>
                    </div>
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