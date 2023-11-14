<style>
    .title-text{
        font-size: 17px;
        border-left: solid 3px #555;
        padding-left: 9px;

    }
</style>
<div class="card ">
    <div class="card-header card-black">
        <h3 class="card-title">Form <?=$title;?></h3>
    </div>
    <form role="form">
        <div class="card-body" style="font-size:15px;">
            <div class="row">
                <div class="col-md-12">
                    <!-- text input -->
                    <div class="form-group mb-2">
                        <label>Project Name</label>
                        <select class="form-control" name="project_name" id="project">
                            <option value=""> </option>
                            <option> PT. ABC </option>
                            <option> PT. BBC </option>
                        </select>
                    </div>                    
                </div>
                <div class="col-md-6">
                   <div class="form-group mb-2">
                        <label>Project Amount</label>
                        <input type="number" readonly class="form-control" name="project_amount"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label>Total TOP (Term Of Payment)</label>
                        <input type="number" readonly class="form-control" name="project_amount"> 
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-12 mt-2">
                  <div class="title-text"><b> <input type="radio" name="gender" value="2"> One Time</b></div>
                    <table class="table table-bordered table-responsive" style="width:100%;display: table;border-top: solid 2px#343a40;margin-top: 6px;">
                        <thead>
                            <th>Inv Period</th>
                            <th>Target Date</th>
                            <th>Start Date</th>
                            <th>Total Amount</th>
                            <th>Note</th>
                            <th>Status</th>
                        </thead>
                        <tr class="l">
                            <td>
                                <select class="form-control" name="period_ot">
                                    <option>Tidak Ada</option>
                                    <?php for ($i=1; $i <= 12 ; $i++) { ?> 
                                    <option value="<?=$i;?>"><?=$i;?> Bulan</option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><input type="date" class="form-control" name="target_ot" placeholder="Target Date"></td>
                            <td><input type="date" class="form-control" name="start_ot" placeholder="Start Date"></td>
                            <td><input  type="number" class="form-control" name="amount_ot" placeholder="Total Amount"></td>
                            <td><input type="text" class="form-control" name="total_amount_ot" placeholder="Note"></td>
                            <td>
                                <select class="form-control" name="status_ot">
                                    <option value="1">Belum Lunas</option>
                                    <option value="2">Lunas</option>
                                </select>
                            </td>
                        </tr>
                        
                    </table>
                </div>
                
                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title-text"><b><input type="radio" name="gender" value="2"> Reccuring</b></div>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-default" onclick="add()"><i class="fa fa-plus"></i> Add Reccuring</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-responsive" style="width:100%;display: table;border-top: solid 2px#343a40;margin-top: 6px;">
                        <thead>
                            <th>Inv Period</th>
                            <th>Target Date</th>
                            <th>Start Date</th>
                            <th>Total Amount</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Act</th>
                        </thead>
                        <tr class="ts">
                            <td>
                                <select class="form-control" name="period[]">
                                    <option>Tidak Ada</option>
                                    <?php for ($i=1; $i <= 12 ; $i++) { ?> 
                                    <option value="<?=$i;?>"><?=$i;?> Bulan</option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><input type="date" class="form-control" name="target[]" placeholder="Target Date"></td>
                            <td><input type="date" class="form-control" name="start[]" placeholder="Start Date"></td>
                            <td><input  type="number" class="form-control" name="amount[]" placeholder="Total Amount"></td>
                            <td><input type="text" class="form-control" name="total_amount[]" placeholder="Note"></td>
                            <td>
                                <select class="form-control" name="status[]">
                                    <option value="1">Belum Lunas</option>
                                    <option value="2">Lunas</option>
                                </select>
                            </td>
                            <td><button class="btn btn-danger" disabled><i class="fa fa-trash"></i></button></td>
                        </tr>
                    </table>
                </div>
               
            </div>
        </div>
    </form>
</div>
</div>