<section class="content">
    <form action="javascript:void(0)" method="post" id="formEditProfile" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Personal Data
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-3 col-6">
                                <label for="">Full Name</label>
                                <input type="text" name="nama" class="form-control" value="<?=$karyawan->nama;?>">
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="">Religion</label>
                                <select name="agama" class="custom-select">
                                    <option <?=$karyawan->agama == 'islam' ? 'selected' : '';?> value="islam">Islam</option>
                                    <option  <?=$karyawan->agama == 'budha' ? 'selected' : '';?> value="budha">Budha</option>
                                    <option  <?=$karyawan->agama == 'katolik' ? 'selected' : '';?> value="katolik">Katholik</option>
                                    <option  <?=$karyawan->agama == 'kongucu' ? 'selected' : '';?> value="kongucu">Konghucu</option>
                                    <option  <?=$karyawan->agama == 'kristen' ? 'selected' : '';?> value="kristen">Kristen</option>
                                    <option  <?=$karyawan->agama == 'hindu' ? 'selected' : '';?> value="hindu">Hindu</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <label for="">Place of Birth</label>
                                <input type="text" name="tempat_tinggal" class="form-control" value="<?=$karyawan->tempat_tinggal;?>">
                            </div>
                            <div class="col-md-4 col-6">
                                <label for="">Date of Birth</label>
                                <input type="date" name="tgl_lahir" class="form-control" value="<?=$karyawan->tgl_lahir;?>"> 
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-md-3 col-6">
                                <label for="">Sex</label>
                                <select name="jk" id="" class="custom-select">
                                    <option <?=$karyawan->jk == '0' ? 'selected' : '';?> value="0">Female</option>
                                    <option <?=$karyawan->jk == '1' ? 'selected' : '';?> value="1">Male</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-6">
                                <label for="">Marital</label>
                                <select name="marital" id="" class="custom-select">
                                    <option <?=$karyawan->marital == '1' ? 'selected' : '';?> value="1">Single</option>
                                    <option <?=$karyawan->marital == '2' ? 'selected' : '';?>  value="2">Married</option>
                                </select>
                            </div>
                            
                            <div class="col-md-3 col-6">
                                <label for="">Phone</label>
                                <input type="text" name="no_telp" class="form-control" value="<?=$karyawan->no_telp;?>">
                            </div>
                            
                            <div class="col-md-3 col-6">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control" value="<?=$karyawan->email;?>">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="">Residence</label>
                            <textarea name="alamat_tinggal" id="" class="form-control"><?=$karyawan->alamat_tinggal;?></textarea>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="">Objective</label>
                                <textarea name="objektif" class="form-control"><?=$karyawan->objektif;?></textarea>
                            </div>
                            <div class="col">
                                <label for="">Qualification Summary</label>
                                <textarea name="kualifikasi" class="form-control"><?=$karyawan->kualifikasi;?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label for="">Update CV</label>
                                <?php if($karyawan->cv != ''){ ?>
                                    <div class="sabhj" style="background:#555;color:#FFF;padding:0 5px;margin-bottom:10px;borderp-radius:4px;"><a style="color:#FFF;" href="<?=base_url('data/cv/'.$karyawan->cv);?>"><?=$karyawan->cv;?></a></div>
                                <?php } ?>
                                <input type="file" name="cv" class="form-control">
                                <input type="hidden" name="h_cv" class="form-control" value="<?=$karyawan->cv;?>">
                            </div>
                            <div class="col">
                                <label for="">Update Profile Picture</label>
                                <?php if($karyawan->foto != ''){ ?>
                                    <div class="sabhj" style="background:#555;color:#FFF;padding:0 5px;margin-bottom:10px;borderp-radius:4px;"><a style="color:#FFF;" href="<?=base_url('data/cv/'.$karyawan->foto);?>"><?=$karyawan->foto;?></a></div>
                                <?php } ?>
                                <input type="file" name="foto" class="form-control">
                                <input type="hidden" name="h_foto" class="form-control" value="<?=$karyawan->foto;?>">
                            </div>
                        </div>
                        <br>
                        <br>
                        <h5 style="color: tomato;"><strong>Change Password</strong></h5>
                        <br>
                        <div class="form-row">
                            <!-- <div class="col-md-4 col">
                                <label for="">Old Password</label>
                                <input name="old" type="password" class="form-control">
                            </div> -->
                            <div class="col-md-6 col">
                                <label for="">New Password</label>
                                <input name="new" type="password" class="form-control">
                            </div>
                            <div class="col-md-6 col">
                                <label for="">Re-type Password</label>
                                <input name="retype" type="password" class="form-control">
                            </div>
                        </div>
                        <br>
                        <input type="submit" value="Update" class="btn btn-danger">
                    </div>
                </div>
            </div>
        </div>
        
        
    </form>
</section>