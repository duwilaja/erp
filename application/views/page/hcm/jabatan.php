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
                    <form action="javascript:void(0);" method="post" id="filter_jabatan">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p>Leader</p>
                                    <select name="f_leader" id="f_leader" class="form-control">
                                        <option value=""></option>
                                        <option value="1">YA</option>
                                        <option value="0">BUKAN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p>Induk Jabatan</p>
                                    <select name="f_induk_jabatan" id="f_induk_jabatan">
                                    </select>
                                </div>
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Daftar Jabatan
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_form_jabatan">Tambah Jabatan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jabatan</th>
                                <th>Leader</th>
                                <th>Group</th>
                                <th>Parent</th>
                                <th>#</th>
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

<!-- Modal  ubah status-->
<div class="modal fade" id="modal_form_jabatan" tabindex="-1" role="dialog" aria-labelledby="addTagihanModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="javascript:void(0);" id="form_jabatan">
        <div class="modal-body">
          <div class="row">
          <div class="col-md-12">
            <p>Jabatan (*)</p>
            <input type="text" name="jabatan" class="form-control"/>
          </div>
          <div class="col-md-12 mt-2"></div>
          <div class="col-md-6">
            <p>Leader (*)</p>
            <select  name="leader" class="form-control">
                <option value="0">Bukan</option>
                <option value="1">Ya</option>
            </select>
          </div>
          <div class="col-md-6">
            <p>Group (*)</p>
            <select  name="group" class="form-control">
            </select>
          </div>
          <div class="col-md-12 mt-2">
            <p>Induk Jabatan</p>
            <select  name="induk_jabatan" class="form-control w-100">
            </select>
          </div>
        </div>
        <div class="modal-footer pb-0 mt-4">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
  </div>
</div>

<!-- Modal  ubah status-->
<div class="modal fade" id="modal_form_edt_jabatan" tabindex="-1" role="dialog" aria-labelledby="addTagihanModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="javascript:void(0);" id="e_form_jabatan">
        <div class="modal-body">
          <div class="row">
          <div class="col-md-12">
            <p>Jabatan</p>
            <input type="hidden" name="e_id" class="form-control"/>
            <input type="text" name="e_jabatan" class="form-control"/>
          </div>
          <div class="col-md-12 mt-2"></div>
          <div class="col-md-6">
            <p>Leader</p>
            <select  name="e_leader" class="form-control">
                <option value="0">Bukan</option>
                <option value="1">Ya</option>
            </select>
          </div>
          <div class="col-md-6">
            <p>Group</p>
            <select  name="e_group" class="form-control">
            </select>
          </div>
          <div class="col-md-12 mt-2">
            <p>Induk Jabatan</p>
            <select  name="e_induk_jabatan" class="form-control">
            </select>
          </div>
        </div>
        <div class="modal-footer pb-0 mt-4">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
  </div>
</div>