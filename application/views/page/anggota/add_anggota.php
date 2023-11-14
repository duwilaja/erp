<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Tambah Anggota
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row" style="margin-bottom: 50px; padding-bottom: 50px;">
                            <div class="col-md-6" style="margin-top: 20px;">
                                <h5 style="color: tomato;">Basic Info</h5>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 col"><label for="">Pilih Anggota</label></div>
                                    <div class="col-md-6 col">
                                        <select class="custom-select">
                                            <option value="direksi">Direksi</option>
                                            <option value="direksi">Staff</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 col"><label for="">Division</label></div>
                                    <div class="col-md-6 col">
                                        <select class="custom-select">
                                            <option value="direksi">CEO</option>
                                            <option value="direksi">CTO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="margin-top: 20px;">
                                <h5 style="color: tomato;">Claim</h5>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 col"><label for="">Date</label></div>
                                    <div class="col-md-6"><input type="date" class="form-control"></div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 col"><label for="">No Claim</label></div>
                                    <div class="col-md-6"><input type="text" class="form-control" value="M005" disabled></div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 col"><label for="">Category</label></div>
                                    <div class="col-md-6">
                                        <select class="custom-select">
                                            <option value="project">Project</option>
                                            <option value="support">Support</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 col"><label for="">Service</label></div>
                                    <div class="col-md-6">
                                        <select class="custom-select">
                                            <option value="project">Sesuai Nama PO</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 col"><label for="">Task Category</label></div>
                                    <div class="col-md-6">
                                        <select id="" class="custom-select">
                                            <option value="">Implementation</option>
                                            <option value="">Maintenance</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 col"><label for="">Detail</label></div>
                                    <div class="col-md-6">
                                        <textarea name="" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table" style="min-width: 600px;">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Purpose</th>
                                            <td>Nominal</td>
                                            <th>Attach</th>
                                            <th><a href="#" class="btn btn-danger btn-sm">Add</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="custom-select">
                                                    <option value="transport">Transport</option>
                                                    <option value="entertain">Entertain</option>
                                                    <option value="dinner">Dinner</option>
                                                    <option value="project tools">Project Tools</option>
                                                    <option value="project shipment">Project Shipment</option>
                                                </select>
                                            </td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="file" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>