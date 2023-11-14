<section class="content">
    <div class="row">
        <input type="hidden" name="type" id="type" value="<?=$this->input->get('type')?>">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title" style="position: relative;top: 5px;">Server Dell <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                    <a href="#" data-toggle="modal" data-target="#modal_create_asset"  class="btn btn-success btn-sm"> + Add</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Category</td>
                                <td>Serial Number</td>
                                <td>Condition</td>
                                <td>Mutation</td>
                                <td>Allocation</td>
                                <td>Handover Date</td>
                            </tr>
                        </thead>
                        <tbody>
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
<div class="modal fade" id="modal_create_asset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlFrom">Add New Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" method="post" class="formEditPipeline" id="form_asset"  enctype="multipart/form-data">
            <div class="modal-body">
                    <div id="txt_pen" style="display:none;">add</div>
                    <div class="row">
                <div class="col-md-12">
                    <div class="float-right mb-2">
                    <input type="hidden" name="type" value="<?=$this->input->get('type')?>">
                    <input type="hidden" name="merek" value="<?=$this->input->get('merek')?>">
                     <button class="btn btn-success btn-sm" onclick="add()" type="button"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                    <table class="table" id="tabel_list_po">
                        <thead>
                        <tr>
                            <td>Category</td>
                            <td>SN</td>
                            <td>Condition</td>
                            <td>Mutation</td>
                            <td>Allocation</td>
                            <td>Handover Date</td>
                        </tr>
                        <thead>
                        <tbody id="list_assets">
                            
                        </tbody>
                    </table>
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