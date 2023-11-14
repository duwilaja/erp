<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9 col">
                            Report Bulanan
                        </div>
                        <div class="col-md-3 col">
                            <div class="row">
                                <div class="col-7 col-md-9">
                                    <select name="bulan" id="" class="custom-select" onchange="pilih(this.value)">
                                        <?php foreach ($this->bantuan->bulan() as $v) { ?>
                                            <option value="<?=$v[0];?>" <?=$v[0] == date('m') ? 'selected' : '';?>><?=$v[1];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <button class="btn btn-outline-danger"><i class="fas fa-print"></i></button>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tabelBulan" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Karyawan</th>
                                <th>Masuk</th>
                                <th>Cuti</th>
                                <th>Izin</th>
                                <th>Sakit</th>
                                <th>Telat</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
