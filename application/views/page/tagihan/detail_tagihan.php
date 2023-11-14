<style>
    .fc {
        display: flex;
        align-items: stretch;
    }
    
    .fc > .fi {
        color: #555;
        margin: 0px;
    }
    
    .ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f1f1f1;
    }
    
    .li a {
        display: block;
        color: #000;
        padding: 8px 16px;
        text-decoration: none;
    }
    
    /* Change the. link color on hover */
    .li a:hover {
        background-color: #555;
        color: white;
    }

    .custom-file-label{
      font-size: 12px;
    }
  
    
    p{
        margin: 0;
    }

    .sfile{
        font-size: 35px;
        padding-right: 10px;
        color: #ffc107;
    }

    .txt-judul{
        font-size: 18px;
        border-bottom: solid 1px #EEE;
        padding-bottom: 4px;
    }

    .txt-subjud{
        font-size: 13px;
        color: rgb(182, 179, 179);
        letter-spacing: 1.2px;
    }

    .txt-atas{
        font-size: 16px;
        font-weight: bold;
    }

    .txt-bawah{
        margin-top: 6px;
        font-size: 14px;
        color: #555;
    }

    .ket{
        min-height: 150px;
        background-color:#FAFAFA;
        padding: 8px;
        border: solid 1px #DDD;
    }

    .chat-item:hover{
      background: #FAFAFA;
    }

   
/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
 
</style>

<div class="loading" style="display: none;">Loading&#8230;</div>

<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6 text-right mb-3">
    <button class="btn btn-danger" data-toggle="modal" data-target="#ubahstatusmodal"  onclick="setUbahStatus(<?=$this->uri->segment('3');?>)">Ubah Status</button>
    <input type="hidden" id="ttotal" value="<?=$detailTgh['total'];?>">
    <input type="hidden" id="tterbayar" value="<?=$detailTgh['terbayar'];?>">
    <input type="hidden" id="tterhutang" value="<?=$detailTgh['terhutang'];?>">
    <input type="hidden" id="ttglsubmit" value="<?=$detailTgh['tglsubmit'];?>">
    <input type="hidden" id="kett" value="<?=$detailTgh['ket'];?>">
  </div>
</div>

<div class="fc" style="background-color: #FFF;padding: 1.5rem 1.5rem;border:solid 1px #DDD; border-radius:4px;">
    <div class="fi sidebar" style="flex-grow:2;background:#FFF;width: 450px;">
        <div class="head" style="border-bottom:solid 1px #EEE;">
            <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                <div class="d-flex align-items-center">
                    <div>
                        <h6>Dokumen Pendukung</h6>
                        <p class="text-muted text-sm">Daftar dokumen pendukung</p>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-default" id="uploadx" type="button" data-toggle="modal" data-target="#uploadmodal" >
                        <i class="fa fa-file-upload"></i> Upload
                    </button>
                </div>
            </div>
        </div>
        <div class="side">
           <ul class="list-unstyled chat-list px-1" id="list_doc"></ul>
           <div class="tdata text-center text-sm" id="tdoc">
             Tidak Ada Dokumen
           </div>
        </div>
    </div>
    <div class="fi aside p-2" style="flex-grow:8;background:#FFF;width: 800px;">
        <div class="txt-judul">
            <a href="<?=site_url('tagihan/detail_projek/'.$this->uri->segment(3))?>" style="color:#dc3545;"><span><?=$detailTgh['service'];?></span></a><br>
            <span class="txt-subjud"><?= @$detailTgh['customer'] != '' ? $detailTgh['customer'].' - '.$detailTgh['custend'] : '';?> </span>
        </div>
        <div class="row mt-2">
            <div class="col-md-4 p-2">
                <div class="txt-atas">Estimasi Tagihan</div>
                <div class="txt-bawah"><?=torp($detailTgh['total']);?></div>
            </div>
            <div class="col-md-4 p-2">
                <div class="txt-atas">Total Tagihan</div>
                <div class="txt-bawah"><?=torp($detailTgh['total_kon_ppn']);?></div>
            </div>
            <div class="col-md-4 p-2">
                <div class="txt-atas">Terbayar</div>
                <div class="txt-bawah" id="txtTerbayar"><?=torp($detailTgh['terbayar']);?></div>
            </div>
            <div class="col-md-4 p-2">
                <div class="txt-atas">Terhutang</div>
                <div class="txt-bawah" id="txtTerhutang"><?=torp($detailTgh['terhutang']);?></div>
            </div>
            <div class="col-md-4 p-2">
                <div class="txt-atas">Status</div>
                <div class="txt-bawah">
                    <span class="badge-circle badge-md badge-dark" id="txtStatus" style="padding:0 6px;"><?=$detailTgh['status'];?></span>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="txt-atas">Tanggal Submit</div>
                <div class="txt-bawah">
                    <span class="badge-circle" id='txtTglsubmit'><?=$this->bantuan->tgl_indo($detailTgh['tglsubmit']);?></span>
                </div>
            </div>
            <div class="col-md-12 p-2">
                <div class="txt-atas">Masa Kontrak</div>
                <div class="txt-bawah">
                    <?=$detailTgh['masa_kontrak'];?>
                </div>
            </div>
            <div class="col-md-12 p-2 mb-2">
                <div class="txt-atas">Dokumen Tersedia</div>
                <div class="txt-bawah">
                  <?php if(count($detailTgh['dok']) >0){ foreach ($detailTgh['dok'] as $v) { ?>
                    <span class="badge-circle badge-md badge-light" style="border:solid 1px #DDD;padding:0 10px;margin-left: 0px;"><?=$v->jl;?></span>
                    <?php } }else{ echo "Tidak Ada";} ?> 
                </div>
            </div>
            <div class="col-md-12">
                <div class="txt-atas">Keterangan</div>
                <div class="txt-bawah">
                    <div class="ket" id="txtKeterangan">
                        <?=$detailTgh['ket'];?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-2">
  <div class="card-header">History</div>
  <div class="card-body p-2" style="font-size: 14px;">
    <table class="table table-bordered" id="table">
      <thead>
        <tr>
            <td style="width: 70px;">No</td>
            <td>Pesan</td>
            <td>Oleh</td>
            <td>Tanggal</td>
        </tr>
    </thead>
    </table>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" method="POST" action="javascript:void(0);" id="formUpload">
        <div class="modal-body">
          <div class="form-group">
          <div class="row">
          <?php foreach ($jenisLamp as $v) { ?>
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-5">
                  <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" onchange="pilihFile(this,'<?=$v->id;?>')" id="jl<?=$v->id;?>" name="f<?=$v->id;?>">
                    <label class="custom-file-label" for="jl<?=$v->id;?>"><?=$v->jl;?></label>
                  </div>
                  </div>
                  <div class="col-md-7">
                    <div class="txtRFile<?=$v->id;?>"  style="font-size:12px;background:#FAFAFA;border:solid 1px #DDD;border-radius: 4px;padding:8px;">
                      ...
                    </div>
                    <input type="hidden" id="txtRFile<?=$v->id;?>" name="tf<?=$v->id;?>">
                  </div>
              </div>
            </div>
          <?php } ?>
          <div class="col-md-12">
            <hr>
              <div class="row">
                  <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                              <td colspan="2">Upload Dokumen Lainnya</td>
                              <td><button type="button" id="tambah" class="btn btn-success btn-sm w-100"><i class="fa fa-plus"></i></button></td>
                          </tr>
                        </thead>
                        <tbody id="list_doc_file">
                            <tr id="no0">
                              <td><input type="text" name="namaDoc@0" class="form-control form-control-sm"></td>
                              <td><input type="file" name="doc@0" class="form-control form-control-sm"></td>
                              <td><button type="button" id="hapus" onclick="hapusDoc('#no0')"  class="btn btn-danger btn-sm w-100"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </div>
          </div>
          
          <input type="hidden"  name="projek_id" value="<?=$this->uri->segment(3);?>">
          <input type="hidden"  name="tgh_list_id" value="<?=$this->uri->segment(4);?>">

          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Ubah Status Modal -->

<!-- Modal  ubah status-->
<div class="modal fade" id="ubahstatusmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Status Tagihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="javascript:void(0);" id="formUbahStatus">
        <div class="modal-body">
          <div class="row">
          <!-- <div class="col-md-6">
            <p>Status</p>
            <select name="status" class="form-control">
              <option value="">-- Pilih Status -- </option>
              <option value="0">Belum Diproses</option>
              <option value="1">On Progress</option>
              <option value="4">Tertagih</option>
              <option value="3">Terbayar</option>
              <option value="2">Terhutang</option>
            </select>
          </div> -->
          <div class="col-md-12">
            <p>Tanggal Submit</p>
            <input type="date" name="tgl_submit" id="tglsubmit" class="form-control"/>
          </div>
          <div class="col-md-12 mt-2"></div>
          <div class="col-md-6">
            <p>Terbayar</p>
            <input type="number" name="terbayar" id="terbayar" class="form-control"/>
          </div>
          <div class="col-md-6">
            <p>Terhutang</p>
            <input type="number" name="terhutang" id="terhutang" class="form-control"/>
          </div>
          <div class="col-md-12 mt-2">
            <div class="form-gorup">
              <label>Keterangan</label>
              <textarea name="keterangan" id="ket" cols="30" rows="10" class="form-control"></textarea>
            </div>
          </div>
            <input type="hidden"  name="projek_id" value="<?=$this->uri->segment(3);?>">
            <input type="hidden"  name="tlid" value="<?=$this->uri->segment(4);?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>