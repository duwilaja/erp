<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <h3><?=$val['namaKaryawan'];?></h3>
                        </div>
                        <div class="col-md-8 text-right">
                            <a href="#" class="btn btn-danger" onclick="cekJabatanKaryawan(<?=$this->uri->segment(3)?>)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle"></i> Tambah</a>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                <table  class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jabatan</th>
                                <th>Periode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        <?php $no=1; foreach ($val['hjabatan'] as $v) { ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$v->nma_jabatan;?></td>
                                <td><?=$v->period;?></td>
                                <td>
                                    <a onclick="return confirm('Are you sure to remove this data ?')" href="<?=site_url('hcm/deHJabatan/'.$v->id)?>" class="btn btn-warning"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                         <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=site_url('hcm/inHJabatan')?>" id="addJabatan" method="post">
        <div class="modal-body">
              <div class="form-row">
                  <div class="col-8">
                      <div class="ok"></div>
                      <label for="">Jabatan</label><br>
                      <select name="jabatan" class="form-control" id="jabatan"></select>
                  </div>
                  <div class="col-4">
                      <label for="">Periode</label>
                      <input type="text" class="form-control" name="periode">
                      <input type="hidden" class="form-control" name="idk" value="<?=$this->uri->segment(3)?>">
                  </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>

      </div>
    </div>
  </div>
</section>