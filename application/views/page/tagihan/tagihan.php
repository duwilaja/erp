<style>
    p{
        margin-bottom: 0;;
    }
    .box {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .box .b{
        margin-left: 4px;
    }
    .dp{
        margin: 0 3px;
        color: #fff;
        background-color: #acb1b5;
    }
    
    .nav-item{
        font-size: 14px;
    }
    
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: none !important;
        border-color:none !important;
    }
    
    .nav-link{
        color:#555;
    }
    
    .box-data{
        background : #FFF;
        padding:10px;
        border-radius:4px;
        text-align: center;

    }

    .box-data .isi {
        font-size:20px;
    }

    .judul {
        font-size: 13px;
        margin-top: 6px;
        margin-bottom: 3px;
        border-radius: 10px;
    }

    .estimasi {
        background: #fff0f0;
    }

    .terbayar {
        background: #dfffdc;
    }
    
    .terhutang {
        background: #f0f2ff;
    }
    
    .xstatus{
        position: absolute;
        font-size: 13px;
        padding: 0 13px;
        border: solid 1px;
        border-right: none;
        right: 0;
        border-radius: 0 0 0px 15px;
        border-top: none;
        text-transform: uppercase;
    }

    .nc{
        font-size: 12px;
        color:#6c757d;
    }

    .s0{
        color:#6c757d;
    }
    
    .s1{
        color:#fd7e14;
    }

    .s2{
        color:#e83e8c;
    }

    .s3{
        color:#20c997;
    }
    a{
        color:#6c757d;
    }

    a:hover{
        color:#6f42c1;
    }
    .select2{
        width:100% !important;
    }

    .select2-results{
        font-size:13px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="jdl" style="font-weight: bold;font-size: large;"><?=@$title;?></div>
            <p style="font-size: small;"><?=@$desk;?></p>
        </div>

        <div class="col-md-3 text-right">
            <button class="btn btn-success" id="addTagihan" data-toggle="modal" data-target="#modalAddTagihan" >Tambah Tagihan</button>
        </div>

        <div class="col-md-12 mt-3"></div>

        <div class="col-md-4">
            <div class="box-data" id="jmlEstimasi">
                <div class="isi"><?=$datajml['total_estimasi'];?></div>
                <div class="judul estimasi">Total Estimasi Tagihan</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box-data" id="jmlTerbayar">
                <div class="isi"><?=$datajml['total_terbayar'];?></div>
                <div class="judul terbayar">Total Sudah Terbayar</div>
            </div>
        </div>
    </div>
    
    <?php $this->load->view('page/tagihan/head_tagihan'); ?>
    
    <div class="card-all">
    
    </div>
</div>

<!-- Modal  ubah status-->
<div class="modal fade" id="modalAddTagihan" tabindex="-1" role="dialog" aria-labelledby="addTagihanModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tagihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="javascript:void(0);" id="formAddTagihan">
        <div class="modal-body">
          <div class="row">
          <div class="col-md-12">
            <p>Projek</p>
            <select name="projek" id="projek" class="form-control w-100">
              <option value="">-- Pilih Projek -- </option>
              <option value=""></option>
            </select>
          </div>
          <div class="col-md-12 mt-2"></div>
          <div class="col-md-6">
            <p>Bulan Tertagih</p>
            <input type="month" name="bulan" class="form-control"/>
          </div>
          <div class="col-md-6">
            <p>Estimasi Tagihan</p>
            <input type="number" name="tagihan" id="tagihan" class="form-control"/>
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