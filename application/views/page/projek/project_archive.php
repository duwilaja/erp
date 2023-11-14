<style>
.select2-container--default{
    width:100%!important;
}
</style>
<div class="card ">
    <div class="card-header card-black">
        <h3 class="card-title">Form <?=$title;?></h3>
    </div>
    <form role="form">
        <div class="card-body" style="font-size:15px;">
            <div class="row">
                <div class="col-md-6">
                    <!-- text input -->
                    <div class="form-group mb-2">
                        <label>Project Name</label>
                        <input class="form-control" name="project_name">
                    </div>
                    <div class="form-group mb-2">
                        <label>Account Executive</label>
                        <select class="form-control" name="ae" id="ae">
                            <option value="">  </option>
                            <option> SALES 1 </option>
                            <option> SALES 2 </option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Project Manager</label>
                        <select class="form-control" name="pm" id="pm">
                         <option value="">  </option>
                            <option> PM 1 </option>
                            <option> PM 2 </option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Currency</label>
                        <select class="form-control" name="costumer" style="width:200px;">
                            <option>IDR</option>
                            <option>USD</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label>Customer Name</label>
                        <select class="form-control" name="costumer" id="customer">
                            <option value="">  </option>
                            <?php foreach ($customers as $v) { ?>
                            <option value="<?=$v->id;?>"><?=$v->kodec.' - '.$v->nama_customer;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>Costumer PIC</label>
                        <input type="number" class="form-control" name="costumer_pic"> 
                    </div>
                    <div class="form-group mb-2">
                        <label>Contract Length</label>
                        <div class="row">
                            <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-3" style="display:flex;">
                                        <input type="number" class="form-control" name="month" style="width:60px;"> <span class="ml-2" style="line-height: 31px;">Month</span>
                                    </div>
                                    <div class="col-md-8" style="display:flex;">
                                      <span class="mr-2" style="line-height: 31px;">Initial Margin</span><input type="number" class="form-control" name="month" style="width:80px;"><span class="ml-2" style=" line-height: 31px;">%</span>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label>Total Amount</label>
                        <input type="number" class="form-control" name="total_amount" style="width:200px;">
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered table-responsive" style="width:100%;display: table;border-top: solid 2px#343a40;margin-top: 6px;">
                        <thead>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Direct Cost</th>
                            <th>Margin</th>
                            <th><button type="button" class="btn btn-secondary btn-sm w-100" onclick="add()">Add</button></th>
                        </thead>
                        <tr class="ts">
                            <td>
                                <select class="form-control w-100" name="product[]" id="product">
                                    <option value=""></option>
                                </select>
                            </td>
                            <td><input class="form-control" name="amount[]" placeholder="Amount"></td>
                            <td><input class="form-control" name="direct_cost[]" placeholder="Direct Cost"></td>
                            <td>-</td>
                            <td><button type="button" class="btn btn-danger btn-sm w-100" disabled>-</button></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="background:whitesmoke;"><b>Total Margin</b></td>
                            <td style="background: whitesmoke;font-weight: bold;" colspan="2">-</td>
                        </tr>
                    </table>
                </div>
               
            </div>
        </div>
        <div class="card-footer">
            <div class="bttn" style="float:right;">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>
</div>
</div>