<style>
    tbody tr td {
        font-size:14px;
    }
    label:not(.form-check-label):not(.custom-file-label){
        color:#666;
        font-weight: 400 !important;
    }
    .select2{
        width: 100% !important;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col">
                            New Customer
                        </div>
                        <div class="col-md-6 col text-right col">
                            <!-- <a href="#" data-toggle="modal" data-target="#addModal"  class="btn btn-outline-danger btn-sm">Add New</a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive" style="width:100%" >
                    <table class="table display nowrap" id="tpipeline">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Project</th>
                                <th>Product Solution</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Activity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlFrom">Edit Pipeline</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" method="post" class="formEditPipeline" id="formEditPipeline"  enctype="multipart/form-data">
            <div class="modal-body">
                    <div id="txt_pen" style="display:none;">Edit</div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Projek </label>
                            <input type="hidden" name="e_id" class="form-control form-control-sm mb-2">
                            <input type="text" name="e_projek" class="form-control form-control-sm mb-2"  placeholder="Masukan nama projek disini">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Customer</label>
                                    <select name="e_customer" id="cust" class="form-control form-control-sm" onchange="detailCus(this.value)">
                                        <?php foreach ($customers as $v) { ?>
                                        <option value="<?=$v->id;?>"><?=$v->customer;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>End Customer</label>
                                    <select name="e_end_cust" id="custend" onchange="detailEndCus(this.value)" class="form-control form-control-sm">
                                        <?php foreach ($end_cust as $v) { ?>
                                        <option value="<?=$v->id;?>"><?=$v->custend;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Solution</label>
                            <select name="e_solution" class="form-control form-control-sm">
                                        <?php foreach ($solution as $v) { ?>
                                            <option value="<?=$v->id;?>"><?=$v->solution;?></option>
                                        <?php } ?>
                                    </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Product</label>
                            <select name="e_product" class="form-control form-control-sm">
                                <?php foreach ($product as $v) { ?>
                                <option value="<?=$v->id;?>"><?=$v->product;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Category</label>
                            <select name="e_category" class="form-control form-control-sm">
                                <option value="pp">Potential Prospect</option>
                                <option value="pt">Potential Target</option>
                                <option value="qo">Qualified Opportunity</option>
                            </select>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">Note</label>  
                            <textarea class="form-control form-control-sm" name="e_note"></textarea>
                        </div>
                    </div>
            </div>

            <input name="tcustomer" type="hidden"  class="form-control form-control-sm">
            <input name="tcustend" type="hidden"  class="form-control form-control-sm">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>