

<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title"><?=$titleForm;?></h3>
    </div>
    <!-- <form role="form" method="POST" action="<?=site_url('SCM/'.$action);?>"> -->
    <?php echo form_open_multipart('SCM/'.$action);?>
     <!-- enctype="multipart/form-data" action="myapp/do_upload" method="post" accept-charset="utf-8" -->
     <form enctype="multipart/form-data" action="<?=site_url('SCM/'.$action);?>" method="post" accept-charset="utf-8">
        <!-- /.card-header -->
        <div class="card-body">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td>
                    <div style="width:100%px; height:200px; overflow:auto;">
                        <table cellspacing="0" cellpadding="1" border="1"  width="100%" >
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?php echo $val['nama'];?></td>
                        </tr>
                        <tr>
                            <td>Mobil </td>
                            <td>:</td>
                            <td><?php echo $val['pnjm_merek_mobil'];?> | <?php echo $val['pnjm_plat_mobil'];?></td>
                        </tr>
                        <tr>
                            <td>Tujuan</td>
                            <td>:</td>
                            <td><?php echo $val['pnjm_tujuan'];?></td>
                        </tr>
                        <tr>
                            <td>Projek</td>
                            <td>:</td>
                            <td><?php echo $val['projek'];?></td>
                        </tr>
                        <tr>
                            <td>Tanggal pengajuan</td>
                            <td>:</td>
                            <td><?php echo $val['pnjm_waktu_pengajuan'];?></td>
                        </tr>
                        <tr>
                            <td>Keterangan pengajuan</td>
                            <td>:</td>
                            <td><?php echo $val['pnjm_keterangan'];?></td>
                        </tr>
                        </table>  
                    </div>
                    </td>
                </tr>
        </table>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Km Awal</label>
                        <input type="text" class="form-control" name="km_start" id="km_start" placeholder="Ex : 10 km" value="<?php echo $val['km_start'];?>" <?=$disabled_start." ".$agent_disabled?> >         
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Km Akhir</label>
                        <input type="text" class="form-control" name="km_end" placeholder="Ex : 100 km" value="<?php echo $val['km_end'];?>" <?=$disabled_end." ".$agent_disabled?>>         
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Bensin Awal</label>
                        <input type="text" class="form-control" name="bensin_start" placeholder="Ex : 2 Bar" value="<?php echo $val['bensin_start'];?>" <?=$disabled_start." ".$agent_disabled?>>         
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Bensin Akhir</label>
                        <input type="text" class="form-control" name="bensin_end" placeholder="Ex : 1 Bar" value="<?php echo $val['bensin_end'];?>" <?=$disabled_end." ".$agent_disabled?>>         
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Img Awal</label>
                        <?php
                            if ($val['img_start'] == "") {
                               ?>
                                <input type="file" class="form-control" name="img_start" placeholder="" value="" accept="image/*" capture <?=$disabled_start." ".$agent_disabled?>> 
                               <?php
                            }else{
                                ?>
                                 <input type="text" class="form-control" name="img_start" value=" <?php echo $val['img_start'] ?>" <?=$disabled_start." ".$agent_disabled?>> 
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Img Akhir</label>        
                        <?php
                            if ($val['img_end'] == "") {
                               ?>
                                <input type="file" id="img" class="form-control" name="img_end" placeholder="" value="<?php echo $val['img_end'] ?>" accept="image/*" capture <?=$disabled_end." ".$agent_disabled?>> 
                               <?php
                            }else{
                                ?>
                                 <input type="text" class="form-control" name="img_end" value=" <?php echo $val['img_end'] ?>" <?=$disabled_start." ".$agent_disabled?>> 
                                <?php
                            }
                        ?>        
                    </div>
                </div>  
                <div class="col-sm-6">
            
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Kondisi pengembalian Kendaraan</label>
                        <select name="status_kendaraan" class="form-control" <?=$disabled_end." ".$agent_disabled?>>
                            <option value="">-Pilih-</option>
							<option value="1">Bagus</option>
                            <option value="2">Rusak</option>
						</select>
                    </div>
                </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
			<?php if(!empty($val['pnjm_id'])){?>
				<!-- <input type="button" class="btn btn-danger" onclick="this.form.action='<?=site_url('SCM/add_pembatalan_pengajuan/');?>';this.form.submit();" value="Batal"> -->
            <?php }?>
                <input type="hidden" class="btn btn-success" id="pnjm_id" name="pnjm_id" value="<?php echo $val['pnjm_id'] ?>">
                <input type="hidden" class="btn btn-success" id="pnjm_mobil_id" name="pnjm_mobil_id" value="<?php echo $val['pnjm_mobil_id'] ?>">
                <input type="hidden" class="btn btn-success" id="tmp" name="tmp" value="<?php echo $val['tmp'] ?>">
                <input type="hidden" class="btn btn-success" id="tsp" name="tsp" value="<?php echo $val['tsp'] ?>">
                <!-- <input type="hidden" class="btn btn-success" id="extend" name="extend" value="<?php echo $val['extend'] ?>"> -->
				<input type="submit" class="btn btn-success" value="Simpan">
            </div>
        </div>
    </form>
</div>