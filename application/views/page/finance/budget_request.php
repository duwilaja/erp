<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col">Budget Request</div>
                        <div class="col-md-6 col text-right">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Detail</th>
                                <th>Purpose</th>
                                <th>Period</th>
                                <th>Nominal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pengajuan budget untuk bulan Januari</td>
                                <td>Kas</td>
                                <td>Januari</td>
                                <td>5.000.000</td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
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
                        <div class="col"><input type="text" name="detail" class="form-control"></div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col"><label for="">Purpose</label></div>
                        <div class="col"><input type="text" name="purpose" class="form-control"></div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col"><label for="">Period</label></div>
                        <div class="col">
                            <select class="custom-select" name="bulan">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col"><label for="">Nominal</label></div>
                        <div class="col"><input type="text" name="nominal" class="form-control"></div>
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