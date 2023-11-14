<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Mutation</div>
                        <div class="col-md-6 text-right"><a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm">Add New</a></div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Mutation to</th>
                                <th>End Customer</th>
                                <th>Service</th>
                                <th>No. Contract</th>
                                <th style="min-width: 100px;"></th>
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
                                <td>
                                    <a href="<?=site_url('selma/detail_mutation')?>" class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
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
          <h5 class="modal-title" id="exampleModalLabel">Add Mutation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-6">
                          <div class="row">
                              <div class="col-md-12"><h5 style="color: tomato;">Basic Info</h5></div>
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
                                  <input type="text" name="customer" class="form-control">
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-md-5"><label for="">Service</label></div>
                              <div class="col-md-7">
                                  <textarea name="service" class="form-control"></textarea>
                              </div>
                          </div>
                          
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12"><h5 style="color: tomato;">Service Information</h5></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Prev Contract</label></div>
                            <div class="col-md-7">
                                <input type="text" name="prevcon" class="form-control">
                            </div>
                        </div>
                        <br>
                          <div class="row">
                              <div class="col-md-5"><label for="">Service Title</label></div>
                              <div class="col-md-7">
                                  <textarea name="servicetitle" class="form-control"></textarea>
                              </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Period</label></div>
                            <div class="col-md-7">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Start</label></div>
                            <div class="col-md-7">
                                <input type="date" name="start" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">End</label></div>
                            <div class="col-md-7">
                                <input type="date" name="end" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Nominal Contract</label></div>
                            <div class="col-md-7">
                                <input type="text" name="nominalcon" class="form-control">
                            </div>
                        </div>
                      </div>
                  </div>
                  <br>
                  <hr>
                  <br>
                  <div class="row">
                      <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12"><h5 style="color: tomato;">Service Mutation</h5></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Mutation To</label></div>
                            <div class="col-md-7">
                                <select name="mutationto" id="" class="custom-select">
                                    <option value="">dari data master customer</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">New Contract</label></div>
                            <div class="col-md-7">
                                <input type="text" name="newcon" class="form-control">
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
                                <input type="date" name="start2" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">End</label></div>
                            <div class="col-md-7">
                                <input type="date" name="end2" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Nominal Contract</label></div>
                            <div class="col-md-7">
                                <input type="text" name="nomcon" class="form-control">
                            </div>
                        </div>
                      </div>
                  </div>
                  <br>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
              </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>