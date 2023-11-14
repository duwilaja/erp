<?php
$optven='<option value="0">Other</option>';
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
    <form role="form" method="POST" enctype="multipart/form-data" action="<?=site_url('SCM/'.$action);?>">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Number</label>
                        <input type="text" class="form-control" name="purchaseno" placeholder="ex : 00001" value="<?=$val['purchaseno']?>">
                        <input type="hidden" class="form-control" name="id" value="<?=$val['id']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Desc</label>
                        <input type="text" class="form-control" name="ket" placeholder="ex : PO untuk Project ke Vendor" value="<?=$val['ket']?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Date</label>
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
						<div class="row">
                        <div class="col-md-12">
                            <select name="vendor_id" class="form-control" id="vendor_id" onchange="$('#vname').val($('#vendor_id option:selected').text());">
                            <?=$optven?>
                            </select>
                        </div>
						<!-- <input type="text" class="form-control col-sm-6" name="vname" id="vname" value="<?=$val['vname']?>"> -->
						</div>
                    </div>
                </div>
				
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Sub Total</label>
                        <input type="text" class="form-control" name="subtot" value="<?=$val['subtot']?>">
                    </div>
                </div>
				
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Tax</label>
                        <input type="text" class="form-control" name="tax" value="<?=$val['tax']?>">
                    </div>
                </div>
				
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Discount</label>
                        <input type="text" class="form-control" name="disc" value="<?=$val['disc']?>">
                    </div>
                </div>
				
				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Total</label>
                        <input type="text" class="form-control" name="tot" value="<?=$val['tot']?>">
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
				<input type="button" class="btn btn-danger" onclick="this.form.action='<?=site_url('SCM/del_purchase');?>';this.form.submit();" value="Hapus">
				<a href="#" data-toggle="modal" data-target="#modal-items" onclick="get_item('<?=site_url('SCM/get_purchase_item/'.$val['id']);?>');" class="btn btn-info">Items</a>
            <?php }?>
				<input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
        
    </form>
    
</div>

<div class="modal" id="modal-items"  aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Purchase Items</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
			<button class="btn btn-success" onclick="add_row();"><i class="fa fa-plus"></i></button>
			<form id="f_po_items">
			<input type="hidden" name="totitem" id="totitem" value="0">
			<input type="hidden" name="poid" value="<?=$val['id']?>">
                <table class="table table-bordered table-responsive" style="overflow: scroll; overflow: auto;">
					<thead style="background:#ffc107;color:#FFF;">
						<tr>
							<td>&nbsp;</td>
							<td>#</td>
							<td>Part#</td>
							<td>Description</td>
							<td>Qty</td>
							<td>Unit</td>
							<td>Price</td>
							<td>Currency</td>
							<td>Status</td>
						</tr>
					</thead>
					<tbody id="tbody">
						
					</tbody>
				</table>
			</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary" onclick="save_item('<?=site_url('SCM/save_purchase_item');?>')">Simpan</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>
