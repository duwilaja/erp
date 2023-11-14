<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Data Partner List
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabelC">
                        <thead>
                            <tr>
                                <th>ID Project</th>
                                <th>Service</th>
                                <th>Category</th>
                                <th>Area</th>
                                <th>Location</th>
                                <th>PIC</th>
                                <th>Salary</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PRJ001</td>
                                <td>Nama Project Running</td>
                                <td>Maintenance</td>
                                <td>Prov 1</td>
                                <td>Lokasi 1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#detailModal" class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-danger btn-sm"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">ID Project</label></div>
                                <div class="col-md-6">
                                    <input name="id" type="text" class="form-control" value="tes" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Service</label></div>
                                <div class="col-md-6">
                                    <input name="service" type="text" class="form-control" value="tes">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Category</label></div>
                                <div class="col-md-6">
                                    <input name="category" type="text" class="form-control" value="tes">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Area</label></div>
                                <div class="col-md-6">
                                    <input name="area" type="text" class="form-control" value="tes">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Location</label></div>
                                <div class="col-md-6">
                                    <input name="lokasi" type="text" class="form-control" value="tes">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">PIC</label></div>
                                <div class="col-md-6">
                                    <select name="pic" class="custom-select">
                                        <option value="">Nama PIC 1</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Salary</label></div>
                                <div class="col-md-6">
                                    <input name="salary" type="text" class="form-control" value="tes">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Status</label></div>
                                <div class="col-md-6">
                                    <select name="status" class="custom-select">
                                        <option value="progress">On Progress</option>
                                        <option value="done">Done</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">ID Project</label></div>
                                <div class="col-md-6">
                                    PRT001
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Service</label></div>
                                <div class="col-md-6">
                                    Project Running 1
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Category</label></div>
                                <div class="col-md-6">
                                    Maintenance
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Description</label></div>
                                <div class="col-md-6">
                                    Ganti Perangkat HSA 
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Area</label></div>
                                <div class="col-md-6">
                                    Provinsi 1
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Location</label></div>
                                <div class="col-md-6">
                                    Lokasi 1
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">PIC</label></div>
                                <div class="col-md-6">
                                    PIC 1
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Salary</label></div>
                                <div class="col-md-6">
                                    200.000/site
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Contact</label></div>
                                <div class="col-md-6">
                                    0811111111
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Status</label></div>
                                <div class="col-md-6">
                                    Done
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>