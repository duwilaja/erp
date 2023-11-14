<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title">Add Costumer</h3>
    </div>
    <form role="form" method="POST" action="<?=site_url('customers/inCostumer');?>">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                        <label>Kode Costumer</label>
                        <input type="text" class="form-control" name="kodec">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Costumer</label>
                        <input type="text" class="form-control" name="nama_costumer">
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Segment</label>
                        <select class="form-control" name="segment_id">
                            <option>- Choose Segment -</option>
                            <?php foreach ($segment as $v) { ?>
                            <option value="<?=$v->segmentid;?>"><?=$v->segmentname;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="bttn" style="float:right;">
            <input type="submit" class="btn btn-primary" value="Save">
        </div>
    </div>
    
</form>

</div>