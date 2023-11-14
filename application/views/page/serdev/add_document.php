<style>
    .title-text{
        font-size: 17px;
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <span style="font-size:18px;">Upload Here</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title-text"><b>List Upload Document</b></div>
                        </div>
                    </div>
                    <table class="table table-bordered table-responsive" style="width:100%;display: table;border-top: solid 2px#343a40;margin-top: 6px;">
                        <thead>
                            <th>Name</th>
                            <th>File</th>
                            <th>Type</th>
                            <th>Action</th>
                        </thead>
                        <tr class="ts">
                            <td>Siap dilaksanakan</td>
                            <td>SIAP.PDF</td>
                            <td>PDF</td>
                            <td><i class="fa fa-eye"></i></td>
                        </tr>
                    </table>
                </div>
               
            </div>
        </div>
    </form>
</div>
</div>