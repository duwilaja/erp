<?php
$optven='<option value="0"></option>';
$optprj='<option value="0"></option>';
//print_r($ven);
for($i=0;$i<count($ven);$i++){
	$sel="";
	if($ven[$i]['id']==$val['vendor_id']) $sel="selected";
	$optven.='<option value="'.$ven[$i]['id'].'" '.$sel.'>'.$ven[$i]['nama'].'</option>';
}
?>
<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title"><?=$titleForm;?></h3>
    </div>
    <form enctype="multipart/form-data" role="form" method="POST" action="<?=site_url('SCM/'.$action);?>">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nomor</label>
                        <input type="text" class="form-control" name="quotnum" placeholder="ex : 00001" value="<?=$val['quotnum']?>">
                        <input type="hidden" class="form-control" name="id" value="<?=$val['id']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" name="ket" placeholder="ex : Quotation dari Vendor untuk Project" value="<?=$val['ket']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="dt" value="<?=$val['dt']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Project</label>
                        <!--input type="text" class="form-control" name="project_id" value="<?=$val['project_id']?>"-->
						<select name="project_id" class="form-control">
						<?php foreach ($projek as $v) { ?>
                                <option value="<?=$v->id;?>"><?=$v->service;?></option>
                            <?php } ?>
						</select>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Vendor</label>
                        <!--input type="text" class="form-control" name="vendor_id" value="<?=$val['vendor_id']?>"-->
						<select name="vendor_id" class="form-control">
						<?=$optven?>
						</select>
                    </div>
                </div>
				
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Attachment</label>
                        <input type="file" class="form-control" name="fattc" accept="application/pdf">
						<input type="hidden" class="form-control" name="attc" value="<?=$val['attc']?>">
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
			<?php if($val['id']!=0){?>
				<input type="button" class="btn btn-danger" onclick="this.form.action='<?=site_url('SCM/del_quotation');?>';this.form.submit();" value="Hapus">
            <?php }?>
				<input type="submit" class="btn btn-primary" value="Simpan">
            </div>
        </div>
        
    </form>
    
</div>