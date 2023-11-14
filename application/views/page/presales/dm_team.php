<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Data Master Team</div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-danger btn-sm">Add Team</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sahrul Rizal</td>
                                <td>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fas fa-user-minus"></i></a>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Team</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
              <div class="row">
                  <div class="col-md-5"><label for="">Name</label></div>
                  <div class="col-md-7">
                      <select name="nama" class="custom-select">
                          <option value="">Sahrul Rizal</option>
                      </select>
                  </div>
              </div>
              <br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>