<style>
span .select2{
    width: 100% !important;
} 

</style>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">Daftar Anggota</h3>
                    <div class="azsa" style="float: right;">
                        <a href="#" id="addAnggota" data-toggle="modal" data-target="#modalAddAnggota" class="btn btn-info">Tambah Anggota</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Jabatan</td>
                                <td>Alokasi Customer</td>
                                <td>Group</td>
                                <td>#</td>
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

<!-- Modal  Tambah Anggota-->
<div class="modal fade" id="modalAddAnggota" tabindex="-1" role="dialog" aria-labelledby="addAnggotaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="javascript:void(0);" id="formAddAnggota">
        <div class="modal-body">
          <div class="row">
          <div class="col-md-12">
            <p>Pilih Jabatan</p>
            <input type="hidden" class="form-control" name="karyawan_id" id="karyawan_ids">
            <input type="hidden" class="form-control" name="jabatan" id="jabatan_id">
            <select name="karyawan" id="karyawan" onchange="setKaryawan(this.value)" class="form-control w-100" style="width: 100% !important;">
              <option value="">-- Pilih Jabatan -- </option>
              <option value=""></option>
            </select>
          </div>
          <div class="col-md-12 mt-2"></div>
          <div class="col-md-12">
            <p>Group </p>
            <select name="group" id="group" class="form-control">
              <option value="">-- Pilih Level Group -- </option>
              <option value="oprlvl1">C3</option>
              <option value="oprlvl1bali">C3 Bali</option>
              <option value="oprlvl2">OPR Level 2</option>
              <option value="oprlvl3">OPR Level 3</option>
            </select>
          </div>
          <div class="col-md-12">
              <div class="mt-2"></div>
              <p>Penempatan Customer </p>
              <select name="customer" id="customer" class="form-control w-100">
                <option value=""> </option>
              </select>
          </div>
        </div>
        </div>
        <div class="modal-footer mt-4">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal  Tambah Anggota-->
<div class="modal fade" id="modalEditAnggota" tabindex="-1" role="dialog" aria-labelledby="editAnggotaModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" action="javascript:void(0);" id="formEditAnggota">
            <div class="modal-body">
            <div class="row">
            <div class="col-md-12">
                <p>Karyawan</p>
                <input type="hidden" class="form-control" name="id" id="karyawan_id">
                <input type="text" class="form-control" name="e_karyawan" id="e_karyawan">
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-12">
                <p>Group </p>
                <select name="e_group" id="e_group" class="form-control w-100">
                  <option value="">-- Pilih Level Group -- </option>
                  <option value="oprlvl1">C3</option>
                  <option value="oprlvl1bali">C3 Bali</option>
                  <option value="oprlvl2">OPR Level 2</option>
                  <option value="oprlvl3">OPR Level 3</option>
                </select>
            </div>
            <div class="col-md-12 mt-2">
                <p>Penempatan Customer </p>
                <select name="e_customer" id="e_customer" class="form-control w-100">
                  <option value=""> </option>
                </select>
            </div>

            </div>
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
  </div>
</div>
