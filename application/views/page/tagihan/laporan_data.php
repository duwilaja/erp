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

    .dkp{
        list-style: none;
        display: flex;
        margin:0;
        padding:0;
        font-size: 12px;
    }

    .dkp::before{
        color: #555;
        content: "Dokumen Terupload : ";
        margin-right: 10px;
        font-weight: bold;
    }

    .dkp-list{
        color: #FFF;
        background: #20c997;
        font-size: 12px;
        padding: 4px 10px;
        margin-right: 9px;
        border-radius: 16px;
    }

    .dkp-list:hover{
        color: #FFF;
    }

</style>

<div class="container">
    <div class="jdl" style="font-weight: bold;font-size: large;">Laporan Data</div>
    <p style="font-size: small;">Anda dapat mengumpulkan laporan melalui halaman ini untuk memperlancar penagihan kepada client</p>
    <br>
    <div class="card-all">
       
    </div>
</div>

<div class="loading" style="display: none;">Loading&#8230;</div>

<!-- Modal Upload Laporan -->
<div class="modal fade" id="laporanUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" action="javascript(0);" method="post" id="formUpload">
      <div class="modal-body" id="modal_upload">
        <input type="hidden" id="projek_id"  name="projek_id" value="">
        <input type="hidden" id="tgh_list_id" name="tgh_list_id"  value="">
          <div class="row" id="jenis_lamp">
              
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