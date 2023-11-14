

<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title"><?=$titleForm;?></h3>
    </div>
    <form role="form" method="POST" action="<?=site_url('SCM/'.$action);?>">
    <input type="hidden" name="pnjm_id" value="<?=$val['pnjm_id']?>">
    <input type="hidden" name="pnjm_nip_pengajuan" value="<?=$val['pnjm_nip_pengajuan']?>">
    <input type="hidden" name="pnjm_mobil_id" value="<?=$val['pnjm_mobil_id']?>">
    <input type="hidden" name="tmp" value="<?=$val['tmp']?>">
    <input type="hidden" name="tsp" value="<?=$val['tsp']?>">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Mobil Pinjaman</label> 
                        <input type="text" class="form-control" placeholder="Ex : 1 Bar" value="<?=$val['pnjm_merek_mobil']?> | <?=$val['pnjm_plat_mobil']?>" readonly>
                        
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" class="form-control"  placeholder="Ex : 1 Bar" value="<?=$val['pnjm_tujuan']?>" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Pengajuan</label>
                        <input type="text" class="form-control"  value="<?=$val['pnjm_waktu_pengajuan'].' '.$val['waktu_pnjm_waktu_pengajuan']?>" readonly>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Projek</label>
                        <input type="text" class="form-control"  placeholder="Ex : 1 Bar" value="<?=$val['projek']?>" readonly>
                    </div>
                </div>
                 <div class="col-sm-6">
                    <div class="form-group">
                        <label>Keterangan Pengajuan</label>
                        <textarea class="form-control"  readonly><?=$val['pnjm_keterangan']?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Keterangan Persetujuan</label>
                        <textarea class="form-control" name="keterangan_persetujuan" value="" required></textarea>
                    </div>
                </div>
                
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
                <input type="submit" class="btn btn-danger" onclick="this.form.action='<?=site_url('SCM/add_tolak_pengajuan');?>';this.form.submit();" value="Tolak">
				<input type="submit" class="btn btn-success" value="Setuju">
            </div>
        </div>
        
    </form>
    
</div>