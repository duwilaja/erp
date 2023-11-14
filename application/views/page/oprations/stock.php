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
</style>
<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
                        <div class="col-md-6"><h3 class="card-title">Stock Devices <span id="txtLE"></span></h3></div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_add_device">Add Stock</a>
                        </div>
                    </div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="
    border-bottom: solid 1px #DDD;
    padding-bottom: 17px;
">
						<li class="nav-item">
							<a class="nav-link active" id="all_device_tab" data-toggle="pill" href="#all-device" role="tab" aria-controls="all-device" aria-selected="true">All Device in Opr</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="group_device_tab" data-toggle="pill" href="#group-device" role="tab" aria-controls="group-device" aria-selected="false">All Device in Opr by Group</a>
						</li>
            <li class="nav-item">
							<a class="nav-link" id="all_client_tab" data-toggle="pill" href="#all-client" role="tab" aria-controls="all-client" aria-selected="true">All Device in Client</a>
						</li>
					</ul>
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="all-device" role="tabpanel" aria-labelledby="all_device_tab">
                            <table id="tabel_device" class="table w-100">
                            <thead>
                                <tr>
                                    <td>Device</td>
                                    <td>SN</td>
                                    <td>Condition</td>
                                    <td>Desc</td>
                                    <td></td>
                                </tr>
                            </thead>
                            </table> 
                        </div>
						<div class="tab-pane fade" id="group-device" role="tabpanel" aria-labelledby="group_device_tab">
                            <table id="tabel" class="table w-100">
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
            <div class="tab-pane fade" id="all-client" role="tabpanel" aria-labelledby="all_client_tab">
                            <table id="tabel_device_client" class="table w-100">
                            <thead>
                                <tr>
                                    <td>Device</td>
                                    <td>SN</td>
                                    <td>Project/Cust</td>
                                    <td>Condition</td>
                                    <td>Desc</td>
                                    <td></td>
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


<!-- Modal Add Device -->
<div class="modal fade" id="modal_add_device" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Stock Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="post" id="form_add_stock">
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="device">Device</label>
                    <input type="text" name="device" class="form-control form-control-sm">
                </div>
                <div class="col-md-6">
                    <label for="device">Serial Number (SN)</label>
                    <input type="text" name="sn" class="form-control form-control-sm">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="text-right">
                <input type="submit" value="Save" class="btn btn-sm btn-danger">
            </div>
        </div>
    </form>
    </div>
  </div>
</div>