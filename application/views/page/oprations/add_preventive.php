<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Add Preventive Maintenance
                </div>
                <div class="card-body">
                    <form action="<?=site_url('Oprations/inPm')?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label for="">Customer</label>
                                        <select name="customer" id="ctr" class="custom-select" style="width: 100%;">
                                            <?php foreach ($customers as $v) { ?>
                                            <option value="<?=$v->id;?>"><?=$v->custend;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label for="">Lokasi</label>
                                        <input type="text" class="form-control" name="lokasi">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label for="">Teknisi</label>
                                        <select name="teknisi" id="teknisi" class="form-control custom-select" style="width: 100%;">
                                            <?php foreach ($teknisi as $v) { ?>
                                            <option value="<?=$v->id;?>"><?=$v->nama;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label for="">Problem</label>
                                        <input type="text" name="problem" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <input type="submit" class="btn btn-danger" value="Submit">
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        <div class="row">
                                            <div class="col-md-6"><label for="">Tanggal</label></div>
                                            <div class="col-md-6 text-right">
                                                <button type="button" class="btn btn-danger btn-sm" onclick="add()"><i class="fas fa-plus"></i> Add</button>
                                                <button type="button" class="btn btn-outline-dark btn-sm" onclick="rem()"><i class="fas fa-backspace"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <br>
                                <div class="row">
                                    <div class="col-md-10 offset-md-1">
                                        <div class="row" id="maint1">
                                            <div class="col-md-4">
                                                <label for="">Maintenance ke 1</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="date" class="form-control" name="tanggal[]" id="tgl">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


