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
        <div class="ml-auto mb-3 mr-3">
            <a href="javascript:void(0);" onclick="modal_add();" class="btn btn-success"><i class="fa fa-plus"></i> Request</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fa fa-list"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Data</span>
                    <span class="info-box-number">15</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Approve</span>
            <span class="info-box-number">2</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="far fa-clock text-white"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Pending</span>
            <span class="info-box-number">7</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-times-circle"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Reject</span>
            <span class="info-box-number">1</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-orange"><i class="fa fa-undo-alt text-white"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Retur</span>
                    <span class="info-box-number">3</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-black"><i class="far fa-window-close"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Loss</span>
                    <span class="info-box-number">2</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        <!-- /.info-box -->
        </div>
    </div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Inventory <span id="txtLE"></span></h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
                    <table id="tabel" class="table w-100">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Karyawan</td>
                                <td>Tanggal</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
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

<!-- Add Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlFrom">Request Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" id="form_add">
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead class="bg-dark">
                    <tr>
                        <th>Nama Barang</th>
                        <th>Catatan</th>
                        <th class="text-center"><button class="btn btn-primary" type="button" id="addForm"><i class="fas fa-plus"></i></button></th>
                    </tr>
                    </thead>
                    <tbody id="btroub">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
            </div>
            </form>

        </div>
    </div>
</div>

