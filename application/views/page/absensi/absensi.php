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
        <div class="col-md-12">
            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-search"></i><span class="ml-1">Filter Data</span>
                </a>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card">
                    <form action="javascript:void(0);" method="post" id="filter_absen">
                    <div class="card-body">
                        <div class="row">
                            <?php if ($this->uri->segment(2) == 'absensiAll') { ?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p>Status</p>
                                    <select name="status" id="status" class="form-control">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p>Karyawan</p>
                                    <select name="karyawan" id="karyawan">
                                        <option value="">Pilih Nama Karyawan</option>
                                        <?php foreach ($karyawan as $v) { ?>
                                            <option value="<?=$v->id?>"><?=$v->nama;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php }else{ ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <p>Status</p>
                                    <select name="status" id="status" class="form-control">
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
                            <?php } ?>
                            <div class="col-md-3">
                                <p>Tanggal Mulai</p>
                                <input  class="form-control" type="date" name="tgl_mulai">
                            </div>
                            <div class="col-md-3">
                                <p>Tanggal Akhir</p>
                                <input  class="form-control" type="date" name="tgl_akhir">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div style="float:right;">
                        <button type="reset" onclick="reset_form()" class="btn btn-warning">Reset</button>
                        <button type="submit" id="cari" class="btn btn-success" type="submit" >Cari</button>
                        <!-- <button type="submit" id="cari" class="btn btn-success" type="submit" onclick="lihatDt()">Cari</button> -->
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
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
                                <td>Tanggal Absen</td>
                                <td>#</td>
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
