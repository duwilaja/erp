<section class="content">
    <div class="row">

        <div class="col-12">
            <a href="#" data-toggle="modal" data-target="#modal_add" class="btn btn-success btn-sm text-white mb-2"><i class="fa fa-plus"></i> Tambah Jam Absensi</a>

            <div class="card">
                <div class="card-header">
                    Pengaturan Absensi
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Tanggal Mulai</td>
                                <td>Tanggal Akhir</td>
                                <td>Jam Abensi</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
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

<!-- Modal Add -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jam Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form action="javascript:void(0)" method="post" id="form_add">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tgl_mulai">
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control" name="tgl_akhir">
                        </div>
                        <br>
                        <div class="col-md-12 mt-2">
                            <label>Jam Abensi</label>
                            <input type="time" class="form-control" name="jam_telat">
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-success btn-sm float-right" value="SIMPAN">
            </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jam Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0)" method="post" id="form_edit">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tanggal Mulai</label>
                            <input type="hidden" class="form-control" name="id">
                            <input type="date" class="form-control" name="e_tgl_mulai">
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Akhir</label>
                            <input type="date" class="form-control" name="e_tgl_akhir">
                        </div>
                        <br>
                        <div class="col-md-12 mt-2">
                            <label>Jam Abensi</label>
                            <input type="time" class="form-control" name="e_jam_telat">
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-warning btn-sm float-right" value="SIMPAN">
            </div>
            </form>

        </div>
    </div>
</div>