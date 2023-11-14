<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Presales Activity
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>End Customer</th>
                                <th>Sales</th>
                                <th>Solution</th>
                                <th>Product</th>
                                <th>Activity</th>
                                <th>Manpower</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Telkom</td>
                                <td>Pertamina</td>
                                <td>Ferly Febriani</td>
                                <td>SD-WAN</td>
                                <td>RansNet</td>
                                <td>Prsentation</td>
                                <td>Kurnia Hadi</td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm"><i class="far fa-edit"></i></a>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
              <br>
              <div class="row">
                  <div class="col-md-6">
                      <div class="row">
                          <div class="col-md-5"><label for="">ID</label></div>
                          <div class="col-md-7">
                              <input type="text" name="id" class="form-control" disabled>
                          </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-md-5"><label for="">Customer</label></div>
                        <div class="col-md-7">
                            <input type="text" name="customer" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">End Customer</label></div>
                        <div class="col-md-7">
                            <input type="text" name="encus" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Sales</label></div>
                        <div class="col-md-7">
                            <input type="text" name="sales" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Product</label></div>
                        <div class="col-md-7">
                            <input type="text" name="product" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Manpower</label></div>
                        <div class="col-md-7">
                            <select name="manpower" class="custom-select">
                                <option value="">data dari presales</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Activity</label></div>
                        <div class="col-md-7">
                            <select name="act" id="" class="custom-select">
                                <option value="1">Solution Design</option>
                                <option value="2">POC</option>
                                <option value="3">Evaluasi POC</option>
                                <option value="4">Sizing</option>
                                <option value="5">BOQ</option>
                                <option value="6">LOST</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6"></div>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>