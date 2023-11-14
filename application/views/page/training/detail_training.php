<style>
    .card-training{
        padding-top: 30px;
        padding-bottom: 20px;
    }
    
    .icon{
        height: 50px;
        width: 50px;
        background-color: blue;       
        margin: 15px;
        border-radius: 50%;
        
    }
    
    .icon i{
        color: white;
        font-size: 24px;
        margin-top: 12px;
    }
    
    .icon-shape{
        display: inline-flex;
        padding: 12px;
        text-align: center;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        
    }
    
    
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2 class="display-4"><?=$dt->pelatihan; ?></h2>
                            <br>
                            <hr>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-muted mb-0">Karyawan</h5><br>
                                            <span class="h4 font-weight-bold mb-0"><?=$dt->nama; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow" >
                                                <i class="fas fa-id-badge"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-muted mb-0">Tempat</h5><br>
                                            <span class="h2 font-weight-bold mb-0"><?=$dt->alamat; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-success text-white rounded-circle shadow" >
                                                <i class="fas fa-map-marked-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-muted mb-0">Status</h5><br>
                                            <span class="h2 font-weight-bold mb-0" id="stat"><?=$stat; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white rounded-circle shadow" >
                                                <i class="fas fa-question-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-muted mb-0">Tanggal Mulai</h5><br>
                                            <span class="h2 font-weight-bold mb-0"><?=$dt->tgl_mulai; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-dark text-white rounded-circle shadow" >
                                                <i class="fas fa-calendar-week"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-muted mb-0">Tanggal Selesai</h5><br>
                                            <span class="h2 font-weight-bold mb-0"><?=$dt->tgl_akhir; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-dark text-white rounded-circle shadow" >
                                                <i class="fas fa-calendar-week"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-muted mb-0">Budget Rp</h5><br>
                                            <span class="h2 font-weight-bold mb-0"><?= $dt->budget; ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow" >
                                                <i class="fas fa-wallet"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center card card-training">
                            <label for=""><i class="fas fa-scroll"></i> Keterangan</label>
                            <h6><?=$dt->keterangan; ?></h6>
                            <br>
                        </div>
                        <div class="col-md-6 text-center card card-training">
                            <label for="">Sertifikat:  </label>

                            <?php if($dt->status == 5){?>
                                <?php if($dt->sertifikasi == '') {?>

                            <?php echo form_open_multipart('training/uploadCv');?>
                                <input type="file" class="" name="sertifikat">
                                <input type="text" hidden value="<?= $dt->id ?>" name="id">
                                <input type="submit" class="btn btn-danger" value="upload">
                            </form>
                                <?php }else { ?>
                                    <a href="<?= base_url('data/sertifikat/'.$dt->sertifikasi)?>">
                                        <?= $dt->sertifikasi ?>
                                    </a>
                                <?php } ?>
                            <?php } else{ 
                                echo "-";
                            }?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
