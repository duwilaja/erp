<input type="hidden" name="edit" id="edit" value="<?=$this->input->get('edit')?>">
<input type="hidden" name="cust" id="cust" value="<?=$this->input->get('cust')?>">
<input type="hidden" name="device_id" id="device_id" value="<?=$this->input->get('device_id')?>">

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">Replace</div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-outline-danger btn-sm">New Replace</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tabel">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Location</th>
                                    <th>Device</th>
                                    <th>Old SN</th>
                                    <th>New SN</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Replace</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="javascript:void(0);" id="form_replace_device">
              <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5"><label for="">Date Replace</label></div>
                        <div class="col-md-7">
                            <input type="date" name="date_replace" class="form-control" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Customer</label></div>
                        <div class="col-md-7">
                            <select name="custend" id="custend" class="custom-select" style="width:100%;" onchange="cek_device_by_cust(this.value)" required>
                            </select>
                        </div>
                    </div>                    
                    <br>
                  </div>
                  <div class="col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Old Device/SN</label></div>
                        <div class="col-md-7">
                            <select name="device_old" id="device_old" class="custom-select" style="width:100%;" required>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">New Device/SN to Replace</label></div>
                        <div class="col-md-7">
                            <select name="device_new" id="device_new" class="custom-select" style="width:100%;" required>
                            </select>
                        </div>
                    </div>
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


  <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Replace</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
              <div class="row">
                  <div class="col-md-6">
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Customer</label></div>
                        <div class="col-md-7">
                            <select name="ecustomer" id="" class="custom-select">
                                <option value="telkom">Telkom</option>
                                <option value="lintasarta">Lintasarta</option>
                                <option value="pins">Pins</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">End Customer</label></div>
                        <div class="col-md-7">
                            <select name="encustomer" id="" class="custom-select">
                                <option value="korlantas">Korlantas</option>
                                <option value="pegadaian">Pegadaian</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Location</label></div>
                        <div class="col-md-7">
                            <select name="elocation" id="" class="custom-select">
                                <option value="polda jabar">Polda Jabar</option>
                                <option value="polda jateng">Polda Jateng</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Date</label></div>
                        <div class="col-md-7">
                            <input type="edate" name="date" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Series</label></div>
                        <div class="col-md-7">
                            <select name="eseries" id="" class="custom-select">
                                <option value="HSG">HSG</option>
                                <option value="HSA">HSA</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Type</label></div>
                        <div class="col-md-7">
                            <select name="etype" id="" class="custom-select">
                                <option value="HSG-100">HSG-100</option>
                                <option value="HSG-200">HSG-200</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Old SN</label></div>
                        <div class="col-md-7">
                            <input type="text" name="eoldsn" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Old MAC</label></div>
                        <div class="col-md-7">
                            <input type="text" name="eoldmac" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">New SN</label></div>
                        <div class="col-md-7">
                            <input type="text" name="enewsn" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">New MAC</label></div>
                        <div class="col-md-7">
                            <input type="text" name="enewmac" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Status</label></div>
                        <div class="col-md-7">
                            <select name="estatus" id="" class="custom-select">
                                <option value="progress">ON Proggress</option>
                                <option value="HSG-200">Done</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><label for="">Attachment</label></div>
                        <div class="col-md-7">
                            <input type="file" name="eattach" class="form-control">
                        </div>
                    </div>
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