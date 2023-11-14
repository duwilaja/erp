<style>
    .isi_inp{
        font-size: 14px;
    background: #eee;
    padding: 2px 10px;
    border-radius: 3px;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" >Detail Request <span id="txtLE"></span></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="informasi-karyawan mb-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        Nama Karyawan : sahrul Rizal
                                    </div>
                                    <div class="col-md-12">
                                        Tanggal Request : 11 Juni 2021
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            hello
                        </div>
                    </div>
                    
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Nama Barang</td>
                                <td>Catatan</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Laptop</td>
                                <td>Spesifikasi  : Ram 16gb, ssd : 512gb, untuk keperluan kantor</td>
                                <td><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">Input</button> <button class="btn btn-success btn-sm">Terima</button> <button class="btn btn-danger btn-sm">Tolak</button></td>
                            </tr>
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


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        Input Barang
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="detail-barang">
            <div class="inp">
                <p>Nama Barang</p>
                <div class="isi_inp">Laptop</div>
            </div>
            <div class="inp mt-3">
                <p>Catatan</p>
                <div class="isi_inp">
                    Spesifikasi : Ram 16gb, ssd : 512gb, untuk keperluan kantor
                </div>
            </div>
            <hr>
        </div>
        <div class="pilih-barang">
            <div class="inp">
                <p>Pilih Barang</p>
                <div>
                    <select class="form-control form-control-sm" name="barang">
                        <option>Laptop Lenovo - 12631677317731</option>
                        <option>Ram 500gb - 10387197313197</option>
                    </select>
                </div>
            </div>
            <div class="inp">
                <table class="table table-bordered w-100 mt-4" style="font-size: 14px;">
                    <tr>
                        <td>Nama Barang</td>
                        <td>:</td>
                        <td>Laptop</td>
                    </tr>
                    <tr>
                        <td>SN</td>
                        <td>:</td>
                        <td>12631677317731</td>
                    </tr>
                    <tr>
                        <td>Spesifikasi</td>
                        <td>:</td>
                        <td>
                            Laptop Lenovo, dsadsajdsa dsadsajlkdsa <br> dsajdlksandsakldnsad dlsakjdslkajdsadjsalkjdsal
                        </td>
                    </tr>
                </table>
            </div>
            <div class="inp">
                <br>
                <a href="#">Tidak ada dalam pilihan, Input barang baru sekarang.</a>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
