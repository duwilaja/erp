<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title"><?=$titleForm;?></h3>
    </div>
    <form role="form" method="POST" action="<?=site_url('SCM/'.$action);?>">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Id Mobil</label>
                        <input type="text" class="form-control" name="pnjm_id_mobil" value="<?=$val['pnjm_id_mobil']?>" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Merk Mobil</label>
                        <input type="text" class="form-control" name="pnjm_merek_mobil" placeholder="ex : Mobil A" value="<?=$val['pnjm_merek_mobil']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>No Plat Mobil</label>
                        <input type="text" class="form-control" name="pnjm_plat_mobil" placeholder="ex : B 1234 CDE" value="<?=$val['pnjm_plat_mobil']?>">
                    </div>
                </div>   
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>No Mesin Mobil</label>
                        <input type="text" class="form-control" name="pnjm_mesin_mobil" placeholder="ex : ABCDEFGHIJ123456" value="<?=$val['pnjm_mesin_mobil']?>">
                    </div>
                </div>        
            </div>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
			<?php if($val['pnjm_id_mobil'] != ""){?>
				<input type="button" class="btn btn-danger" onclick="this.form.action='<?=site_url('SCM/del_mobil');?>';this.form.submit();" value="Hapus">
            <?php }?>
				<input type="submit" class="btn btn-success" id="btnSubmit" value="Simpan" onclick="var e=this;setTimeout(function(){e.disabled=true;},0);return true;">
            </div>
        </div>
        
    </form>    
</div>