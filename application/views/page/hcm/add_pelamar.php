<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah Pelamar
                </div>
                <div class="card-body">
                    <form action="<?=site_url('hcm/inPelamar');?>" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col">
                                <label for=""><i class="fas fa-id-badge"></i> Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama">
                                <input type="hidden" class="form-control" name="lowongan_id" value="<?=$this->uri->segment(3);?>">
                            </div>
                            <div class="col">
                                <label for=""><i class="fas fa-university"></i> Pendidikan Terakhir</label>
                                <input type="text" class="form-control" name="pendidikan">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for=""><i class="fas fa-envelope-square"></i> Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="col">
                                <label for=""><i class="fas fa-phone-square-alt"></i> No HP</label>
                                <input type="text" class="form-control" name="no_tlp">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for=""><i class="fas fa-file-alt"></i> Upload CV</label>
                            <input type="file" class="form-control" name="cv">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-danger" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>