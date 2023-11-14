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

    div.dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }

</style>
<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="projek_id d-none"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div id="txtService"><h3><span id="txt_service"></span><h3></div>
                            <div id="txtCusendcust"><h5><span id="txt_po"></span></h5></div>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_daftar_device" onclick="cek_cdp()">Daftar Device</button>
                            <!-- <button class="btn btn-default" data-toggle="modal" data-target="#modal_upload_datek" ><i class="fa fa-file pr-2"></i> Upload Datek</button> -->
                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="" onclick="getDetailProjek()"><i class="fa fa-file pr-2"></i>PO</button> -->
                        </div>
                    </div>

                    <div class="row" style="margin:25px 0px;">
                        <div class="col-md-4 pl-0">
                            <div class="labelx">
                                <div class="label-act"><span id="txt_jml_install"></span></div>
                                <div class="label-status"><span id="txt_persen_install"></span></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div style="text-align:right;">
                            <span style="
                            background: #f2f2f2;
                            font-size: 14px;
                            padding: 2px 10px;
                            border-radius: 10px;"id="txt_masa_kontrak"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row listx">
                        <div class="col-md-3">
                            <div class="box">
                                <div class="jdl">CUSTOMER</div>
                                <div class="isi"><span id="txt_cust"></span></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="box">
                                <div class="jdl">END CUSTOMER</div>
                                <div class="isi"><span id="txt_custend"></span></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="box">
                                <div class="jdl">Technical Lead</div>
                                <div class="isi"><span id="txt_team_lead"></span></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="box">
                                <div class="jdl">PM</div>
                                <div class="isi"><span id="txt_pm"></span></div>
                            </div>
                        </div>


                        <!-- Tabel -->
                        <div class="col-md-12 mt-5">
                            <table class="table nowrap" id="tabel">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Task</th>
                                        <th>Location</th>
                                        <!-- <th>PIC</th> -->
                                        <th>Technician</th>
                                        <th>Status</th>
                                        <th>Installation Date</th>
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
                        <input type="hidden" readonly class="form-control form-control-sm" name="sdv_wo_id" value="<?=$this->input->get('id');?>">
                        <input type="text" disabled class="form-control form-control-sm" name="location" value="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>PIC</label>
                        <input type="text" disabled class="form-control form-control-sm" name="pic" value="">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Technician</label>
                        <select name="status_exec" onchange="change_exec(this.value)"  class="form-control form-control-sm">
                            <option value="">-- Pilih </option> 
                            <option value="1">Karyawan</option> 
                            <option value="2">Partner</option>           
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Technician Person</label>
                        <select name="exec_id" id="exec_id" class="form-control form-control-sm">
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="category" class="form-control form-control-sm">
                            <option value="0">Not Started</option>           
                            <option value="1">In Progress</option>           
                            <option value="2">Pending</option> 
                            <option value="3">Complete</option> 
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Installation Date</label>
                        <input type="date" class="form-control form-control-sm" name="install_date" value="">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>BAI</label>
                        <input type="file" name="bai" id="file_bai" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>BAST</label>
                        <input type="file" name="bast" id="file_bast" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>SNMP</label>
                        <input type="file" name="snmp" id="file_snmp" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <td>File BAI</td>
                            <td><span id="txt_bai"></span></td>
                        </tr>
                        <tr>
                            <td>File BAST</td>
                            <td><span id="txt_bast"></span></td>
                        </tr>
                        <tr>
                            <td>File SNMP</td>
                            <td><span id="txt_snmp"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-outline-primary btn-sm" onclick="add()" type="button"><i class="fa fa-plus"></i> Add Device</button>
                            <div class="row" id="list_assets">
                                
                            </div>
                        </div>
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
                    <table class="table display nowrap">
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

<!-- Form Datek-->
<div class="modal fade" id="modal_upload_datek" tabindex="-1" role="dialog" aria-labelledby="installation_formLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
         <div class="modal-header">        
             <h5 class="modal-title" id="installation_form">Import Datek</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="pilih_datek(1)">
              <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="javascript:void(0);" method="post" id="form_import_datek" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                   <div class="form-group">
                        <p>Upload File</p>
                        <input type="file" name="file_datek" class="form-control" onchange="pilih_datek()">
                   </div>
                </div>
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-md-3">Lokasi</div>
                        <div class="col-md-9">
                        <input type="hidden" name="file" id="file">
                        <input type="hidden" name="id_wo" id="id_wo" value="<?=$this->input->get('id');?>">
                            <select class="form-control form-control-sm w-100" id="lokasi" name="lokasi">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">PIC</div>
                        <div class="col-md-9">
                            <select class="form-control form-control-sm w-100" id="pic" name="pic">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="pilih_datek(1)">Cancel</button>
            <button type="submit" id="btn-import" class="btn btn-primary">Import</button>
            <button class="btn btn-primary" id="btn-import-loading" style="display:none;" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
          </div>
          </form>
     </div>
   </div>
</div>

<!-- Modal daftar device -->
<div class="modal fade" id="modal_daftar_device" tabindex="-1" role="dialog" aria-labelledby="installation_form" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
         <div class="modal-header">        
             <h5 class="modal-title" id="installation_formLabel">Daftar Device</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered tabel_cd" id="tabel_cd">
                        <thead>
                            <tr>
                                <th>Device</th>
                                <th>SN</th>
                            </tr>
                        </thead>
                        <tbody>

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