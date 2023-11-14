<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title"><?=$titleForm;?></h3>
    </div>
    <form role="form" method="POST" action="<?=site_url('Karyawan/'.$action);?>">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" placeholder="ex : 00001" value="<?=$val['nip']?>">
                        <input type="hidden" class="form-control" name="id" value="<?=$val['karyawan_id']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Employes Name</label>
                        <input type="text" class="form-control" name="nama_karyawan" placeholder="ex : Fariz" value="<?=$val['nama']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date of birth</label>
                        <input type="date" class="form-control" name="tgl_lahir" value="<?=$val['tgl_lahir']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date In</label>
                        <input type="date" class="form-control" name="tgl_masuk" value="<?=$val['tgl_masuk']?>">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea  class="form-control" name="alamat" placeholder="ex : Jln. Juanda,No.17, Kota Depok"><?=$val['alamat_tinggal']?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Position</label>
                        <select class="form-control" name="jabatan" id="jbtn">
                            <option value="">- Choose Position -</option>
                            <?php foreach ($jabatan as $v) { ?>
                                <option value="<?=$v->id?>" <?=$val['jabatan_id'] == $v->id ? 'selected' : '';?>><?=$v->nma_jabatan;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status Employes</label>
                        <select class="form-control" name="status_pegawai">
                            <option value="1" <?=$val['status_karyawan'] == 1 ? 'selected' : ''?>>Kontrak</option>
                            <option value="2" <?=$val['status_karyawan'] == 2 ? 'selected' : ''?>>Tetap</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Gander</label>
                        <div style="display: flex;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="jk" <?=$val['jk'] == 1 ? 'checked' : ''?>>
                                <label class="form-check-label">Laki - Laki</label>
                            </div>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="radio" value="0" name="jk" <?=$val['jk'] == 0 ? 'checked' : ''?>>
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Grade</label>
                        <input type="text" class="form-control" name="grade" value="<?=@$val['grade']?>">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-body" style="border-top: solid 2px #17a2b8;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email : </label>
                                        <input type="email" class="form-control" name="email" placeholder="Masukan Email Disini" value="<?=$val['email'];?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username : </label>
                                        <input type="text" class="form-control" name="username" placeholder="Masukan Username Disini" value="<?=$val['username'];?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Password : </label>
                                        <input type="password" class="form-control" name="password" placeholder="Masukan Password Disini">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
                <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
        </div>
        
    </form>
    
</div>