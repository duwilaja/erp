<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <h4><?=@$val['lowongan']->pekerjaan;?></h4>
                        </div>
                        <div class="col-md-3">
                            <p>
                                <i class="fas fa-info-circle" style="color: grey;"></i> Status : <span class="badge badge-success"><?=@$val['lowongan']->status == 1 ? 'Aktif' : 'Tidak Aktif';?></span>
                            </p>
                            <p><i class="far fa-calendar-minus"></i> Jangka Waktu : <?=@$val['lowongan']->tgl_mulai;?> - <?=@$val['lowongan']->tgl_akhir;?> </p>
                            <p><i class="fas fa-briefcase" style="color: red;"></i> Pengelaman : min <?=@$val['lowongan']->pengalaman;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5><i class="far fa-edit"></i> Kualifikasi</h5>
                            <?=@$val['lowongan']->kualifikasi;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5><i class="fas fa-briefcase"></i> Deskripsi Pekerjaan</h5>
                            <?=@$val['lowongan']->deskripsi;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            List Pelamar
                        </div>
                        <div class="col-md-8 text-right">
                            <a href="<?=site_url('hcm/add_pelamar/'.$this->uri->segment(3))?>" class="btn btn-danger"><i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body table-responsive">
                    <table id="tabel_pelamar" class="table">
                        <thead>
                            <tr>
                                <th><input type="hidden" name="id" value="<?=$this->uri->segment(3)?>">No</th>
                                <th>Nama</th>
                                <th>Pendidikan</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>CV</th>
                                <th>Status</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
              <div class="form-group">
                    <label for="">Status</label>
                    <input type="hidden" name="idp" id="idp">
                      <select name="status" id="" class="custom-select" onchange="ubahPelamar()">
                          <option value="1">Pending</option>
                          <option value="2">Diterima</option>
                          <option value="3">Wawancara</option>
                          <option value="4">Blacklist</option>
                          <option value="5">Ditolak</option>
                      </select>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>