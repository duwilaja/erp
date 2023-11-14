<style>
.label{
    padding: 5px 10px;
    display: inline;
    font-size: 13px;
    color: #FFF;
    border-radius: 14px;
}

.label.success{
    background: #8BC34A;
}
.label.failed{
    background: #c91d57;
}
.identitas{
    margin-bottom:10px;
    padding-bottom:14px;
    border-bottom:dashed 2px #DDD;
}
</style>

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><?=$title;?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Tanggal Pengajuan</td>
                                <td>Status</td>
                                <td>Keterangan</td>
                                <td></td>
                            </tr>
                        </thead>
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

<div class="modal fade" id="modal_form_pengajuan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Pengajuan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form id="form_pengajuan" action="javascript:void(0)">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="identitas">
                            <table class="w-100">
                                <tr>
                                    <td>Karyawan</td>
                                    <td>:</td>
                                    <td><span id="txt_nama">Sahrul Rizal</span></td>
                                </tr>
                                <tr>
                                    <td>Pengajuan</td>
                                    <td>:</td>
                                    <td><span id="txt_pengajuan">Cuti</span></td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>Tanggal Pengajuan</p>
                                <input class="form-control" id="txt_tgl_pengajuan" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>Jumlah Hari</p>
                                <input class="form-control" id="txt_jml_hari" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>Tanggal Mulai </p>
                                <input class="form-control" id="txt_tgl_mulai" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>Tanggal Akhir </p>
                                <input class="form-control" id="txt_tgl_akhir" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Keterangan </p>
                        <input type="hidden" name="idt" id="idt" value="<?=$this->input->get('id');?>">
                        <textarea class="form-control" id="txt_keterangan" disabled></textarea>
                    </div>
                    <div class="form-group" id="xfield">
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <div id="xbtn"></div>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
