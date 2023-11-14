<style>
    
</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
                    <div class="row">
						<button class="btn btn-primary ml-auto mb-2" onClick="add_modal()">Add New</button>
					</div>
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table class="table table-bordered" id="tabel">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Karyawan</th>
										<th>Mulai Bergejala</th>
                                        <th>Tes Covid Akhir</th>
                                        <th>Hasil Akhir</th>
                                        <th>Detail</th>
                                        <th>Action</th>
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

<!-- Modal Add-->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript::void(0);" id="formAdd" type="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 col">
                    <label for="karyawan_id" class="font-weight-normal">Nama Karyawan</label>
                </div>
                <div class="col-md-8 col">
                    <select name="karyawan_id" class="form-control" style="width:100%" id="karyawan" required>
                        <option value="">--Pilih Karyawan--</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Divisi</label>
                </div>
                <div class="col-md-8 col">
                    <input type="text" name="jabatan_id" id="jabatan" disabled class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Mulai Bergejala</label>
                </div>
                <div class="col-md-8 col">
                    <input type="date" name="tgl_mulai_sakit" id="tgl_mulai_sakit" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Tanggal Tes Covid</label>
                </div>
                <div class="col-md-8 col">
                    <input type="date" name="tgl_tes" id="tgl_tes" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Tes Covid</label>
                </div>
                <div class="col-md-8 col">
                    <select name="tes_covid" class="custom-select" id="tes_covid" required>
                        <option value="">--Pilih Tes--</option>
                        <option value="TCM">TCM</option>
                        <option value="Swab Antigen">Swab Antigen</option>
                        <option value="Rapid Antibodi">Rapid Antibodi</option>
                        <option value="RT PCR">RT PCR</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Hasil Tes</label>
                </div>
                <div class="col-md-8 col">
                    <select name="status_covid" class="custom-select" id="status_covid" required>
                        <option value="">--Pilih Status--</option>
                        <option value="1">Negatif</option>
                        <option value="2">Positif</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Upload Hasil Tes</label>
                </div>
                <div class="col-md-8 col">
                    <div class="custom-file">
                        <input type="file" name="file" class="form-control" style="overflow:hidden;">
                    </div> 
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Aktivitas Satu Minggu Kebelakang</label>
                </div>
                <div class="col-md-8 col">
                    <textarea name="act_ming_kang" id="" class="form-control" required></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Aktivitas Luar Kantor Satu Minggu Kebelakang</label>
                </div>
                <div class="col-md-8 col">
                    <textarea name="act_luar_kntr" id="" class="form-control" required></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Catatan</label>
                </div>
                <div class="col-md-8 col">
                    <textarea name="catatan" id="" class="form-control" required></textarea>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
      </div>
		</form>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript:void(0);" id="formEditCov">
        <input type="hidden" name="idtc" id="id"/>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Nama Karyawan</label>
                </div>
                <div class="col-md-8 col">
                    <p id="nkaryawan"></p>
                    <input type="hidden" name="karyawan_id" id="karyawan" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Divisi</label>
                </div>
                <div class="col-md-8 col">
                    <p id="jkaryawan"></p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Tanggal Catatan</label>
                </div>
                <div class="col-md-8 col">
                    <input type="date" name="tgl_catatan" id="tgl_catatan" class="form-control" value="" required>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Catatan</label>
                </div>
                <div class="col-md-8 col">
                    <textarea name="catatan" id="" class="form-control" required></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Konsumsi Obat</label>
                </div>
                <div class="col-md-8 col">
                    <textarea name="obat" id="" class="form-control"></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Tes Covid</label>
                </div>
                <div class="col-md-8 col">
                    <select name="tes_covid" class="custom-select" id="tes_covid">
                        <option value="">--Pilih Tes--</option>
                        <option value="TCM">TCM</option>
                        <option value="Swab Antigen">Swab Antigen</option>
                        <option value="Rapid Antibodi">Rapid Antibodi</option>
                        <option value="RT PCR">RT PCR</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Tanggal Tes Covid</label>
                </div>
                <div class="col-md-8 col">
                    <input type="date" name="tgl_tes" id="tgl_tes" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Hasil Tes</label>
                </div>
                <div class="col-md-8 col">
                    <select name="status_covid" class="custom-select" id="status_covid">
                        <option >--Pilih Status--</option>
                        <option value="1">Negatif</option>
                        <option value="2">Positif</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Upload Hasil Tes</label>
                </div>
                <div class="col-md-8 col">
                    <div class="custom-file">
                        <input type="file" name="file" class="form-control" style="overflow:hidden;">
                    </div> 
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnUbah">Ubah</button>
      </div>
		</form>
    </div>
  </div>
</div>

<!-- Modal Detail-->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailLabel">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4 font-weight-bold">
                <p id="nama"></p>
                <p id="nma_jabatan"></p>
            </div>
            <div class="col-md-4 border-left">
                <p style="font-size: 12px; opacity: 0.5;">Aktivitas Satu Minggu Kebelakang</p>
                <p class="font-weight-bold" id="act_ming_kang"></p>
            </div>
            <div class="col-md-4 border-left" >
                <p style="font-size: 12px; opacity: 0.5;">Aktivitas Diluar Kantor Satu Minggu Kebelakang</p>
                <p class="font-weight-bold" id="act_luar_kntr"></p>
            </div>
        </div>
        <hr>
        <h3>History Tracking</h3>
        <div class="table-responsive">
            <table class="table" id="tabelHis">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tes Covid</th>
                        <th>Catatan</th>
                        <th>Konsumsi Obat</th>
                        <th>Hasil Akhir</th>
                        <th>Berkas</th>
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