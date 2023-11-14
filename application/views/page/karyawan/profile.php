<style>
    
    .mycard{
        background-color: white;
        margin-bottom: 20px;
        -webkit-box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
        -moz-box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
        box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
    }
    
    .pp{
        width: 150px;
        height: 150px;
        background-image: url('<?=base_url("data/foto_profile/".$karyawan->foto)?>');
        background-position: center;
        background-size: cover;
        border-radius: 50%;
        margin-left: auto;
        margin-right: auto;
    }
    
    .pt{
        color : #999999;
    }
    
    .line{
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        height: 1px;
        background-color: #e3e3e3;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    
    .personal{
        border-left: #e3e3e3 1px solid;
        padding-left: 30px;
    }
    
    
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="mycard rounded">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 text-center profile">
                                <br>
                                <div class="pp"></div>
                                
                            </div>
                            <br>
                            <div class="col-md-9 personal">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4><strong><?= $karyawan->nama; ?></strong> <a href="<?=site_url('karyawan/edit_profile')?>" class="btn btn-sm text-danger" max-width: 200px;">
                                            <i class="far fa-edit"></i>
                                        </a></h4>
                                        
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <p class="pt">Place / Date of Birth</p>
                                            </div>
                                            <div class="col-md-8 col">
                                                <p><?=$this->bantuan->tgl_indo($karyawan->tgl_lahir);?></p>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <p class="pt">Sex</p>
                                            </div>
                                            <div class="col-md-8 col">
                                                <p><?= $karyawan->jk == '0' ? 'Female' : 'Male'; ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <p class="pt">Religion</p>
                                            </div>
                                            <div class="col-md-8 col">
                                                <p><?=$karyawan->agama;?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <p class="pt">Martial</p>
                                            </div>
                                            <div class="col-md-8 col">
                                                <p><?= $karyawan->marital == '1' ? 'Single' : 'Merried'; ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <p class="pt">Residence</p>
                                            </div>
                                            <div class="col-md-8 col">
                                                <p><?=$karyawan->alamat_tinggal;?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <p class="pt">Mobile</p>
                                            </div>
                                            <div class="col-md-8 col">
                                                <p><?= $karyawan->no_telp;?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <p class="pt">Email</p>
                                            </div>
                                            <div class="col-md-8 col">
                                                <p><?= $karyawan->email;?></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <p class="pt">CV</p>
                                            </div>
                                            <div class="col-md-8 col">
                                                <p><a href="<?=base_url('data/cv/'.$karyawan->cv)?>"><?=$karyawan->cv;?></a></p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="mycard rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pt" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-user-graduate"></i> Education <a data-toggle="modal" data-target="#modalEducation" href="#" class="btn btn-sm text-danger" max-width: 200px;">
                                        <i class="far fa-edit"></i>
                                    </a></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">

                                <?php foreach($education->result() as $v){ ?>
                                <div class="col-md-12">
                                    <h6> <strong><?=$v->sekolah;?></strong></h6>
                                    <span class="pt"><?=$v->tahun_mulai;?> - <?=$v->tahun_akhir;?></span>
                                    <div class="line"></div>
                                </div>
                                <?php } ?>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="mycard rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="pt"><i class="fas fa-trophy"></i> Accomplishments <a  data-toggle="modal" data-target="#modalAward" href="#" class="btn btn-sm text-danger" max-width: 200px;">
                                        <i class="far fa-edit"></i>
                                    </a></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php foreach($award->result() as $v){ ?>
                                        <h6> <strong><?=$v->award;?></strong></h6>
                                        <span class="pt"><?=$v->keterangan;?></span>
                                        <div class="line"></div>
                                    <?php } ?>
                                    </div>
                                
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mycard rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pt"><i class="fas fa-cogs"></i> Skills <a data-toggle="modal" data-target="#modalSkill" href="#" class="btn btn-sm text-danger" max-width: 200px;">
                                                <i class="far fa-edit"></i>
                                            </a></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php foreach($skils->result() as $v){ ?>
                                            <span class="badge badge-danger"><?=$v->skill;?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
                
        <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mycard rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pt"><i class="fas fa-bullseye"></i> Objective</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><?=$karyawan->objektif;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mycard rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pt"><i class="fas fa-user-edit"></i> Qualification Summary</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p><?=$karyawan->kualifikasi;?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mycard rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pt"><i class="fas fa-history"></i> Professional Experience <a data-toggle="modal" data-target="#modalExp" href="#" class="btn btn-sm text-danger" max-width: 200px;">
                                                <i class="far fa-edit"></i>
                                            </a></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <?php foreach ($job_history->result() as $v) { ?>
                                        <div class="col-md-12">
                                            <h6> <strong><?=$v->jabatan;?></strong></h6>
                                            <span><?=$v->perusahaan;?></span><br>
                                            <span class="pt"><?=$v->tahun;?></span>
                                            <div class="line"></div>
                                        </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mycard rounded">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="pt"><i class="fas fa-graduation-cap"></i> Training <a href="#" class="btn btn-sm text-danger" max-width: 200px;" data-toggle="modal" data-target="#modalTraining">
                                                <i class="far fa-edit"></i>
                                            </a></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                          <?php foreach ($pelatihan->result() as $v) { ?>
                                        <div class="col-md-12">
                                            <h6> <strong><?=$v->pelatihan;?></strong></h6>
                                            <p>By <?=$v->oleh;?></p>
                                            <p class="pt"><?=$this->bantuan->tgl_indo($v->tgl_mulai);?> - <?=$this->bantuan->tgl_indo($v->tgl_akhir);?></p>
                                            <div class="line"></div>
                                        </div>
                                          <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
        </div>
                
    </div>
    </section>

        <!-- Modal Education-->
        <div class="modal fade" id="modalEducation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Education</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="addEducation">
            <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tahun Mulai</th>
                                <th>Tahun Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="sekolah" class="form-control"></td>
                                <td><input type="text" name="tahun_mulai" class="form-control"></td>
                                <td><input type="text" name="tahun_akhir" class="form-control"></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="card card-footer">
                <input type="submit" value="Save" class="btn btn-danger">
            </div>
            </form>
            
        </div>
    </div>
</div>


<!-- Modal Experience-->
<div class="modal fade" id="modalExp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Experience</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="javascript:void(0)" method="post" id="addJobHistory">
    <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jabatan</th>
                        <th>Nama PT</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="jabatan" class="form-control"></td>
                        <td><input type="text" name="perusahaan" class="form-control"></td>
                        <td><input type="text" name="tahun" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
    </div>
    <div class="card card-footer">
                <input type="submit" value="Save" class="btn btn-danger">
            </div>
            </form>

    
</div>
</div>
</div>

<!-- Modal Award-->
<div class="modal fade" id="modalAward" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Award</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="javascript:void(0)" method="post" id="addAward">
    <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Award</th>
                        <th>Keterangan</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="award" class="form-control"></td>
                        <td><input type="text" name="keterangan" class="form-control"></td>
                        <td><input type="text" name="tahun" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card card-footer">
                <input type="submit" value="Save" class="btn btn-danger">
            </div>
    </form>
    
</div>
</div>
</div>

<!-- Modal Training-->
<div class="modal fade" id="modalTraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Training</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="javascript:void(0)" method="post" id="addPelatihan">
    <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Training</th>
                        <th>Oleh</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="pelatihan" class="form-control"></td>
                        <td><input type="text" name="oleh" class="form-control"></td>
                        <td><input type="date" name="tgl_mulai" class="form-control"></td>
                        <td><input type="date" name="tgl_akhir" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <div class="card card-footer">
                <input type="submit" value="Save" class="btn btn-danger">
            </div>
            </form>

    
</div>
</div>
</div>

<!-- Modal Skill-->
<div class="modal fade" id="modalSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Skill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="javascript:void(0)" method="post" id="addSkill">
    <div class="modal-body">
            <div class="form-group">
                <label for="">Skills</label> <br>
                <select name="skill[]" id="selectSkill" class="form-control w-100" multiple>
                    <option></option>
                </select>
            </div>
            <br>
    </div>
    <div class="card card-footer">
                <input type="submit" value="Save" class="btn btn-danger">
            </div>
            </form>
    
</div>
</div>
</div>