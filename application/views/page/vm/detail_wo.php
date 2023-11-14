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

    .bg-yellow, .bg-yellow>a {
        color: #fff!important;
    }
</style>
<div class="row">
    <div class="ml-auto mr-2 mb-2">
        <a href="<?= site_url("VM/work_order");?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <div id="txtService"><h3><span id="txt_service"></span><h3>
                            <h6><span id="txt_cust"></span> - <span id="txt_custend"></span></h6>
                        </div>
                    </div>
                    <div class="col-md-3 border-right mx-1">
                        <p class="mb-0 text-muted">Masa Kontrak</p>
                        <p class="text-bold"><span id="start_date"></span> - <span id="end_date"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3 id="txt_jml_partner"></h3>

                <p>Partners</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 id="txt_jml_partner_op"></h3>

                <p>Partners On Progress</p>
            </div>
            <div class="icon">
                <i class="fa fa-spinner"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->    
    <div class="col-lg-4 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="txt_jml_partner_d"></h3>

                <p>Partners Done</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
</div>
<div class="row">
<input type="hidden" name="id_wo" id="id_wo" value="<?=$this->input->get('id');?>">
    <div class="col-md-12 ">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <a href="javascript:void(0)" class="btn btn-success mb-2 mr-2 ml-auto" onclick="download_report()"><i class="fa fa-file-excel"></i> Excel</a>
                </div>
                <table class="table" id="tabel">
                    <thead class="bg-red">
                        <tr>
                            <th>No</th>
                            <th>Location</th>
                            <th>PIC</th>
                            <th>Partner</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="installation_form" tabindex="-1" role="dialog" aria-labelledby="installation_form" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">        
         <h5 class="modal-title" id="installation_formLabel">Installation Form</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
         </button>
      </div>

    <form action="javascript:void(0);" method="post" id="in_installation_form" enctype="multipart/form-data">
      <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Location</label>
                        <input type="hidden" readonly class="form-control form-control-sm" name="id">
                        <input type="text" disabled class="form-control form-control-sm" name="location" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>PIC</label>
                        <input type="text" disabled class="form-control form-control-sm" name="pic" value="">
                        <input type="hidden" name="status_exec" class="form-control form-control-sm"  value="2">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Partner</label>
                        <select name="exec_id" id="exec_id" class="form-control form-control-sm">
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="category" class="form-control form-control-sm">
                            <option value="0">Belum Terpasang</option>           
                            <option value="1">Terpasang</option> 
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" id="btn-save" class="btn btn-primary">Save</button>
            <button class="btn btn-primary" id="btn-save-loading" style="display:none;" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
        </div>
    </form>
</div>
</div>
</div>

<!-- Modal Detail SN -->
<div class="modal fade" id="detail_sn" tabindex="-1" role="dialog" aria-labelledby="installation_form" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
         <div class="modal-header">        
             <h5 class="modal-title" id="installation_formLabel">Detail Device Terinstall</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Device</th>
                                <th>SN</th>
                            </tr>
                        </thead>
                        <tbody id="list_sn">

                        </tbody>
                    </table>
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          </div>
     </div>
   </div>
</div>

