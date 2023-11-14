<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"></div>
                
                <div class="card-body">
                    <form action="javascript:void(0);" method="post" id="addtcustomer">
                        <div class="form-group">
                            <label for="">Customer</label>
                            <select class="form-control" name="customer" id="ctr">
                                <option value=""></option>
                                <?php foreach ($customers as $v) { ?><
                                    <option value="<?=$v->id;?>"><?=$v->nama_customer?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Device</th>
                                        <th>IP</th>
                                        <th>Akses</th>
                                        <th>Port</th>
                                        <th>User</th>
                                        <th>Password</th>
                                        <th>Enable</th>
                                        <th>
                                            <button class="btn btn-danger" type="button" onclick="add()">add</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <tr class="ts">
                                        <td><input type="text" name="device[]" class="form-control"></td>
                                        <td><input type="text" name="ip[]" class="form-control"></td>
                                        <td><input type="text" name="access[]" class="form-control"></td>
                                        <td><input type="text" name="port[]" class="form-control"></td>
                                        <td><input type="text" name="user[]" class="form-control"></td>
                                        <td><input type="text" name="password[]" class="form-control"></td>
                                        <td><input type="text" name="enable[]" class="form-control"></td>
                                        <td>-</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <input type="submit" class="btn btn-warning" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>