<section class="content">
    <div class="row">
        <input type="hidden" name="poid" id="poid" value="<?=$this->input->get('id')?>">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title" >Detail Inventory <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Merk</td>
                                <td>Type</td>
                                <td>Qty</td>
                                <td>Price/unit</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>RansNet</td>
                                <td>HSG-100</td> 
                                <td>20</td> 
                                <td>10.000.000</td> 
                                <td><a href="#" data-toggle="modal" data-target="#modal_create_asset"  class="btn btn-default btn-sm"><i class="fa fa-barcode"></i></a></td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>


<!-- Add Modal -->
<div class="modal fade" id="modal_create_sn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlFrom">Fill SN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" method="post" class="formEditPipeline" id="add_form_sn"  enctype="multipart/form-data">
            <div class="modal-body">
                    <input type="hidden" name="id" value="<?=$this->input->get('id');?>">
                    <div id="txt_pen" style="display:none;">add</div>
                    <div class="row">
                <div class="col-md-12">
                
                    <div class="col-md-12">
                    <div id="form_sn">
                        <table class="table table-bordered" id="tabel_sn">
                            <thead>
                                <tr>
                                    <th style="width:40px;">No</th>
                                    <th>Serial Number</th>
                                </tr>
                            </thead>
                            <tbody id="list_sn">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn-save" class="btn btn-warning">Save</button>
                <button class="btn btn-primary" id="btn-save-loading" style="display:none;" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
                </button>
            </div>
            </form>

        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="modal_list_sn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlFrom">List SN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <div class="row">
                <div class="col-md-12">
                
                    <div class="col-md-12">
                    <div id="form_sn_2">
                        <table class="table table-bordered" id="list_tabel_sn">
                            <thead>
                                <tr>
                                    <th style="width:40px;">No</th>
                                    <th>Device</th>
                                    <th>Serial Number</th>
                                </tr>
                            </thead>
                            <tbody id="lists_sn">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
            </div>


        </div>
    </div>
</div>