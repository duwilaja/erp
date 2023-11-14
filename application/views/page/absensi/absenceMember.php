<style>
    .lbl{
        font-size: 14px;
        padding: 0 8px;
        color: #FFF;
        border-radius: 4px;
    }
    .lbl-warning {
        background: #fd7e14;
    }

    .lbl-success {
        background: #28a745;
    }
    
    .lbl-danger {
        background: #dc3545;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-12">
   
            <div class="card">
                <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <input onchange="pilihTanggal(this.value)" class="form-control" id="tgl" type="date" name="date" style="margin-left:10px;">
                    </div>
                    <div class="col-md-8 text-right">
                    <div class="statusAbsence" style="position:relative; left:10px;">

                            <!-- <?php if ($this->uri->segment(2) == 'absensiAll') { ?>
                                <select name="status" id="status" class="custom-select" style="width: 150px;">
                                    <option value="">All</option>
                                    <option value="I">Masuk</option>
                                    <option value="O">Keluar</option>
                                    <option value="TL">Terlambat</option>
                                    <option value="IZ">Izin</option>
                                    <option value="CU">Cuti</option>
                                    <option value="SK">Sakit</option>
                                    <option value="L">Lembur</option>
                                    <option value="PD">Perjalanan Dinas</option>
                                </select>

                                
                                <select name="karyawan" id="karyawan">
                                    <option value="">Pilih Nama Karyawan</option>
                                    <?php foreach ($karyawan as $v) { ?>
                                        <option value="<?=$v->id?>"><?=$v->nama;?></option>
                                    <?php } ?>
                                </select>

                                <button id="cari" class="btn btn-danger" type="submit" onclick="lihatDt()">Cari</button>
                            <?php }else{ ?>
                                <select name="status" id="status" onchange="showtable(this.value)">
                                    <option value="">All</option>
                                    <option value="I">Masuk</option>
                                    <option value="O">Keluar</option>
                                    <option value="TL">Terlambat</option>
                                    <option value="IZ">Izin</option>
                                    <option value="CU">Cuti</option>
                                    <option value="SK">Sakit</option>
                                    <option value="L">Lembur</option>
                                    <option value="PD">Perjalanan Dinas</option>
                                </select>
                            <?php } ?> -->
                            <select name="status" id="status" onchange="showtable(this.value)">
                                    <option value="">All</option>
                                    <option value="I">Masuk</option>
                                    <option value="O">Keluar</option>
                                    <option value="TL">Terlambat</option>
                                    <option value="IZ">Izin</option>
                                    <option value="CU">Cuti</option>
                                    <option value="SK">Sakit</option>
                                    <option value="L">Lembur</option>
                                    <option value="PD">Perjalanan Dinas</option>
                                </select>

                        </div>
                    </div>
                </div>
                    
                        
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>NIK</td>
                                <td>Karyawan</td>
                                <td>Status</td>
                                <td>Jam</td>
                                <td>Tanggal</td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
