<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Absen - <b><?=$this->bantuan->tgl_indo(date('Y-m-d'));?></b></div>
            <form action="javascript:void(0)" method="post" id="absen" enctype='multipart/form-data' >
            <div class="card-body">
                    <div class="personal">
                        <div class="nama text-center mb-2"><h3><?=$this->bantuan->getUser()['nama'];?></h3></div>
                        <input type="hidden" name="id" value="<?=$this->session->userdata('karyawan_id');?>">
                    </div>
                    <div class="form-group">
                       <div class="mb-2">Foto Bukti</div>
                       <input type="file" name="bukti" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="mb-2">Pilih Opsi</div>
                       <select name="opsi" id="opsi" class="form-control" required>
                           <option value="">-- Pilih --</option>
                           <option value="I">Masuk</option>
                           <option value="O">Pulang</option>
                       </select> 
                    </div>
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-success w-100" type="submit">Absen</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Data Absensi Online - <b><?=$this->bantuan->getUser()['nama'];?></b>
            </div>
            <div class="card-body">
                <table class="table" id="tabel">
                    <thead>
                        <tr>
                            <th>Tanggal Absen</th>
                            <th>Jam Masuk</th>
                            <th>Bukti Absen Masuk</th>
                            <th>Jam Pulang</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>