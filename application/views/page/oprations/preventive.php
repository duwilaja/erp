<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/pdfmake.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.js"></script>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <br>
                    <div class="row">
                        <div class="col-md-12 col text-center">
                            <h4>Preventive Maintenance</h4> 
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="">
                                <div class="row">
                                    
                                    <div class="col-md-4">
                                        <!-- <label for="">Import Data</label>
                                        <input type="file" name="file"> -->
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col text-right">
                            <br>
                            <a href='<?=site_url('oprations/add_preventive');?>' class='btn btn-outline-danger btn-sm'><i class='fas fa-plus'></i> Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customers</th>
                                <th>Lokasi</th>
                                <th>Teknisi</th>
                                <th>Tanggal</th>
                                <th>Problem</th>
                                <th>Desc</th>
                                <th>Hasil</th>
                                <th>Status</th>
                                <th></th>
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

<!-- Modal -->
<div class="modal fade" id="modelEditPm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javacsript:void(0)" method="POST" id="form-up">
            <div class="row">
                <div class="col-md-5">
                    <input type="hidden" id="e_id">
                    <label for="status">Status</label>
                </div>
                <div class="col-md-7">
                    <select name="status" id="e_status" class="custom-select">
                        <option value="1">On Schelude</option>
                        <option value="2">Done</option>
                        <option value="3">Close</option>
                        <option value="4">Reschedule</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <label for="">Date</label>
                </div>
                <div class="col-md-7">
                    <input type="date"  name="date" id="e_date" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <label for="">Description</label>
                  </div>
                  <div class="col-md-7">
                    <textarea name="desc" id="e_desc" class="form-control"></textarea>
                    <!-- <input type="text" class="form-control" onchange="updatePreventive()" id="hasil"> -->
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-5">
                    <label for="">Result</label>
                    
                  </div>
                  <div class="col-md-7">
                    <textarea name="result" id="e_result" class="form-control"></textarea>
                    <!-- <input type="text" class="form-control" onchange="updatePreventive()" id="hasil"> -->
                </div>
            </div>
            <br>
              
            <div class="modal-footer">
                <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>