<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col">
                            List Data Master
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <table class="table" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Lokasi</th>
                                <th>Alamat</th>
                                <th>Customer</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pic</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="formEditPic">
                    <div class="form-row">
                        <div class="col">
                            <label for="">Nama</label>
                            <input type="hidden" class="form-control" name="id">
                            <input type="text" class="form-control" name="pic">
                        </div>
                        <div class="col">
                            <label for="">Kontak</label>
                            <input type="text" class="form-control" name="kontak_pic">
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label for="">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi">
                        </div>
                        <div class="col">
                            <label for="">Customer</label>
                            <input type="text" class="form-control" name="customer">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat"  class="form-control"></textarea>
                    </div>

                    <br>
                    <input type="submit" class="btn btn-danger" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>