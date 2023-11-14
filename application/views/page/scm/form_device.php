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
                        <label>S/N</label>
                        <input type="text" class="form-control" name="sn" placeholder="ex : ABC00001" value="<?=$val['sn']?>">
                        <input type="hidden" class="form-control" name="id" value="<?=$val['id']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Device Name</label>
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
                        <label>Allocation#</label>
                        <select class="form-control" name="allocation">
                            <option <?=$val['allocation'] == 'scm' ? 'selected' : ''; ?> value="scm">SCM</option>
                            <option <?=$val['allocation'] == 'serdev' ? 'selected' : ''; ?> value="serdev">Serdev</option>
                            <option <?=$val['allocation'] == 'operation' ? 'selected' : ''; ?> value="operation">Operation</option>
                            <option <?=$val['allocation'] == 'client' ? 'selected' : ''; ?> value="client">Client</option>
                        </select>
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
                        <label>Date Received</label>
                        <input type="date" class="form-control" name="received" value="<?=$val['received']?>">
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Project</label>
                        <input type="hidden" class="form-control" id="project_id" value="<?=$val['project']?>">
                        <select class="form-control" name="project" placeholder="ex : Proyek ABC">
                            <option value="">-- Select Project --</option>
                            <?php foreach ($projek as $v) { ?>
                                <option value="<?=$v->id;?>" <?=$val['project'] == $v->id ? 'selected' : ''; ?>><?=$v->service;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Date Delivery</label>
                        <input type="date" class="form-control" name="delivered" value="<?=$val['delivered']?>">
                    </div>
                </div>
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Condition</label>
                        <select class="form-control" name="status">
                            <option <?=$val['status'] == 'baik' ? 'selected' : ''; ?> value="baik">Baik</option>
                            <option <?=$val['allocation'] == 'rusak' ? 'selected' : ''; ?> value="rusak">Rusak</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Desc</label>
                        <textarea class="form-control" name="ket"><?=$val['ket']?></textarea>
                    </div>
                </div>
                
            </div>
            
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
			<?php if($val['id']!=0){?>
				<input type="button" class="btn btn-danger" onclick="this.form.action='<?=site_url('SCM/del_device');?>';this.form.submit();" value="Delete">
            <?php }?>
				<input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
        
    </form>
    
</div>