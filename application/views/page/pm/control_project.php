<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<button class="btn btn-primary ml-auto mb-2" onClick="add_modal()"><i class="fa fa-plus"></i> Tambah Kendala</button>
					</div>
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table class="table table-bordered" id="tabel">
								<thead>
									<tr>
										<th>No</th>
										<th>Projek</th>
										<th>Jumlah Kendala</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kendala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript::void(0);" id="formTrouble">
			<table class="table table-bordered table-striped">
				<thead class="bg-dark">
				<tr>
					<th>Nama Projek</th>
					<th>Kendala</th>
					<th class="text-center"><button class="btn btn-primary" type="button" id="add"><i class="fas fa-plus"></i></button></th>
				</tr>
				</thead>
				<tbody id="btroub">
				</tbody>
			</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
      </div>
		</form>
    </div>
  </div>
</div>