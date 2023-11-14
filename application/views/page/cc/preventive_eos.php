<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     Data Preventive EOS
                </div>
                
                <div class="card-body">
                    <div class="form-upload">
                        <form action="javascript:void(0)" method="post" id="formPreventiveEos" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="customer">Customer</label>
                                        <select name="customer" class="form-control" id="ctr">
                                            <?php foreach ($customer as $v) { ?>
                                                <option value="<?=$v->id?>"><?=$v->nama_customer?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="upload">Upload File</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="submit" style="position:relative;top:30px;" value="Save" class="w-100 btn btn-outline-danger">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                        <table id="tabelEos" class="table" style="overflow: scroll;
                        overflow: auto; ">
                        <thead style="background:#31302c;color:#FFF;">
                            <tr>
                                <td>#</td>
                                <td>Customer</td>
                                <td>File</td>
                                <td>Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        
                    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


