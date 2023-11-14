<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Sales Schedule</div>
                        <div class="col-md-6 text-right"><a href="#" data-toggle="modal" data-target="#new_schedule" class="btn btn-outline-danger btn-sm">Add New Schedule</a></div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Description</th>
                                <th>#</th>
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

<div class="modal fade" id="new_schedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" id="formAddSchedule">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row mt-2">
                    <div class="col-md-4">Add Title</div>
                    <div class="col-md-8"><input type="text" name="title" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Date</div>
                    <div class="col-md-8">
                    <input type="date" name="date" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Location</div>
                    <div class="col-md-8"><input type="text" name="location" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Description</div>
                    <div class="col-md-8"><textarea  name="description" class="form-control"></textarea></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-6">
                  <button type="reset" class="btn btn-danger">Cancel</button>
                </div>
                <div class="col-md-6" >
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editSalesSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:void(0);" id="formEditSchedule">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row mt-2">
                    <div class="col-md-4">Add Title</div>
                    <input type="hidden" name="e_id" class="form-control">
                    <div class="col-md-8"><input type="text" name="e_title" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Date</div>
                    <div class="col-md-8">
                    <input type="date" name="e_date" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Location</div>
                    <div class="col-md-8"><input type="text" name="e_location" class="form-control"></div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-4">Description</div>
                    <div class="col-md-8"><textarea  name="e_description" class="form-control"></textarea></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-md-6">
                  <button type="reset" class="btn btn-danger">Cancel</button>
                </div>
                <div class="col-md-6" >
                  <button type="submit" class="btn btn-success">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
    </div>
</div>  
