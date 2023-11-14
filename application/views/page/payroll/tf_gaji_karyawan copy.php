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
                            <label>Jam Lembur</label>
                            <input type="text" class="form-control" name="jam_lembur" onkeyup="cekLembur()" id="jam_lembur">
                            <input type="hidden" class="form-control" name="uplem_utama" value="<?=$lembur;?>">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Gaji Utama</label>
                            <input type="text" class="form-control" name="gaji_pokok" readonly id="gaji_utama">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>No.Rekening</label>
                            <input type="text" class="form-control" name="no_rekening" readonly id="no_rekening">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Uang Lembur</label>
                            <input type="text" class="form-control" name="uang_lembur" id="uang_lembur" onkeyup="cekTotal()" value="<?=$lembur;?>">
                        </div>
                    </div>
                    <div class="col-md-6">
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
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Total Gaji</label>
                                <input type="text" class="form-control" name="total_gaji" id="total_gaji">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <table class="table table-bordered table-responsive" style="width:100%;display: table;border-top: solid 2px#343a40;margin-top: 6px;" data-select2-id="29">
                                <thead>
                                    <tr><th>Type</th>
                                        <th>Amount</th>
                                        <th><button type="button" class="btn btn-secondary btn-sm w-100" onclick="add()">Add</button></th>
                                    </tr></thead>
                                    <tbody><tr class="ts">
                                        <td data-select2-id="28">
                                            <select class="form-control w-100 select2-hidden-accessible" name="product[]" id="product" data-select2-id="product" tabindex="-1" aria-hidden="true">
                                                <option value="" data-select2-id="8">  </option>
                                            </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="7" style="width: 96px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-product-container"><span class="select2-selection__rendered" id="select2-product-container" role="textbox" aria-readonly="true"><span class="select2-selection__placeholder">Please select Product</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </td>
                                        <td><input class="form-control" name="amount[]" placeholder="Amount"></td>
                                        <td><button type="button" class="btn btn-danger btn-sm w-100" disabled="">-</button></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="background:whitesmoke;"><b>Total Received</b></td>
                                        <td style="background: whitesmoke;font-weight: bold;" colspan="2">-</td>
                                    </tr>
                                </tbody>
                            </table>
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