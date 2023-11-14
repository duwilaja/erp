<div class="row">
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="notifikasi-list" data-toggle="list" href="#notifikasi" role="tab" aria-controls="home">Notifikasi</a>
      <a class="list-group-item list-group-item-action" id="hak_akses-list" data-toggle="list" href="#hak_akses" role="tab" aria-controls="profile">Hak Akses</a>
      <a class="list-group-item list-group-item-action" id="kpi-list" data-toggle="list" href="#kpi" role="tab" aria-controls="messages">KPI</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent" style="background:#FFF;padding:10px;border-radius:4px;">
      <div class="tab-pane fade show active" id="notifikasi" role="tabpanel" aria-labelledby="notifikasi-list">
          <form action="javascript:void(0)" method="post" id="formNotif">
              <div class="row">
                  <div class="col-md-12">
                      <p>Email</p>
                       <div>
                          <select name="email[]" id="email" class="form-control" multiple>
                          </select>
                       </div>
                  </div>
                  <div class="col-md-12 mt-2">
                      <p>Pesan</p>
                       <div>
                         <textarea name="pesan" id="pesan" class="form-control"></textarea>
                       </div>
                  </div>
                  <div class="col-md-12 mt-3">
                      <button type="submit" class="btn btn-default">Simpan</button>
                  </div>
              </div>
          </form>
      </div>
      <div class="tab-pane fade" id="hak_akses" role="tabpanel" aria-labelledby="hak_akses-list">...</div>
      <div class="tab-pane fade" id="kpi" role="tabpanel" aria-labelledby="kpi-list">...</div>
    </div>
  </div>
</div>