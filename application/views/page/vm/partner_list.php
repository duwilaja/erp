<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Data Partner List
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-outline-success" onclick="getDownloadReport()">Download</button>
                            <?php  if ($this->session->userdata('level') == '40' || $this->session->userdata('level') == '73') { ?>
                            <a href="#" data-toggle="modal" data-target="#formAddPartner" class="btn btn-outline-danger">Add New</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabel">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Area</th>
                                <th>Lokasi</th>
                                <th>Kontak</th>  
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Add Modal -->
<div class="modal fade" id="formAddPartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="addPartner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: red;">Info Partner</h5>
                                </div>
                            </div>
                            <br>
                            <!-- <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Kategori</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="cp_id" class="custom-select">
                                    <?php foreach ($category as $v) { ?>
                                        <option value="<?=$v->id;?>"><?=$v->category;?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Kategori</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="kategori" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Nama</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="name" class="form-control" value="">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Handphone</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="phone" class="form-control" value="">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Jobs</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="jobs_id" class="form-control" style="width:100%" id="jobs" required>
                                        <option value="">--Pilih Jobs--</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Alamat</label>
                                </div>
                                <div class="col-md-6 col">
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Aktivitas</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="status" class="custom-select">
                                        <option value="0">Tidak Ada</option>
                                        <option value="1">Ditugaskan</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <!-- <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Provinsi</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="prov_id" class="form-control" onchange="getKota(this.value)">
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Kota</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="kota_id" class="form-control">
                                    </select>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Area</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="area" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Location</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="location" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Catatan</label>
                                </div>
                                <div class="col-md-6 col">
                                    <textarea type="text" name="remaks" class="form-control"></textarea>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="formEditPartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" id="editPartner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: red;">Info Partner</h5>
                                </div>
                            </div>
                            <br>
                            <!-- <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Kategori</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="hidden" name="e_id">
                                    <select name="e_cp_id" class="custom-select">
                                    <?php foreach ($category as $v) { ?>
                                        <option value="<?=$v->id;?>"><?=$v->category;?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <br> -->
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Kategori</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="hidden" name="e_id">
                                    <input type="text" name="e_kategori" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Nama</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="e_name" class="form-control" value="">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Jobs</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="jobs_id" class="form-control" style="width:100%" id="jobs" required>
                                        <option value="">--Pilih Jobs--</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Handphone</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="e_phone" class="form-control" value="">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Alamat</label>
                                </div>
                                <div class="col-md-6 col">
                                    <textarea name="e_address" class="form-control"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Aktivitas</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="e_status" class="custom-select">
                                        <option value="0">Tidak Ada</option>
                                        <option value="1">Ditugaskan</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Aktif</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="e_aktif" class="custom-select">
                                        <option value="0">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Area</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="e_area" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Location</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="text" name="e_location" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Catatan</label>
                                </div>
                                <div class="col-md-6 col">
                                    <textarea type="text" name="e_remaks" class="form-control"></textarea>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="formDetailPartner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" id="editPartner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="color: red;">Info Partner</h5>
                                </div>
                            </div>
                            <br>
                            <!-- <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Kategori</label>
                                </div>
                                <div class="col-md-6 col">
                                    <input type="hidden" name="e_id">
                                    <select name="e_cp_id" class="custom-select">
                                    <?php foreach ($category as $v) { ?>
                                        <option value="<?=$v->id;?>"><?=$v->category;?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <br> -->
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Kategori</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="kategori"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Nama</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="nama"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Handphone</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="handphone"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Alamat</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="alamat"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Aktivitas</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="aktivitas"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Aktif</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="aktif"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Area</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="area"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Location</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="location"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Catatan</label>
                                </div>
                                <p>:</p>
                                <div class="col-md-7 col">
                                    <div id="catatan"></div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
