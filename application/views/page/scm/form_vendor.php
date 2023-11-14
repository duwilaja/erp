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
                        <label>Kode</label>
                        <input type="text" class="form-control" name="kode" placeholder="ex : 00001" value="<?=$val['kode']?>">
                        <input type="hidden" class="form-control" name="id" value="<?=$val['id']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="ex : PT Untung Rugi" value="<?=$val['nama']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>PIC</label>
                        <input type="text" class="form-control" name="attn" placeholder="ex : Pak Siapa" value="<?=$val['attn']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat"><?=$val['alamat']?></textarea>
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
			<?php if($val['id']!=0){?>
				<input type="button" class="btn btn-danger" onclick="this.form.action='<?=site_url('SCM/del_vendor');?>';this.form.submit();" value="Hapus">
            <?php }?>
				<input type="submit" class="btn btn-success" value="Simpan">
            </div>
        </div>
        
    </form>
    
</div>