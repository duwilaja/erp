<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">
                    <div class="row">
                        <div>
                            Detail Projek PO
                        </div>
                        <div class="ml-auto">
                            <a href="<?=site_url('Selma/projek_po')?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                </div>
				<div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row font-weight-light">
                            <div class="col-md-2">Nama Projek</div>
                            <div class="col-auto">:</div>
                            <div class="col-auto"><?= $projek->service?></div>
                        </div>
                        <div class="row font-weight-light">
                            <div class="col-md-2">No Kontrak</div>
                            <div class="col-auto">:</div>
                            <div class="col-auto"><?= $projek->no_kontrak?></div>
                        </div>
                        <div class="row font-weight-light">
                            <div class="col-md-2">Tanggal Kontrak</div>
                            <div class="col-auto">:</div>
                            <div class="col-auto"><?= $projek->tgl_kontrak?></div>
                        </div>
                        <div class="row font-weight-light">
                            <div class="col-md-2">Tanggal Mulai</div>
                            <div class="col-auto">:</div>
                            <div class="col-auto"><?= $projek->start_date?></div>
                        </div>
                        <div class="row font-weight-light">
                            <div class="col-md-2">Tanggal Akhir</div>
                            <div class="col-auto">:</div>
                            <div class="col-auto"><?= $projek->end_date?></div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-2">
                                <a href="javascript:void(0);" onclick="modal_excel()" class="btn btn-success ml-2"><i class="fa fa-file-excel mr-1"></i> Excel</a>
                            </div>
                            <div class="ml-auto">
                                <a href="javascript:void(0);" onclick="modal_add()" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Datek</a>
                            </div>
                        </div>
                        <table class="table table-bordered" id="tabel">
                            <thead class="bg-danger">
                                <tr>
                                    <th>No</th>
                                    <th>Layanan</th>
                                    <th>Lokasi</th>
                                    <th>Provinsi</th>
                                    <th>Alamat</th>
                                    <th>SID</th>
                                    <th>Status</th>
                                    <th>Masa Layanan</th>
                                    <th>Tanggal</th>
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

<div class="modal fade" id="modal_excel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript::void(0);" id="form_excel" type="post" enctype="multipart/form-data">
            <div class="mb-3">
                <a href="<?=base_url('data/datek/format_datek.xlsx');?>" class="btn btn-info btn-block"><i class="fa fa-download"></i> Download Format Datek</a>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4 col">
                    <label for="" class="font-weight-normal">Upload Datek</label>
                </div>
                <div class="col-md-8 col">
                    <div class="custom-file">
                        <input type="hidden" name="pk_id" value="<?= $projek->id?>">
                        <input type="hidden" name="datek_id" value="<?= $datek_id?>">
                        <input type="file" name="datek" class="form-control" style="overflow:hidden;">
                    </div> 
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" id="btnImport">Import</button>
      </div>
		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Datek</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript::void(0);" id="addDatekList" type="post" enctype="multipart/form-data">
            <input type="hidden" name="pk_id" value="<?= $projek->id?>">
            <input type="hidden" name="datek_id" value="<?= $datek_id?>">
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Layanan</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="layanan" class="form-control" placeholder="Layanan">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Lokasi</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="lokasi" class="form-control" placeholder="Lokasi">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Provinsi</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="provinsi" class="form-control" placeholder="Provinsi">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Alamat</label>
                </div>
                <div class="col-md-9">
                    <textarea name="alamat" id="" class="form-control" rows="5" placeholder="Alamat"></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">SID</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="sid" class="form-control" placeholder="SID">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Status</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="status" class="form-control" placeholder="Status">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Masa Layanan</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="masa_layanan" class="form-control" placeholder="Masa Layanan">
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

<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Datek</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="javascript::void(0);" id="editDatekList" type="post">
            <input type="hidden" name="id_dtk_list" id="id_dtk_list">
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Layanan</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="layanan" class="form-control" placeholder="Layanan" id="layanan">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Lokasi</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="lokasi" class="form-control" placeholder="Lokasi" id="lokasi">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Provinsi</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" id="provinsi">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Alamat</label>
                </div>
                <div class="col-md-9">
                    <textarea name="alamat" class="form-control" rows="5" placeholder="Alamat" id="alamat"></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">SID</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="sid" class="form-control" placeholder="SID" id="sid">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Status</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="status" class="form-control" placeholder="Status" id="status">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="" class="font-weight-normal">Masa Layanan</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="masa_layanan" class="form-control" placeholder="Masa Layanan" id="masa_layanan">
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