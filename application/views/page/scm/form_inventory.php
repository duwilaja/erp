<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title">Form Inventory</h3>
    </div>
    <form role="form" method="POST" action="javascript:void(0);" id="form_inventory">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
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
                        <label>Quantity</label>
                        <input type="number" class="form-control form-control-sm" name="qty" onchange="cetak_sn()" placeholder="" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Merk</label>
                        <select name="merek" onchange="get_type('','#type',this.value)" class="form-control form-control-sm">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Price/Unit</label>
                        <input type="text" class="form-control form-control-sm" name="price" placeholder="" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" id="type" class="form-control form-control-sm">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Total Price</label>
                        <input type="text" class="form-control form-control-sm" name="total_price" placeholder="" value="">
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
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
            <button type="submit" id="btn-save" class="btn btn-warning">Save</button>
            <button class="btn btn-primary" id="btn-save-loading" style="display:none;" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
            </div>
        </div>
        
    </form>
    
</div>