<div class="card ">
    <div class="card-header card-black">
        <h3 class="card-title">Form Projek</h3>
    </div>
    <form role="form">
    <!-- /.card-header -->
    <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Nama Projek</label>
                        <input type="text" class="form-control" name="projek" placeholder="Nama Projek">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nama Costumer</label>
                        <input type="text" class="form-control" name="costumer" placeholder="Nama Costumer">
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Total Projek</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Rp
                                </span>
                            </div>
                            <input type="number" class="form-control" name="harga_software">
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Mulai Pekerjaaan</label>
                        <input type="date" class="form-control" name="tgl_mulai">
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Berakhir Pekerjaaan</label>
                        <input type="date" class="form-control" name="tgl_akhir">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header text-center add_field_button" style="cursor: pointer;">
                             <i class="fa fa-plus-circle"></i> Tambah Hardware
                        </div>
                        <div class="card-body">
                            <div class="tambah_hardware">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Pilih Hardware</label>
                                        <select class="form-control" name="hardware">
                                            <option>Tidak Ada</option>
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group" style="position: relative;top: 32px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Rp
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" name="harga_hardware">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header text-center add_software" style="cursor: pointer;">
                                <!-- <i class="fa fa-plus-circle"></i> Tambah Software -->
                                <i class="fa fa-plus-circle"></i> Tambah Software
                        </div>
                        <div class="card-body">
                            <div class="tambah_software">
                            <div class="row">
                                <div class="col-sm-6">
                                    
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Pilih Software</label>
                                        <select class="form-control" name="software">
                                            <option>Tidak Ada</option>
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group" style="position: relative;top: 32px;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    Rp
                                                </span>
                                            </div>
                                            <input type="number" class="form-control" name="harga_software">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Transport</label>
                        <div class="input-group" >
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Rp
                                </span>
                            </div>
                            <input type="number" class="form-control" name="transport">
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Costumer Education</label>
                        <div class="input-group" >
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Rp
                                </span>
                            </div>
                            <input type="number" class="form-control" name="costumer_edu">
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Travelling Expanse</label>
                        <div class="input-group" >
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Rp
                                </span>
                            </div>
                            <input type="number" class="form-control" name="travelling_expanse">
                        </div>
                    </div>
                </div>
                
            </div>
            
            <hr>
            
            <div class="row" style="background:
            #EEE;
            padding: 10px;
            border-radius: 4px;
            font-size: 20px;">
            <div class="col-md-10">
                <b>Margin</b>
            </div>
            <div class="col-md-2">
                <b>Rp.0</b>
            </div>
        </div>
    
</div>
<!-- /.card-body -->
<div class="card-footer">
    <div class="bttn" style="float:right;">
        <input type="submit" class="btn btn-primary" value="Simpan">
    </div>
</div>

</form>

</div>