<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title"><?=$titleForm;?></h3>
    </div>
    <form role="form" method="POST" action="<?=site_url($action);?>">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label> Karyawan</label>
                        <select class="form-control" name="karyawan" onchange="getKaryawan(this.value)" required>
                            <option value="">- Pilih  Karyawan -</option>
                            <?php foreach ($karyawan as $v) { ?>
                                <option value="<?=$v->id?>" <?=@$val['nama'] == $v->nama ? 'selected' : '';?>><?=$v->nama;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Bulan Transfer</label>
                            <select class="form-control" name="bulan_tf" required>
                                <option value="">- Pilih Bulan Transfer -</option>
                                <?php foreach ($bulan as $val ) { ?>
                                    <option value="<?=$val[1]?>" <?=$val[1] == @$v->bulan ? 'selected' : '';?>><?=$val[1];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div>Salary</div>
                            <table class="table table-bordered table-responsive" style="width:100%;display: table;border-top: solid 2px#343a40;margin-top: 6px;">
                                <thead>
                                    <th>Type</th>
                                    <th>Income</th>
                                    <th>Piece</th>
                                </thead>
                                <?php foreach ($salary as $vaza => $x ) { ?>
                                <tr>
                                    <td>
                                        <select class="form-control w-100" name="type[]" id="product">
                                        <?php foreach ($salary as $val ) { ?>
                                            <option value="<?=$val[0]?>" <?=$val[0] == @$x[0] ? 'selected' : '';?>><?=$val[1];?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                    <td><input class="form-control" onkeyup="cekTotal()" name="<?=$x[0];?>" placeholder="<?=$x[1]?>" value="0"></td>
                                    <td><input class="form-control" onkeyup="cekTotal()" name="<?=$potongan[$vaza][0];?>" placeholder="<?=$vaza[1]?>" value="0"></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td  colspan="2" style="background:whitesmoke;"><b>Total Received</b></td>
                                    <td style="background: whitesmoke;font-weight: bold;" ><input type="hidden" class="form-control" name="total_gaji"><span id="total_gaji"></span></td>
                                </tr>
                            </table>
                        </div>
                        
                    </div>
                    
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="bttn" style="float:right;">
                        <input type="submit" class="btn btn-warning" value="Simpan">
                    </div>
                </div>
                
            </form>
            
        </div>