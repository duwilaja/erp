<section class="content">
    <div class="row">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Report List
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#formAddReport" class="btn btn-danger">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>EOS</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Daily Task</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Add Modal -->
<div class="modal fade" id="formAddReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dialy Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="addReport">
                    <div class="row">
                        <div class="col-md-10">
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">EOS</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="status" class="custom-select">
                                        <option value="1">Pegadaian</option>
                                        <option value="2">Pertamina</option>
                                        <option value="3">Korlantas</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Name</label>
                                </div>
                                <div class="col-md-6 col">
                                    <select name="status" class="custom-select">
                                        <option value="1">EOS Pegadaian 1</option>
                                        <option value="2">EOS Pegadaian 2</option>
                                        <option value="3">EOS Pegadaian 3</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4"><label for="">Date</label></div>
                                <div class="col-md-6">
                                    <input type="date" name="invdate" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col">
                                    <label for="">Daily Task</label>
                                </div>
                                <div class="col-md-6 col">
                                    <textarea name="address" class="form-control"></textarea>
                                </div>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>