<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">List PO <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="<?=site_url('SCM/form_purchase')?>" class="btn btn-info">Add PO</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Desc</td>
                                <td>Date</td>
                                <td>Project</td>
                                <td>Vendor</td>
								<td>Total</td>
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

<div class="modal" id="modal-items"  aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Purchase Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
			<button class="btn btn-success" onclick="add_row();"><i class="fa fa-plus"></i></button>
			<form id="f_po_items">
			<input type="hidden" name="totitem" id="totitem" value="0">
			<input type="hidden" name="poid" id="poid" value="0">
                <table class="table table-bordered table-responsive" style="overflow: scroll; overflow: auto;">
					<thead style="background:#ffc107;color:#FFF;">
						<tr>
							<td>&nbsp;</td>
							<td>#</td>
							<td>Part#</td>
							<td>Description</td>
							<td>Qty</td>
							<td>Unit</td>
							<td>Price</td>
							<td>Currency</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody id="tbody">
						
					</tbody>
				</table>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="save_item('<?=site_url('SCM/save_purchase_item');?>')">Save</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>
