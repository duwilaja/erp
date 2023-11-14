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
            <a href="javascript:void(0);" onclick="modal_add();" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
        </div>
    </div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Master Inventory</h3>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
                    <table id="tabel" class="table w-100">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Barang</td>
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" id="form_add">
            <div class="modal-body">
                <div class="form-group">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
            </div>
            </form>

        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" id="form_edit">
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="namaBarang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" id="namaBarang" placeholder="Nama Barang">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btnUbah" class="btn btn-primary">Edit</button>
            </div>
            </form>

        </div>
    </div>
</div>