<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Salary History</h3>
                    <?php if ($this->session->userdata('level') == 54 || $this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) { ?>
                        <div class="azsa" style="float: right;">
                            <a href="<?=site_url('payroll/tf_gaji_karyawan')?>" class="btn btn-warning btn-sm">Transfer Employers Salary</a>
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm">Import</a>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabel" class="table">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>NIK</td>
                                    <td>Nama</td>
                                    <td>Jabatan</td>
                                    <td>Tanggal</td>
                                    <td>Aksi</td>
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
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Slip</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" method="post" id="importSlip" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="col-md-5"><label for="">Import Slip (xls,xlsx)</label></div>
                            <div class="col-md-7"><input type="hidden" name="file" ><input name="slip" type="file" class="form-control" id="uploadSlipExcel" required ></div>
                            <div class="col-md-12">
                                <div class="sdxscdsc" style="background: #f8f9fa;border-radius:4px;padding: 5px;margin-top:10px;">
                                    <div>Pilih Sheet : </div>
                                    <div id="radio-mix" style="display: -webkit-inline-box;overflow: hidden;overflow-x: scroll;padding-bottom: 10px;cursor: all-scroll;padding-top: 10px;">
                                        <!-- <div class="inp-radio mr-2"><input type="radio" name="sheet" value=""> Jan </div> -->
                                       <span style="font-size: 13px;"> Tidak ada sheet yang dipiih</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Tanggal Transfer Gaji</label></div>
                            <div class="col-md-7">
                                <label class="sr-only" for="inlineFormInputGroup">Date</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-calendar-minus"></i></div>
                                    </div>
                                    <input  type="date" name="tanggal"  value="" class="form-control"  placeholder="Tanggal" required>
                                </div>
                            </div>
                        </div>
                        </br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="save">Save changes</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>