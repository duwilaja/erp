<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Dismantle</div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>1</th>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>End Customer</th>
                                <th>Service</th>
                                <th>No. Contract</th>
                                <th>Dismantle Date</th>
                                <th>No</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>M001</td>
                                <td>Telkom</td>
                                <td>Pertamina</td>
                                <td>Pengadaan N3N</td>
                                <td>025/PO/II/2020</td>
                                <td></td>
                                <td></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="">
              <br>
              <div class="row">
                  <div class="col-md-12"><h5 style="color: tomato;">Dismantle</h5></div>
              </div>
              <br>
              <div class="row">
                  <div class="col-md-5"><label for="">ID</label></div>
                  <div class="col-md-7">
                      <input type="text" name="id" class="form-control">
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
                    <input type="text" name="endcustomer" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5"><label for="">No. Contract</label></div>
                <div class="col-md-7">
                    <input type="text" name="nocon" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5"><label for="">Service</label></div>
                <div class="col-md-7">
                    <textarea name="service" class="form-control"></textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5"><label for="">Period</label></div>
                <div class="col-md-7">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5"><label for="">Start</label></div>
                <div class="col-md-7">
                    <input type="date" name="start" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5"><label for="">End</label></div>
                <div class="col-md-7">
                    <input type="date" name="end" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5"><label for="">Dismantle Date</label></div>
                <div class="col-md-7">
                    <input type="date" name="disdate" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5"><label for="">Note</label></div>
                <div class="col-md-7">
                    <textarea name="note" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
          </form>
      </div>
      
    </div>
  </div>
</div>