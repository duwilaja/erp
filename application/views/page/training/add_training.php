<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah Training
                </div>
                <div class="card-body">
                    <form action="<?=site_url('training/inTraining')?>" method="post">
                        <div class="form-row">
                            <div class="col">
                                <label><i class="fas fa-graduation-cap"></i> Pelatihan</label>
                                <input type="text" class="form-control" name="pelatihan">
                            </div>
                            <div class="col">
                                <label for=""><i class="fas fa-map-marked-alt"></i> Tempat</label>
                                <input type="text" class="form-control" name="tempat">
                            </div>
                            <div class="col">
                                <label for=""><i class="fas fa-wallet"></i> Budget</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input name="budget" type="text" class="form-control" id="inlineFormInputGroup">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="">Tanggal Mulai</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                    </div>
                                    <input name="tgl_mulai" type="date" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                                </div>
                            </div>
                            <div class="col">
                                <label for="">Tanggal Selesai</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="far fa-calendar-minus"></i></div>
                                    </div>
                                    <input name="tgl_akhir" type="date" class="form-control" id="inlineFormInputGroup" placeholder="Username">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-12">
                                <label for="keterangan"><i class="fas fa-scroll"></i> Keterangan</label>
                                <textarea rows="5" class="form-control" name="keterangan"></textarea>
                            </div>
                        </div >
                        <br>
                        <div class="form-group">
                            <div class="form-row" style="margin-bottom: 10px;">
                                <div class="col">
                                    <label for=""><i class="fas fa-user-circle"></i> Karyawan</label>
                                </div>
                            </div>
                            <select name="karyawan[]" class="form-control custom-select" multiple="">
                                <?php  foreach ($val['karyawan'] as $v) { ?>
                                 <option value="<?=$v->id;?>"><?=$v->nama;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-danger" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>