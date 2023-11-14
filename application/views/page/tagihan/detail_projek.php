<style>
.card{
    box-shadow:none !important;
}
    #txtService{
        font-size:20px;
    }
    #txtCusendcust{
        font-size:16px;
        color: #DB5858;
    }
    .labelx{
        width: max-content;
         display: flex;
         font-size:16px;
    }

    .label-act{
        background: #68EA85;
        color: #275E33;
        padding: 2px  36px 0 10px;
        border-radius: 10px;
    }

    .label-status{
        position: relative;
        left: -25px;
        background: #E9ED2E;
        color: #000000;
        padding: 2px 20px;
        border-radius: 10px;
    }

    .listx{
        font-size: 16px;   
    }

    .jdl{
        text-transform: uppercase;
    font-size: 14px;
    color: #a4a8ad;
    font-weight: 700;
    }
    .isi{
        font-size: 13px;
    }

    .table thead td{
        text-transform: uppercase;
    }
    .table td, .table th {
        font-size: 14px;;
    }

    .no_kontrak span{
        background: #f9f9f9;
        padding: 0px 10px;
        border: solid 2px #555; 
        border-radius: 14px;
        font-size: 14px;
    }

</style>
<div class="row">

    <div class="col-md-12">
        <div class="card">
            
            <div class="card-body">
                <div class="projek_id d-none"><?=$this->uri->segment('3');?></div>
                <div class="row">
                    <div class="col-md-10">
                        <div id="txtService"><?=$dt['service'];?></div>
                        <div id="txtCusendcust"><?=$dt['custendcust'];?></div>
                    </div>
                    <div class="col-md-2 text-right">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#editTagihan" onclick="getDetailProjek()"><i class="fa fa-pencil-alt pr-2"></i> Edit Tagihan</button>
                    </div>
                </div>

                <div class="row" style="margin:25px 0px;">
                    <div class="col-md-4 pl-0">
                        <div class="labelx">
                            <div class="label-act"><?=$dt['aktif'][1];?></div>
                            <div class="label-status"><?=$dt['status'][1];?></div>
                        </div>
                    </div>
                    <div class="col-md-8 pr-0">
                        <?php if($dt['no_kontrak'] != '' ){ ?>
                            <div class="no_kontrak text-right"><span><?=$dt['no_kontrak'];?></span></div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row listx">
                    <div class="col-md-4">
                        <div class="box">
                            <div class="jdl">Masa Kontrak</div>
                            <div class="isi"><?=$dt['masa_kontrak'];?></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box">
                            <div class="jdl">JUMLAH TOTAL KESELURUHAN</div>
                            <div class="isi"><?=$dt['total_tagihan'];?></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box">
                            <div class="jdl">TOTAL TERBAYAR</div>
                            <div class="isi"><?=$dt['total_terbayar'];?></div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="box">
                            <div class="jdl">TOTAL TERHUTANG</div>
                            <div class="isi"><?=$dt['total_terhutang'];?></div>
                        </div>
                    </div>
                    <!-- Tabel -->
                    <div class="col-md-12 mt-5">
                        <table class="table" id="tabel">
                            <thead>
                                <tr>
                                    <td>Tanggal Tertagih</td>
                                    <td>Jumlah Tagihan</td>
                                    <td>Terbayar</td>
                                    <td>Terhuntang</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>20 Mei 2020</td>
                                    <td>Rp. 312,000,000</td>
                                    <td>Rp. 12,000,000</td>
                                    <td>Rp. 300,000,000</td>
                                    <td><span class="badge badge-light">Terhutang</span></td>
                                    <td><button class="btn btn-default text-uppercase font-weight-bold text-gray" style="padding:3px 10px !important;font-size: 13px;">detail</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="editTagihan" tabindex="-1" role="dialog" aria-labelledby="editTagihanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editTagihanLabel">Edit Tagihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="POST" id="formEdtTagihan">
        <div class="modal-body">
            <div class="row">
                    <div class="col-md-6">
                        <div>Nomor Kontrak</div>
                        <input type="hidden" name="id" value="<?=$this->uri->segment(3);?>">
                        <input type="text" name="no_kontrak" disabled class="form-control form-control-sm">
                    </div>
                    <div class="col-md-6">
                        <div>Masa Kontrak</div>
                        <input type="text" name="masa_kontrak" class="form-control form-control-sm">
                    </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <div>Nominal Kontrak</div>
                    <input type="hidden" name="nilai" class="form-control form-control-sm">
                    <input type="number" name="total_kon_ppn" class="form-control form-control-sm">
                </div>  
                <div class="col-md-4">
                    <div>Tanggal Mulai</div>
                    <input type="date" name="start_date" class="form-control form-control-sm">
                </div> 
                <div class="col-md-4">
                    <div>Tanggal Berakhir</div>
                    <input type="date" name="end_date" class="form-control form-control-sm">
                </div>  
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
            <hr>
                    <div class="mt-2 mb-2">Tambah Tagihan</div>
                    <table class="table table-bordered">
                        <tr>
                            <td>Bulan Tertagih</td>
                            <td>Jumlah Tagihan</td>
                            <td style="width:100px;"><button type="button" class="btn btn-success" onclick="addTgh()" style="font-size: 13px;padding: 2px 14px;">Tambah</button></td> 
                        </tr>
                        <tbody id="tgh_list">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>