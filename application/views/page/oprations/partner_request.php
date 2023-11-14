<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Partner Request
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">Request</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Project</th>
                                <th>Service</th>
                                <th>Category</th>
                                <th>Area</th>
                                <th>Location</th>
                                <th>Salary</th>
                                <th>PIC</th>
                                <th>Status</th>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PR001</td>
                                <td>nama project running</td>
                                <td>Change Request</td>
                                <td>Prov 1</td>
                                <td>lokasi 1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
          <h5 class="modal-title" id="exampleModalLabel">New Request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="color: tomato;">Basic Info</h5>
                    </div>                    
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col"><label for="">Service</label></div>
                    <div class="col-md-6 col">
                        <select class="custom-select">
                            <option value="">Project Running 1</option>
                            <option value="">Project Running 2</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col"><label for="">Category</label></div>
                    <div class="col-md-6 col">
                        <select class="custom-select">
                            <option value="IN">Instalasi</option>
                            <option value="MA">Maintenance</option>
                            <option value="CR">Change Request</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col"><label for="">Category</label></div>
                    <div class="col-md-6 col">
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col"><label for="">Area</label></div>
                    <div class="col-md-6 col">
                        <select class="custom-select">
                            <option value="">Prov 1</option>
                            <option value="">Prov 2</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col"><label for="">Location</label></div>
                    <div class="col-md-6 col">
                        <select class="custom-select">
                            <option value="">Lokasi 1</option>
                            <option value="">Lokasi 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Request</button>
              </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>