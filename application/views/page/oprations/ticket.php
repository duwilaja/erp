<style>
    tbody tr:hover{
        background:#ffc10705;
        color:#000;
        cursor:pointer;
    }

    .btn-purple{
        color: #fff;
        background-color: #6f42c1;
    }

    thead tr td{
        white-space: nowrap;
    }

    .btn-purple:hover{
        color:#FFF;
        background-color: #533092;
    }
    .status{
            text-align: right;
    background: #9E9E9E;
    display: inline-block;
    color: #FFF;
    float: right;
    font-weight: 500;
    padding: 0 11px;
    text-transform: uppercase;
    border-radius: 11px;
    }
    #cnew{
        background: #9C27B0;
    }

    #cresolved{
        background: #00bcd4;
    }

    #cprogress{
        background: #ff9800;
    }
    
    #cpending{
        background: #e91e63;
    }

    #cclosed{
        background: #8bc34a;
    }
</style>
<div class="dtRahasia" style="display: none;"><?=@$dtRahasia;?></div>
<input type="hidden" name="idk" value="<?=$this->session->userdata('karyawan_id')?>">
<input type="hidden" name="history" value="<?=$this->input->get('history')?>">
<input type="hidden" name="idt" value="<?=$this->input->get('idt')?>">
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">Ticket</h3>
                    <div class="azsa" style="float: right;">
                        <a href="#" class="btn btn-outline-success" id="opencreate"  data-toggle="modal" data-target="#modal-lg">Create Ticket</a>
                    </div>
                </div>
                <div class="card-header" style="border-top-left-radius:0 !important;border-top-right-radius: 0 !important;">
                   <form action="javascript:void(0)" id="filters">
                    <div class="row">
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" name="statusf">
                               <option value="">All Status</option>
                               <option value="new">new</option>
                               <option value="pending">pending</option>
                               <option value="progress">progress</option>
                               <option value="done">done</option>
                               <option value="closed">closed</option>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" id="costumer" name="customerf" onchange="getCusTicLayanan(this.value,'layananf')"> 
                               <option value="">All Costumer</option>
                               <?php foreach ($customers as $v) { ?>
                                   <option value="<?=$v->id;?>"><?=$v->custend;?></option>
                               <?php } ?>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" name="layananf">
                               <option value="">All Layanan</option>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" id="group" name="grpf">
                               <option value="">All Groups</option>
                               <option value="oprlvl1">C3</option>
                               <option value="oprlvl1bali">C3 Bali</option>
                               <option value="oprlvl2">OPR Level 2</option>
                               <option value="oprlvl3">OPR Level 3</option>
                               <option value="oprlvl4">Level 4</option>
                               <option value="oprlvl5">Level 5</option>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" name="f_kategori" onchange="getFSubject(this.value)">
                               <option value="">All Kategori</option>
                               <?php foreach ($tic_kategori as $v) { ?>
                                    <option value="<?=$v->id;?>"><?=$v->nama_kategori;?></option>
                                 <?php } ?>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" name="f_subject">
                               <option value="">All Subject</option>
                           </select>
                       </div>
                       <div class="col-md-12 mt-2 text-right">
                          <button type="submit" class="btn btn-purple btn-sm w-30">Filter</button>
                          <button type="reset" id="reset" class="btn btn-danger btn-sm w-10">Reset</button>
                       </div>
                   </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="font-size:14px;">
                    <table id="tabel" class="table" style="overflow: scroll;
                    overflow: auto; ">
                    <thead style="background:#31302c;color:#FFF;">
                        <tr>
                            <td>#</td>
                            <td>No Ticket</td>
                            <td>Customer</td>
                            <td>Layanan</td>
                            <td>Node ID</td>
                            <td>Alamat</td>
                            <td>Reported By</td>
                            <td>SLA</td>
                            <td>Subject</td>
                            <td>Detail</td>
                            <td>Group</td>
                            <td>Assign To</td>
                            <td>Status</td>
                            <td>Action</td>
                            <td>Last Update</td>
                            <td>Updated By</td>
                            <td>Created By</td>
                        </tr>
                    </thead>
                    
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</section>

<div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post"  id="createticket" action="javascript:void(0)" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Customer</label>
                                <select required class="form-control form-control-sm" name="i_customer" onchange="getCusTicLayanan(this.value,'i_layanan')">
                                    <option value="">- Choose Customer -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label>Reported By</label>
                                <input class="form-control form-control-sm" name="i_reporter" required>
                                <input type="hidden" name="id">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label>Layanan</label>
                                <select class="form-control form-control-sm" name="i_layanan" onchange="get_node_cl('','i_node_id')">
                                    <option value=""></option>
                                    <?php foreach (@$layanan as $v) { ?>
                                    <option value="<?=$v->id;?>"><?=$v->layanan;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label>Category</label>
                                <select class="form-control form-control-sm" name="i_kategori" onchange="pilihSubject(this.value)">
                                    <option value=""></option>
                                    <?php foreach ($tic_kategori as $v) { ?>
                                    <option value="<?=$v->id;?>"><?=$v->nama_kategori;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label>Subject</label>
                                <select class="form-control form-control-sm" name="i_subject" id="i_subject">
                                    <option value=""></option>
                                    <option value="problem">Problem</option>
                                    <option value="change">Change Request</option>
                                    <option value="information">Information</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label>Group</label>
                                <select class="form-control form-control-sm" onchange="getiPIC(this);" name="i_grp" id="grp" aria-invalid="false" required>
                                    <option value=""></option>
                                    <option value="oprlvl1">OPR Level 1</option>
                                    <option value="oprlvl2">OPR Level 2</option>
                                    <option value="oprlvl3">OPR Level 3</option>
                                    <option value="oprlvl4">OPR Level 4</option>
                                    <!--option value="oprlvl5">OPR Level 5</option-->
                                </select>								
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Assigned To</label>
                                <select class="form-control form-control-sm" name="i_pic">
                                    <option value=""></option>
                                </select>							
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>SLA/Urgency</label>
                                <select class="form-control form-control-sm" name="i_sla" id="sla" required>
                                    <option value=""></option>
                                    <option value="1">Critical</option>
                                    <option value="2">High</option>
                                    <option value="3">Medium</option>
                                    <option value="4">Low</option>
                                </select>						
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-2">
                                <label>Status</label>
                                <select class="form-control form-control-sm" name="i_status" id="status" aria-required="true" aria-invalid="false" required>
                                    <option value=""></option>
                                    <option value="new">new</option>
                                    <option value="pending">pending</option>
                                    <option value="progress">progress</option>
                                    <option value="done">done</option>
                                    <option value="closed">closed</option>
                                </select>							
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label>Provinsi</label>
                            <select class="form-control form-control-sm" name="i_provinsi"  onchange="getKota()" id="i_provinsi" aria-required="true" aria-invalid="false">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label>Kota</label>
                            <select class="form-control form-control-sm" name="i_kota" id="i_kota" aria-required="true" aria-invalid="false">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label>Nama Lokasi</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control form-control-sm" name="i_node_id"></select>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control form-control-sm" name="i_node_id_inp" placeholder="tulis nama lokasi disini kalau dipilihan sebelah kiri gak ada!">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label>Alamat</label>
                                <input class="form-control form-control-sm" name="i_alamat">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Detail</label>
                                <textarea class="form-control form-control-sm" name="i_body"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Notes</label>
                                <textarea class="form-control form-control-sm" name="i_notes"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label>Upload File </label>
                                <input class="form-control form-control-sm" type="file" name="file">
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="modal-footer ">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    <button type="submit" id="btn_submit"  class="btn btn-success">Save</button>
                    <button id="btn_loading" style="display:none;" class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span class="sr-only">Loading...</span>
                                     </button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-lg-up" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post"  id="updateticket" action="javascript:void(0)" >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Customer</label>
                                <select class="form-control form-control-sm" name="customert" onchange="getCusTicLayanan(this.value,'layanant')">
                                    <option value="">- Choose Customer -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label>Reported By</label>
                                <input class="form-control form-control-sm" name="reporter">
                                <input type="hidden" name="id">
                                <input type="hidden" name="dtm">
                                <input type="hidden" name="ticketno">
                                <input type="hidden" name="createdBy">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label>Layanan</label>
                                <select class="form-control form-control-sm" name="layanant">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Category</label>
                                <select class="form-control form-control-sm" name="kategori" onchange="getSubject(this.value)">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Subject</label>
                                <select class="form-control form-control-sm" name="subject" id="i_subject">
                                    <option value=""></option>
                                    <option value="problem">Problem</option>
                                    <option value="change">Change Request</option>
                                    <option value="information">Information</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label>SLA/Urgency</label>
                                <select class="form-control form-control-sm" name="sla" id="sla">
                                    <option value=""></option>
                                    <option value="1">Critical</option>
                                    <option value="2">High</option>
                                    <option value="3">Medium</option>
                                    <option value="4">Low</option>
                                </select>						
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label>Provinsi</label>
                                <select class="form-control form-control-sm" name="provinsi" id="provinsi" onchange="getKota(this.value)" aria-required="true" aria-invalid="false">
                                    <option value=""></option>
                                </select>							
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <label>Kota</label>
                                <select class="form-control form-control-sm" name="kota" id="kota" aria-required="true" aria-invalid="false">
                                    <option value=""></option>
                                </select>							
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label>Nama Lokasi </label>
                                <input class="form-control form-control-sm" readonly name="node_id">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-2">
                                <label>Alamat </label>
                                <input class="form-control form-control-sm"  name="alamat">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Detail</label>
                                <textarea class="form-control form-control-sm" name="body"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal" id="modal-history"  aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Ticket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                   <div class="col-md-6">
                       <div class="row mb-3">
                            <div class="col-md-6">No Ticket</div>
                            <div class="col-md-6">
                                <div class="txtNoTicket">-</div>
                            </div>
                       </div>
                       <div class="row mb-3">
                            <div class="col-md-6">Customer</div>
                            <div class="col-md-6">
                                <div class="txtCustomer">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Node ID</div>
                            <div class="col-md-6">
                                <div class="txtNodeID">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Report By</div>
                            <div class="col-md-6">
                                <div class="txtReportBy">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Layanan</div>
                            <div class="col-md-6">
                                <div class="txtLayanan">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">SLA Urgency</div>
                            <div class="col-md-6">
                                <div class="txtSLAUrgency">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">File</div>
                            <div class="col-md-6">
                                <div class="txtFile">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Waktu Penyelesaian</div>
                            <div class="col-md-6">
                                <div class="txtWP">-</div>
                            </div>
                        </div>
                   </div>
                   <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-md-6">Category</div>
                            <div class="col-md-6">
                                <div class="txtCategory">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Subject</div>
                            <div class="col-md-6">
                                <div class="txtSubject">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Status</div>
                            <div class="col-md-6">
                                <div class="txtStatus">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Last Update</div>
                            <div class="col-md-6">
                                <div class="txtLastUpdate">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Assigned To</div>
                            <div class="col-md-6">
                                <div class="txtAssign">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Provinsi</div>
                            <div class="col-md-6">
                                <div class="txtProv">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Kota</div>
                            <div class="col-md-6">
                                <div class="txtKota">-</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Alamat</div>
                            <div class="col-md-6">
                                <div class="txtAlamat">
                                    -
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">Detail</div>
                            <div class="col-md-6">
                                <div class="txtDetail">
                                    -
                                </div>
                            </div>
                        </div>
                   </div>
                </div>

                <hr>
                <div class="row">
                   
                    <div class="col-md-6">
                        <h4>History</h4>
                        <div class="row" id="konten_history" style="overflow-y: scroll;max-height: 300px;">

                            <div class="col-md-12">
                                <div class="card" style="background-color: #FFF;">
                                    <div class="card-body text-center">
                                        Tidak Ada
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>

                    <div class="col-md-6" id="upd_user">
                        <h4>Update</h4>
                        <form action="javascript:void(0)" method="POST" id="inHTicket">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="mb-2">Select Group</div>
                                    <select class="form-control form-control-sm" onchange="getPIC('','',    this.value)" id="group" name="hgrp">
                                        <option value="">All Groups</option>
                                        <option value="oprlvl1">OPR Level 1</option>
                                        <option value="oprlvl2">OPR Level 2</option>
                                        <option value="oprlvl3">OPR Level 3</option>
                                        <option value="oprlvl4">OPR Level 4</option>
                                        <!--option value="oprlvl5">OPR Level 5</option-->
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">Assigned To</div>
                                    <select class="form-control form-control-sm" id="pic" name="hpic">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-4">
                                    <div class="row">
                                        <div class="col-md-3">Status</div>
                                        <div class="col-md-9">
                                            <select name="h_status" class="form-control form-control-sm">
                                                <option value="">-- Pilih Status --</option>
                                                <option value="new">new</option>
                                                <option value="pending">pending</option>
                                                <option value="progress">progress</option>
                                                <option value="done">done</option>
                                                <option value="closed">closed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-4">
                                   <div class="sclosed"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mb-2">
                                        <div class="col-md-3">Upload File</div>
                                        <div class="col-md-9">
                                            <div class="dadada" style="background: #fff5f4;border-radius: 10px;padding: 7px 0px;">
                                            <input type="hidden" name="h_ticket_id" class="form-control form-control-sm">
                                            <input type="file" name="h_file" class="form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row mb-2">
                                        <div class="col-md-3">Note</div>
                                        <div class="col-md-9">
                                        <textarea class="form-control form-control-sm" name="h_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" style="text-align: end;">
                                    <input type="submit" value="Save" id="btn_submit2" class="btn btn-danger">
                                    <button id="btn_loading2" style="display:none;" class="btn btn-primary" type="button" disabled>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        <span class="sr-only">Loading...</span>
                                     </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
                
            </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<script src="<?= base_url('template/');?>plugins/socket_io.js"></script>
