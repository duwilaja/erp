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
                    <h3 class="card-title" style="position: relative;top: 10px;">Daftar Mobil <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="<?=site_url('SCM/form_mobil')?>" class="btn btn-info">Tambah Data Mobil</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>id</td>
                                <td>Merek Mobil</td>
                                <td>Plat Nomor</td>
                                <td>Status</td>
                                <!-- <td>Keterangan Peminjaman</td> -->
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
