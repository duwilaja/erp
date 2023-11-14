<section class="content">
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fa fa-list"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Data</span>
                    <span class="info-box-number" id="total_data"></span>
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
            <span class="info-box-number" id="approve"></span>
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
            <span class="info-box-number" id="reject"></span>
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
            <span class="info-box-text">No Action</span>
            <span class="info-box-number" id="no_action"></span>
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
                <h3 class="card-title" style="position: relative;top: 5px;">List Pengajuan <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <!-- <a href="<?=site_url('SCM/form_inventory')?>" class="btn btn-success btn-sm">Add New</a> -->
                        <!-- <a href="#" data-toggle="modal" data-target="#modal_form_inventory" class="btn btn-success btn-sm">Add New</a> -->
                </div>
                </div>
                <div class="card-header" style="border-top-left-radius:0 !important;border-top-right-radius: 0 !important;">
                   <form action="javascript:void(0)" id="filters">
                    <div class="row">
                       <div class="col-md-3">
                           <select class="js-example-basic-single" name="anggota" id="anggota">
                                <option >Anggota</option>
                                <option value="">All</option>
                            </select>
                       </div>
                       <div class="col-md-3">
                            <select class="js-example-basic-single" name="barang" id="barang">
                                <option >Barang</option>
                                <option value="">All</option>
                            </select>
                       </div>
                       <div class="col-md-3">
                             <input type="date" name="tanggal" id="tanggal" class="form-control form-control">
                       </div>
                       <div class="col-md-3">
                           <select class="form-control form-control" id="status" name="status">
                               <option>Status</option>
                               <option value="">All</option>
                               <option value="1">Approve</option>
                               <option value="2">Reject</option>
                               <option value="3">No Action</option>
                           </select>
                       </div>
                       <div class="col-md-12 mt-2 text-right">
                          <button type="submit" class="btn btn-purple btn-sm w-30">Filter</button>
                          <button type="reset" id="reset" class="btn btn-danger btn-sm w-10">Reset</button>
                       </div>
                   </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Barang</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>act</th>
                            </tr>
                        </thead>
                        <tbody>
                                <!-- <a href="<?=site_url('SCM/detail_inventory')?>"><button class="btn btn-default btn-sm" data-target="detail_inventory"><i class="fa fa-box"></i></button></a> -->
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

<!-- modal update -->
<div id="Upd-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation of approval</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<form id="UpdForm" name="Upd" role="form">
				<div class="modal-body">				
                 <div class="form-group">
                    <input type="hidden" name="id_upd" id="id_upd">
                        <label for="recipient-name" class="col-form-label">Status:</label>
                        <!-- <input type="text" class="form-control" id="recipient-name"> -->
                        <select name="status_upd" id="status_upd" class="form-control" required>
                            <option value="">-Select-</option>
                            <option value="1">Approved</option>
                            <option value="2">Rejected</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Information:</label>
                        <textarea class="form-control" id="catatan_upd" name="catatan_upd" value="" required></textarea>
                    </div>				
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-success" id="submit">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- end modal update -->