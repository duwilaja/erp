<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title">Form Izin Cuti</h3>
    </div>
    <form role="form" method="POST" action="<?=site_url('Hcm/inIzinCuti');?>">
    <!-- /.card-header -->
    <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input type="date" class="form-control" name="tgl_mulai">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" class="form-control" name="tgl_akhir">
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="alasan" class="form-control"></textarea>
                    </div>
                </div>
                
            </div>
    
</div>
<!-- /.card-body -->
<div class="card-footer">
    <div class="bttn" style="float:right;">
        <input type="submit" class="btn btn-danger" value="Izin">
    </div>
</div>

</form>

</div>