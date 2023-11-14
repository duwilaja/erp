<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col">Petty Cash Project</div>
                        <div class="col-md-6 col text-right">
                            <!-- <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm">Add New</a> -->
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Project</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>M001</td>
                                <td>Sesuai PO</td>
                                <td>Profit</td>
                                <td>
                                    <a href="<?=site_url('finance/project_detail')?>" class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Budget Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-row">
                        <div class="col"><label for="">Detail</label></div>
                        <div class="col"><input name="detail" type="text" class="form-control"></div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col"><label for="">Purpose</label></div>
                        <div class="col"><input name="purpose" type="text" class="form-control"></div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col"><label for="">Period</label></div>
                        <div class="col">
                            <input name="period" type="date" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col"><label for="">Nominal</label></div>
                        <div class="col"><input name="nominal" type="text" class="form-control"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <input type="submit" class="btn btn-danger" value="Request">
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>