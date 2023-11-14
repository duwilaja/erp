<style>
    
    .boxs{
        background: #ffffff;
        padding: 10px;
        border-radius: 4px;
        /* -webkit-box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);
        box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03); */
    }
    
    .boxs .j {
        font-size: 12px;
        color: #74788d;
    }
    
    .boxs .i{
        color: #0e0c0c;
        font-size: 20px;
    }
    
    #myChart{
        display: block;
        width: 526px;
        height: 300px;
    }
    
    .boxss{
        margin-top: 20px;
        text-align: center;
        border-right:solid 1px #DDD;
        margin-bottom: 20px;
    }
    
    div.dataTables_wrapper {
        margin: 0 auto;
    }

    table tbody tr td,table thead tr td{
        font-size:14px;
    }
    
</style>

<div class="bungkus">
    
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                    <div class="col-md-12">
                        <form action="javascript:void(0)" method="POST" id="formFilter">
                            <div class="boxs" style="display: flex;width: 100%;-webkit-box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);box-shadow: 0 0.75rem 1.5rem rgba(18,38,63,.03);">
                                <div class="form-group mb-0">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value=""> -- Pilih Tahun --</option>
                                        <?php for ($i=0; $i <= 9 ; $i++) { ?> 
                                            <option <?=date('Y') == '202'.$i ? 'selected' : ''?> value="<?='202'.$i?>"><?='202'.$i?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group mb-0 ml-2">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value=""> -- Pilih Bulan --</option>
                                        <?php foreach ($this->bantuan->bulan() as $b) { ?>
                                            <option value="<?=$b[0]?>"><?=$b[1]?></option>
                                        <?php } ?>
                                    </select>
                                </div> -->
                                <div class="form-group mb-0 ml-2">
                                    <button type="submit" class="btn btn-default">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
       
        <div class="col-md-12 mt-3">
            <div class="boxs">
                <div><canvas id="myChart" width="400" height="400"></canvas></div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="boxss">
                            <div class="j"> Total Tagihan Semua</div>
                            <div class="i" id="t_tagihan">0</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="boxss">
                            <div class="j">Total Terbayar</div>
                            <div class="i" id="t_terbayar">0</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="boxss">
                            <div class="j">Total Terhutang</div>
                            <div class="i" id="t_terhutang">0</div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="boxss" style="border-right: none;">
                            <div class="j">Sisa Tagihan</div>
                            <div class="i" id="t_sisa_tagihan">0</div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12">
                        <hr>
                        <div style="display: grid;text-align: center;">
                            <span style="font-size: 12px;">Dari Total Tagihan Semua</span>
                            <span id="t_tagihan" style="font-size: 20px;">Rp. 181,313,313</span>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="boxs"><canvas id="bulat" height="378"> </canvas></div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="boxs text-center mt-3">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button"  onclick="cekStat('#line','#lineMargin')" class="btn btn-light">Nilai Tagihan</button>
                                    <button type="button"  onclick="cekStat('#lineMargin','#line')" class="btn btn-light">Margin</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="boxs"><canvas id="line" width="400"> </canvas></div>
                                <div class="boxs"><canvas style="display:none;" id="lineMargin" width="400"> </canvas></div>
                            </div>
                        </div>
                      
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-md-12 mt-4 mb-4">
           <div class="boxs">
            <label>Daftar Tagihan Per Projek</label>
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                <option value=""> -- Pilih Status --</option>
                                <option value="1">Tertagih</option>
                                <option value="2">Terhutang</option>
                                <option value="3">Terbayar</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <table class="table" id="tabel">
                <thead>
                    <tr>
                        <td>Projek</td>
                        <td>Total Tagihan</td>
                        <td>Terbayar</td>
                        <td>Terhutang</td>
                        <td>Sisa Tagihan</td>
                        <!-- <td>Status</td> -->
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td>NMS Untuk PT. Federal International Finance 250 titik1</td>
                        <td>Rp. 312,000,000</td>
                        <td>Rp. 12,000,000</td>
                        <td>Rp. 300,000,000</td>
                        <td><span class="badge badge-light">Terhutang</span></td>
                        <td><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">detail</button></td>
                    </tr> -->
                </tbody>
            </table>
           </div>
        </div>
    </div>
    
</div>

