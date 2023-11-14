<div class="card">
	<div class="card-header card-black">
		<h3 class="card-title">Form Pengajuan</h3>
	</div>
	<form role="form" method="POST" action="<?=site_url('Absensi/requestPengajuan');?>" enctype='multipart/form-data'>
		<!-- /.card-header -->
		<div class="card-body">
			<div class="row">
				
				<div class="col-sm-12">
					<div class="form-group">
						<label>Ajukan</label>
						<select name="type" class="form-control" onchange="pilihFor(this.value)" required>
							<option value="CU">Cuti</option>
							<!-- <option value="SK">Sakit</option> -->
							<!-- <option value="L">Lembur</option>
							<option value="PD">Perjalanan Dinas</option> -->
						</select>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="row" id="elm">
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="alasan" class="form-control"></textarea>
					</div>
				</div>
				
			</div>
		</div>
	<!-- /.card-body -->
	<div class="card-footer">
		<div class="bttn" style="float:right;">
			<input type="submit" class="btn btn-danger" value="Kirim">
		</div>
	</div>
</form>

</div>