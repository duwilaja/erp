<style>
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #E91E63;
    background-color: #FFF;
    border-radius: 20px;
    border: solid 1px #E91E63;
}

.nav-pills .nav-link:not(.active):hover {
    color: #E91E63;
}

.ths{
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}

</style>
<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">All Inventory <span id="txtLE"></span></h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="
                        border-bottom: solid 1px #DDD;
                        padding-bottom: 17px;">
						<li class="nav-item">
							<a class="nav-link active" id="all_inventory_tab" data-toggle="pill" href="#all-inventory" role="tab" aria-controls="all-inventory" aria-selected="true">All</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="property_tab" data-toggle="pill" href="#property" role="tab" aria-controls="property" aria-selected="false">Property</a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" id="electronic_tab" data-toggle="pill" href="#electronic" role="tab" aria-controls="electronic" aria-selected="true">Electronic</a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" id="project_tab" data-toggle="pill" href="#project" role="tab" aria-controls="project" aria-selected="true">Project</a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="all-inventory" role="tabpanel" aria-labelledby="all_inventory_tab">
                            <table id="tabel_all" class="table w-100 ths">
                                <thead>
                                    <tr>
                                        <td>Category</td>
                                        <td>Merk</td>
                                        <td>Type</td>
                                        <td>SN</td>
                                        <td>Condition</td>
                                        <td>Purchase Date</td>
                                        <td>Mutation</td>
                                        <td>Allocation</td>
                                        <td>Handover Date</td>
                                        <td>Return Date</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Electronic</td>
                                        <td>Smart LED</td>
                                        <td>Samsung LED 55"</td>
                                        <td>SMSG12345</td>
                                        <td>Good</td>
                                        <td>1/2/2020</td>
                                        <td>Office</td>
                                        <td>Lantai 3</td>
                                        <td>2/2/2020</td>
                                        <td>-</td>
                                        <td>
                                            <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#editModal"><i class="far fa-edit"></i></button>
                                            <a href="<?=site_url('SCM/history_inventory')?>"><button class="btn btn-default btn-sm"><i class="far fa-eye "></i></button></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> 
                        </div>
						<div class="tab-pane fade" id="property" role="tabpanel" aria-labelledby="property_tab">
                            <table id="tabel_property" class="table w-100">
                            <thead>
                                <tr>
                                    <td>Merk</td>
                                    <td>Type</td>
                                    <td>SN</td>
                                    <td>Condition</td>
                                    <td>Purchase Date</td>
                                    <td>Mutation</td>
                                    <td>Allocation</td>
                                    <td>Handover Date</td>
                                    <td>Return Date</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            </table>   
						</div>
                            <div class="tab-pane fade" id="electronic" role="tabpanel" aria-labelledby="ellectronic_tab">
                                <table id="tabel_electronic" class="table w-100">
                                <thead>
                                    <tr>
                                        <td>Merk</td>
                                        <td>Type</td>
                                        <td>SN</td>
                                        <td>Condition</td>
                                        <td>Purchase Date</td>
                                        <td>Mutation</td>
                                        <td>Allocation</td>
                                        <td>Handover Date</td>
                                        <td>Return Date</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </thead>
                                </table> 
                            </div>
                        <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project_tab">
                            <table id="tabel_project" class="table w-100">
                            <thead>
                                <tr>
                                    <td>Merk</td>
                                    <td>Type</td>
                                    <td>SN</td>
                                    <td>Condition</td>
                                    <td>Purchase Date</td>
                                    <td>Mutation</td>
                                    <td>Allocation</td>
                                    <td>Handover Date</td>
                                    <td>Return Date</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            
                            </table> 
                        </div>
					</div>
					 
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlFrom">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" method="post" class="form_edit_device" id="form_edit_device"  enctype="multipart/form-data">
            <div class="modal-body">
                    <div id="txt_pen" style="display:none;">Edit</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Category</label>
                                    <select name="e_category" id="e_category" class="form-control form-control-sm">
                                        <option value="1">Property</option> 
                                        <option value="2">Electronic</option>
                                        <option value="3">Project</option> 
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                         <label>Merk</label>
                         <input type="hidden" id="id" name="e_id">
                         <select name="e_merek" id="merk" class="form-control form-control-sm" onchange="get_type('',this.value)"></select> 
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2" for="">Type</label>
                            <select name="e_type" id="type" class="form-control form-control-sm"></select>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2" for="">SN</label>
                            <input name="e_sn" type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2" for="">Condition</label>
                            <select name="e_status" class="form-control form-control-sm">
                                <option value="baik">Good</option>
                                <option value="rusak">Risk</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2" for="">Purchase Date</label>  
                            <input type="date" class="form-control form-control-sm" name="e_purchase_date">
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2" for="">Mutation</label>
                            <select  name="e_mutation" id="mutation" onchange="select_mutation(this.value)" class="form-control form-control-sm" placeholder="Mutation">
                                <option value=""></option>
                                <option value="1">Employee</option>
                                <option value="2">Division</option>
                                <option value="3">Project</option>
                                <option value="4">Office</option>
                                <option value="5">SCM</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2">Allocation</label>
                            <input name="e_alokasi_dvc" type="text" class="form-control form-control-sm" >
                        </div>
                        <div class="col-md-12">
                            <div id="rsl_mutation"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2" for="">Handover Date</label>  
                            <input type="date" class="form-control form-control-sm" name="e_handover_date" value="">
                        </div>
                        <div class="col-md-6">
                            <label class="mt-2" for="">Return Date</label>  
                            <input type="date" class="form-control form-control-sm" name="e_return_date" value="">
                        </div>
                    </div>
            </div>

            <input name="tcustomer" type="hidden"  class="form-control form-control-sm">
            <input name="tcustend" type="hidden"  class="form-control form-control-sm">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn-edit" class="btn btn-warning">Save</button>
                <button class="btn btn-primary" id="btn-edit-loading" style="display:none;" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
                </button>
            </div>
            </form>

        </div>
    </div>
</div>


