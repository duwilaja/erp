<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title"><?=$titleForm;?></h3>
    </div>
    <form role="form" id="f_devices">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="model" placeholder="ex : HSA-500" value="<?=$val['model']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>PO#</label>
                        <input type="text" class="form-control" name="po" placeholder="ex : PO00001" value="<?=$val['po']?>">
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Item#</label>
                        <input type="text" class="form-control" name="item" placeholder="ex : 1" value="<?=$val['item']?>">
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Price (IDR)</label>
                        <input type="text" class="form-control" name="price" placeholder="ex : 2500000" value="<?=$val['price']?>">
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Terima</label>
                        <input type="date" class="form-control" name="received" value="<?=$val['received']?>">
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Project</label>
                        <input type="text" class="form-control" name="project" placeholder="ex : Proyek ABC" value="<?=$val['project']?>">
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Kirim</label>
                        <input type="date" class="form-control" name="delivered" value="<?=$val['delivered']?>">
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Status</label>
                        <input type="text" class="form-control" name="status" placeholder="ex : Baik/Rusak" value="<?=$val['status']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="ket"><?=$val['ket']?></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>S/N</label>
                        <textarea class="form-control" name="sn_multi"><?=$val['sn']?></textarea>
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
				<input type="hidden" name="flag" id="flag">
				<input type="button" onclick="save_multi('<?=site_url('SCM/'.$action);?>','insert');" class="btn btn-success" value="Insert">
				<input type="button" onclick="save_multi('<?=site_url('SCM/'.$action);?>','update');" class="btn btn-warning" value="Update">
				<input type="button" onclick="save_multi('<?=site_url('SCM/'.$action);?>','delete');" class="btn btn-danger" value="Delete">
            </div>
        </div>
        
    </form>
    
</div>