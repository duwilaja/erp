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
    .lbl-primary {
        background: #1a8cff;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">Daftar Pengajuan <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="<?=site_url('SCM/pengajuan_peminjaman_mobil')?>" class="btn btn-warning">Kembali</a>
                        <a href="<?=site_url('SCM/form_pengajuan_mobil')?>" class="btn btn-info">Tambah Pengajuan</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>Mobil Pengajuan</td>
                                <td>Nama Pengajuan</td>
                                <td>Tanggal Pengajuan</td>
                                <td>Tanggal Mulai Pemakaian</td>
                                <td>Tanggal Selesai Pemakaian</td>
                                <td>Status Pengajuan</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
