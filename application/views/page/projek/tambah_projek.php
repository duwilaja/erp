<div class="card ">
    <div class="card-header card-black">
        <h3 class="card-title">Form <?=$title;?></h3>
    </div>
    <form role="form" method="POST" action="<?=site_url('project/inProfitability_plan')?>">
        <div class="card-body" style="font-size:15px;">
            <div class="row">
                <div class="col-md-6">
                    <!-- text input -->
                    <div class="form-group mb-2">
                        <label>Customer Name</label>
                        <select class="form-control" name="costumer" id="customer">
                            <option value="">- Choose Customer -</option>
                            <?php foreach ($customers as $v) { ?>
                            <option value="<?=$v->id;?>"><?=$v->kodec.' - '.$v->nama_customer;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label>End Costumer</label>
                        <input class="form-control" name="end_costumer">
                    </div>
                    <div class="form-group mb-2">
                        <label>Project Duration</label>
                        <div>
                            <select class="select form-control" name="project_duration" id="pd">
                                <option value="">- Select Duration -</option>
                                <?php for ($i=1; $i <= 12; $i++) {  ?>
                                    <option value="<?=$i;?>"><?=$i;?> Bulan</option>   
                                <?php  } ?> 
                                <?php for ($i=1; $i <= 10; $i++) {  ?>
                                    <option value="<?=$i;?>"><?=$i;?> Tahun</option>   
                                <?php  } ?> 
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label>Project Name</label>
                        <input class="form-control" name="project_name">
                    </div>
                    
                    <div class="form-group mb-2">
                        <label>Project Quality</label>
                        <div style="display: flex;">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="qq" name="project_quality">
                                <label class="form-check-label">QQ</label>
                            </div>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="radio" value="pp" name="project_quality">
                                <label class="form-check-label">PP</label>
                            </div>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="radio" value="pt" name="project_quality">
                                <label class="form-check-label">PT</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label>Customer PIC</label>
                        <input class="form-control" name="costumer_pic">
                    </div>
                    <div class="form-group mb-2">
                        <label>End Costumer PIC</label>
                        <input class="form-control" name="end_costumer_pic">
                    </div>
                    <div class="form-group mb-2">
                        <label>Estimate Closing Deal Date</label>
                        <input type="date" class="form-control" name="estimate_cdd">
                    </div>
                    <div class="form-group mb-2">
                        <label>Estimate Start Date</label>
                        <input type="date" class="form-control" name="estimate_start_date">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-2">
                                <label>Estimate Value On</label>
                                <select class="form-control" name="estimate_value_on">
                                    <option value="idr">IDR</option>
                                    <option value="usd">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label>Total Project</label>
                                <input type="number" class="form-control" name="total_project" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered table-responsive" style="width:100%;display: table;border-top: solid 2px#343a40;margin-top: 6px;">
                        <tr class="th">
                            <td><input class="form-control" readonly name="text-hardware" value="Hardware"></td>
                            <td>
                                <select class="form-control" name="hardware[]">
                                    <option>Tidak Ada</option>
                                    <option>option 1</option>
                                    <option>option 2</option>
                                </select>
                            </td>
                            <td><input class="form-control" name="amount_hardware[]" onkeyup="cekInput()" placeholder="Amount"></td>
                            <td><button type="button" class="btn btn-secondary btn-sm w-100" onclick="addHardware()">Add</button></td>
                        </tr>
                        <tr class="ts">
                            <td><input class="form-control" readonly name="text-hardware" value="Software"></td>
                            <td>
                                <select class="form-control" name="software[]">
                                    <option>Tidak Ada</option>
                                    <option>option 1</option>
                                    <option>option 2</option>
                                </select>
                            </td>
                            <td><input class="form-control" name="amount_software[]"  onkeyup="cekInput()" placeholder="Amount"></td>
                            <td><button type="button" class="btn btn-secondary btn-sm w-100" onclick="addSoftware()">Add</button></td>
                        </tr>
                        <tr class="pcs">
                            <td colspan="1"><input class="form-control"  name="product[]" value=""></td>
                            <td colspan="2"><input class="form-control" type="number" name="amount_pricing[]" onkeyup="cekInput()" placeholder="Amount"></td>
                            <td><button type="button" class="btn btn-secondary btn-sm w-100" onclick="addPricing()">Add</button></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="background:whitesmoke;"><b>Margin</b></td>
                            <td style="background: whitesmoke;font-weight: bold;"><span id="total_margin">0</span><input type="hidden" class="form-control"  name="i_total_margin" value=""></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-body" style="border-top: solid 2px #17a2b8;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Renewal Project</label>
                                        <div style="display: flex;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="renewal_project">
                                                <label class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="radio" value="0" name="renewal_project">
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>By Partner</label>
                                        <select class="form-control" name="by_partner" id="partner"> 
                                             <option value="">- Please Select Partner -</option>
                                             <?php foreach ($partners as $v) {
                                                echo "<option value=".$v->id.">".$v->partnername."</option>";
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Hardware Ownerd By Matrik</label>
                                        <div style="display: flex;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="1" name="by_matrik">
                                                <label class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check ml-2">
                                                <input class="form-check-input" type="radio" value="0" name="by_matrik">
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label>Delivery Location</label>
                                        <select class="form-control" name="delivery_location" id="delivery_location">
                                            <option value="">- Please Select Location -</option>
                                            <?php foreach ($areas as $v) {
                                                echo "<option value=".$v->id.">".$v->areaname."</option>";
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="bttn" style="float:right;">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </form>
</div>
</div>