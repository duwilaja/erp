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
                    <div class="col-md-8">
                        <div id="txtService"><?=@$dt['service'];?></div>
                        <div id="txtCusendcust"><?=@$dt['custendcust'];?></div>
                    </div>
                    <div class="col-md-4 text-end" style="text-align:end;">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#addRenewal" ><i class="fa fa-plus pr-2"></i> Tambah Kontrak</button>
                    </div>
                </div>

                <div class="row listx" style="margin:25px 0px;">
                    <div class="col-md-3">
                        <div class="box">
                            <div class="jdl">SALES</div>
                            <div class="isi"><?=@$dt['sales'];?></div>
                        </div>
                    </div>

                    <!-- <div class="col-md-3">
                        <div class="box">
                            <div class="jdl">CATEGORY</div>
                            <div class="isi"><?=@$dt['category'];?></div>
                        </div>
                    </div> -->
                  
                    <!-- Tabel -->
                    <div class="col-md-12 mt-5">
                        <table class="table" id="tabel" style="display: block;
    overflow-x: auto;
    white-space: nowrap;">
                            <thead>
                                <tr>
                                    <td>Nomor Kontrak</td>
                                    <td>Jenis</td>
                                    <td>Status</td>
                                    <td>Periode</td>
                                    <td>Nominal Kontrak</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
          
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="addRenewal" tabindex="-1" role="dialog" aria-labelledby="addRenewalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRenewalLabel">Tambah Kontrak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="POST" id="formPembaharuan">
        <div class="modal-body">
            <div class="row">
               <div class="col-md-3">No. Kontrak</div>
               <input type="hidden" name="id" id="id" value="<?=$this->input->get('id');?>">
               <div class="col-md-9"><input type="text" name="no_kontrak" id="no_kontrak" class="form-control form-control-sm"></div>
            </div>
            <div class="row mt-3">
               <div class="col-md-3">Masa Kontrak</div>
               <div class="col-md-9"><input type="text" name="masa_kontrak" id="masa_kontrak" class="form-control form-control-sm"></div>
            </div>
            <div class="row mt-3">
               <div class="col-md-3">Periode</div>
               <div class="col-md-4"><input type="date" name="start_date" id="in_start_date" class="form-control form-control-sm"></div>
               <div class="col-md-4"><input type="date" name="end_date" id="in_end_date" class="form-control form-control-sm"></div>
            </div>
            <div class="row mt-3">
               <div class="col-md-3">Nominal</div>
               <div class="col-md-9">
               <input type="text" name="rupiah" id="rupiah" class="form-control form-control-sm" required>
                <input type="hidden" name="nominal" id="nominal" class="form-control form-control-sm">
               </div>
            </div>
            <div class="row mt-3">
               <div class="col-md-3">Upload Kontrak</div>
               <div class="col-md-9"><input type="file" name="kontrak" id="kontrak" class="form-control form-control-sm"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-warning">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editRenewal" tabindex="-1" role="dialog" aria-labelledby="addRenewalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRenewalLabel">Edit Renewal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="javascript:void(0);" method="POST" id="formEditPembaharuan" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="row">
               <div class="col-md-3">No. Kontrak</div>
               <input type="hidden" name="id_e" id="id" value="">
               <div class="col-md-9"><input type="text" name="no_kontrak_e" id="no_kontrak" class="form-control form-control-sm"></div>
            </div>
            <div class="row mt-3">
                 <div class="col-md-3">Jenis</div>
                 <div class="col-md-9">
                     <select  name="jenis_e" id="jenis_e" class="form-control form-control-sm">
                         <option value=""></option>
                         <option value="otc">OTC</option>
                         <option value="mrc">MRC</option>
                     </select>
                 </div>
            </div>
            <div class="row mt-3">
               <div class="col-md-3">Periode</div>
               <div class="col-md-4"><input type="date" name="start_date_e" id="start_date" class="form-control form-control-sm"></div>
               <div class="col-md-4"><input type="date" name="end_date_e" id="end_date" class="form-control form-control-sm"></div>
            </div>
            <div class="row mt-3">
               <div class="col-md-3">Nominal</div>
               <div class="col-md-9"><input type="number" name="nominal_e" id="nominal" class="form-control form-control-sm"></div>
            </div>
            <div class="row mt-3">
               <div class="col-md-3">Upload Kontrak</div>
               <div class="col-md-9">
                    <input type="file" name="kontrak_e" id="kontrak" class="form-control form-control-sm">
               </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-warning">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>