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
    
    .box-data{
        background : #FFF;
        padding:10px;
        border-radius:4px;
        text-align: center;
        
    }
    
    .box-data .isi {
        font-size:20px;
    }
    
    .judul {
        font-size: 13px;
        margin-top: 6px;
        margin-bottom: 3px;
        border-radius: 10px;
    }
    
    .estimasi {
        background: #fff0f0;
    }
    
    .terbayar {
        background: #dfffdc;
    }
    
    .terhutang {
        background: #f0f2ff;
    }
    
    .xstatus{
        position: absolute;
        font-size: 13px;
        padding: 0 13px;
        border: solid 1px;
        border-right: none;
        right: 0;
        border-radius: 0 0 0px 15px;
        border-top: none;
        text-transform: uppercase;
    }
    
    .nc{
        font-size: 12px;
        color:#6c757d;
    }
    
    .s0{
        color:#6c757d;
    }
    
    .s1{
        color:#fd7e14;
    }
    
    .s2{
        color:#e83e8c;
    }
    
    .s3{
        color:#20c997;
    }
    a{
        color:#6c757d;
    }
    
    a:hover{
        color:#6f42c1;
    }
    .select2{
        width:100% !important;
    }
    
    .select2-results{
        font-size:13px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="jdl" style="font-weight: bold;font-size: large;">Project Customer Existing</div>
            <p style="font-size: small;">Data Project Customer Existing</p>
            <br>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <button class="btn btn-outline-danger btn-sm" style="position:relative;top:20px;" data-toggle="modal" data-target="#addCustomer" >Add Customer Existing</button>
            </div>
        </div>
    </div>
    <div class="card-all">
    </div>
</div>

<div class="loading" style="display: none;">Loading&#8230;</div>

<!-- Add New Project Modal -->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlFrom">Add Project Exisitng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="javascript:void(0);" method="post" class="formEditPipeline" id="add_projek_existing"  enctype="multipart/form-data">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">Projek</div>
                        <div class="col-md-9"><input type="text" name="projek" class="form-control form-control-sm"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">Customer</div>
                        <div class="col-md-9">
                            <select name="customer"  id="customers" class="form-control form-control-sm">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">End Customer</div>
                        <div class="col-md-9">
                            <select name="endcust"  id="endcust" class="form-control form-control-sm">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">No. Kontrak</div>
                        <!-- <input type="hidden" name="id" id="id" value="<?=$this->input->get('id');?>"> -->
                        <div class="col-md-9"><input type="text" name="no_kontrak" id="no_kontrak" class="form-control form-control-sm"></div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-3">Masa Kontrak</div>
                        <div class="col-md-9"><input type="text" name="masa_kontrak" id="masa_kontrak" class="form-control form-control-sm"></div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-3">Jenis</div>
                        <div class="col-md-9">
                            <select  name="jenis" id="jenis" class="form-control form-control-sm">
                                <option value=""></option>
                                <option value="otc">OTC</option>
                                <option value="mrc">MRC</option>
                            </select>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-md-3">Periode</div>
                        <div class="col-md-3"><input type="date" name="start_date" id="start_date" class="form-control form-control-sm"></div>
                        <div class="col-md-3">sampai dengan tanggal</div>
                        <div class="col-md-3"><input type="date" name="end_date" id="end_date" class="form-control form-control-sm"></div>
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
                        <div class="col-md-9"><input type="file" name="kontrak" id="kontrak" class="form-control form-control-sm" required></div>
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