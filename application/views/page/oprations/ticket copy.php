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

    .btn-purple:hover{
        color:#FFF;
        background-color: #533092;
    }
</style>
<div class="dtRahasia" style="display: none;"><?=@$dtRahasia;?></div>
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
                               <option value="resolved">resolved</option>
                               <option value="closed">closed</option>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" id="costumer" name="customerf"> 
                               <option value="">All Costumer</option>
                               <?php foreach ($customers as $v) { ?>
                                   <option value="<?=$v->id;?>"><?=$v->nama_customer;?></option>
                               <?php } ?>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" name="slaf">
                               <option value="">All Priority</option>
                               <option value="1">Critical</option>
                               <option value="2">High</option>
                               <option value="3">Medium</option>
                               <option value="4">Low</option>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-control form-control-sm" id="group" name="grpf">
                               <option value="">All Groups</option>
                               <option value="oprlvl1">OPR Level 1</option>
                               <option value="oprlvl1bali">OPR Level 1 Bali</option>
                               <option value="oprlvl2">OPR Level 2</option>
                               <option value="oprlvl3">OPR Level 3</option>
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
                            <td>Receive Date</td>
                            <td>Customer</td>
                            <td>Node ID</td>
                            <td>Reported By</td>
                            <td>SLA</td>
                            <td>Subject</td>
                            <td>Detail</td>
                            <td>Group</td>
                            <td>NOC</td>
                            <td>Status</td>
                            <td>Last Update</td>
                            <td>Updated By</td>
                            <td>Notes</td>
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
                                <select class="form-control form-control-sm" name="i_customer">
                                    <option value="">- Choose Customer -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Reported By</label>
                                <input class="form-control form-control-sm" name="i_reporter">
                                <input type="hidden" name="id">
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
                                <select class="form-control form-control-sm" onchange="getiPIC(this);" name="i_grp" id="grp" aria-invalid="false">
                                    <option value=""></option>
                                    <option value="oprlvl1">OPR Level 1</option>
                                    <option value="oprlvl1bali">OPR Level 1 Bali</option>
                                    <option value="oprlvl2">OPR Level 2</option>
                                    <option value="oprlvl3">OPR Level 3</option>
                                </select>								
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Status</label>
                                <select class="form-control form-control-sm" name="i_status" id="status" aria-required="true" aria-invalid="false">
                                    <option value=""></option>
                                    <option value="new">new</option>
                                    <option value="pending">pending</option>
                                    <option value="progress">progress</option>
                                    <option value="resolved">resolved</option>
                                    <option value="closed">closed</option>
                                </select>							
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>SLA/Urgency</label>
                                <select class="form-control form-control-sm" name="i_sla" id="sla">
                                    <option value=""></option>
                                    <option value="1">Critical</option>
                                    <option value="2">High</option>
                                    <option value="3">Medium</option>
                                    <option value="4">Low</option>
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
                                <label>Node ID </label>
                                <input class="form-control form-control-sm" name="i_node_id">
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
                    <button type="submit" class="btn btn-success">Save</button>
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
                                <select class="form-control form-control-sm" name="customer">
                                    <option value="">- Choose Customer -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Reported By</label>
                                <input class="form-control form-control-sm" name="reporter">
                                <input type="hidden" name="id">
                                <input type="hidden" name="dtm">
                                <input type="hidden" name="ticketno">
                                <input type="hidden" name="createdBy">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label>Category</label>
                                <select class="form-control form-control-sm" name="kategori" onchange="getSubject(this.value)">
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
                                <select class="form-control form-control-sm" name="subject" id="i_subject">
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
                                <select class="form-control form-control-sm" onchange="getPIC(this);" name="grp" id="grp" aria-invalid="false">
                                    <option value=""></option>
                                    <option value="oprlvl1">OPR Level 1</option>
                                    <option value="oprlvl1bali">OPR Level 1 Bali</option>
                                    <option value="oprlvl2">OPR Level 2</option>
                                    <option value="oprlvl3">OPR Level 3</option>
                                </select>								
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Status</label>
                                <select class="form-control form-control-sm" name="status" id="status" aria-required="true" aria-invalid="false">
                                    <option value=""></option>
                                    <option value="new">new</option>
                                    <option value="pending">pending</option>
                                    <option value="progress">progress</option>
                                    <option value="resolved">resolved</option>
                                    <option value="closed">closed</option>
                                </select>							
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Assigned To</label>
                                <select class="form-control form-control-sm" name="pic">
                                    <option value=""></option>
                                </select>							
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Node ID </label>
                                <input class="form-control form-control-sm" readonly name="node_id">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Detail</label>
                                <textarea class="form-control form-control-sm" name="body"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Notes</label>
                                <textarea class="form-control form-control-sm" name="notes"></textarea>
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
                <h4 class="modal-title">History</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tabel_h" class="table" style="overflow: scroll;
                overflow: auto; ">
                <thead style="background:#ffc107;color:#FFF;">
                    <tr>
                        <td>#</td>
                        <td>Receive Date</td>
                        <td>Customer</td>
                        <td>Node ID</td>
                        <td>Reported By</td>
                        <td>SLA</td>
                        <td>Subject</td>
                        <td>Detail</td>
                        <td>Group</td>
                        <td>NOC</td>
                        <td>Status</td>
                        <td>Last Update</td>
                        <td>Updated By</td>
                        <td>Notes</td>
                    </tr>
                </thead>
                
            </table>
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
