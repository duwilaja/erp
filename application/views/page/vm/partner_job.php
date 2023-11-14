<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Data Partner Job
                        </div>
                        <div class="col-md-6 text-right">
                            <?php  if ($this->session->userdata('level') == '40') { ?>
                            <a href="#" data-toggle="modal" data-target="#formAddPartnerJob" class="btn btn-outline-danger">Add New</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jobs</th>
                                <th>Action</th>
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


<!-- Add Modal -->
<div class="modal fade" id="formAddPartnerJob" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Partner Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="addPartnerJob">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Jobs</label>
                                </div>
                                <div class="col-md-8 col">
                                    <input type="text" name="jobs" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="formEditPartnerJob" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Partner Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" id="editPartnerJob">
                    <div class="row">
                        <input type="hidden" name="id">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Jobs</label>
                                </div>
                                <div class="col-md-8 col">
                                    <input type="text" name="jobs" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
