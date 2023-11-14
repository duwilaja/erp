<style>
    .nav-link{
        color : grey;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Invoice List
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-danger btn-sm">Add new</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>No. Contract</th>
                                <th>Period</th>
                                <th>Bill of</th>
                                <th>Status</th>
                                <th>Desc</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>M001</td>
                                <td>Telkom</td>
                                <td>Pengadaan N3N</td>
                                <td>025/PO/II/2020</td>
                                <td>36 (tgl)</td>
                                <td>Billing-2</td>
                                <td>Process</td>
                                <td>-</td>
                                <td>
                                    <a href="<?=site_url('selma/detail_invoice')?>" class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></a>
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

<!-- Edit Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit M001</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="">
            <div class="containter">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">ID</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="id" class="form-control" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Customer</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="customer" class="form-control" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">End Customer</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="ecustomer" class="form-control" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Service</label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea name="service" disabled class="form-control"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">No. Contract</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nc" class="form-control" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Period</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" name="period" class="form-control" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Until</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" name="until" class="form-control" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Nominal Contract</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="nominal" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-1">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                      <a href="#" id="add" class="btn btn-success btn-sm">Add Billing</a>
                                      <a href="#" id="del" class="btn btn-danger btn-sm"><i class="fas fa-backspace"></i></a>
                                    </div>
                                </div>
                                <br>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" id="nav-bil1">
                                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#billing1" role="tab" aria-controls="home" aria-selected="true">Billing-1</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="billing1" role="tabpanel" aria-labelledby="home-tab">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">No. Invoice</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="noinvoice[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Nominal Invoice</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="nominalinv[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Billing Period</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="pstart[]" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="pend[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Submit Date</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="date" name="sd[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Due Date Payment</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="ddp[]" class="custom-select">
                                                    <option value="7">7</option>
                                                    <option value="14">14</option>
                                                    <option value="30">30</option>
                                                    <option value="45">45</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">status</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="status[]" class="custom-select">
                                                    <option value="process">Process</option>
                                                    <option value="paid">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Description</label>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea name="desc[]" class="form-control">
                                                    
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Invoice</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
              <div class="containter">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="row">
                              <div class="col-md-5">
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="">ID</label>
                                      </div>
                                      <div class="col-md-8">
                                          <input type="text" name="id" class="form-control" disabled>
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="">Customer</label>
                                      </div>
                                      <div class="col-md-8">
                                          <input type="text" name="customer" class="form-control">
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="">End Customer</label>
                                      </div>
                                      <div class="col-md-8">
                                          <input type="text" name="ecustomer" class="form-control">
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="">Service</label>
                                      </div>
                                      <div class="col-md-8">
                                          <textarea name="service" class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="">No. Contract</label>
                                      </div>
                                      <div class="col-md-8">
                                          <input type="text" name="nc" class="form-control">
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="">Period</label>
                                      </div>
                                      <div class="col-md-8">
                                          <input type="date" name="period" class="form-control">
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="">Until</label>
                                      </div>
                                      <div class="col-md-8">
                                          <input type="date" name="until" class="form-control">
                                      </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                      <div class="col-md-4">
                                          <label for="">Nominal Contract</label>
                                      </div>
                                      <div class="col-md-8">
                                          <input type="text" name="nominal" class="form-control">
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 offset-md-1">
                                  <div class="row">
                                      <div class="col-md-12 text-right">
                                        <a href="#" id="add2" class="btn btn-success btn-sm">Add Billing</a>
                                        <a href="#" id="del2" class="btn btn-danger btn-sm"><i class="fas fa-backspace"></i></a>
                                      </div>
                                  </div>
                                  <br>
                                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item" id="addnav-bil1">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#addBilling1" role="tab" aria-controls="home" aria-selected="true">Billing-1</a>
                                      </li>
                                  </ul>
                                  <div class="tab-content" id="myTabContent">
                                      <div class="tab-pane fade show active" id="addBilling1" role="tabpanel" aria-labelledby="home-tab">
                                          <br>
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <label for="">No. Invoice</label>
                                              </div>
                                              <div class="col-md-8">
                                                  <input type="text" name="noinvoice[]" class="form-control">
                                              </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <label for="">Nominal Invoice</label>
                                              </div>
                                              <div class="col-md-8">
                                                  <input type="text" name="nominalinv[]" class="form-control">
                                              </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <label for="">Billing Period</label>
                                              </div>
                                              <div class="col-md-4">
                                                  <input type="date" name="pstart[]" class="form-control">
                                              </div>
                                              <div class="col-md-4">
                                                  <input type="date" name="pend[]" class="form-control">
                                              </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <label for="">Submit Date</label>
                                              </div>
                                              <div class="col-md-8">
                                                  <input type="date" name="sd[]" class="form-control">
                                              </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <label for="">Due Date Payment</label>
                                              </div>
                                              <div class="col-md-8">
                                                  <select name="ddp[]" class="custom-select">
                                                      <option value="7">7</option>
                                                      <option value="14">14</option>
                                                      <option value="30">30</option>
                                                      <option value="45">45</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <label for="">status</label>
                                              </div>
                                              <div class="col-md-8">
                                                  <select name="status[]" class="custom-select">
                                                      <option value="process">Process</option>
                                                      <option value="paid">Paid</option>
                                                  </select>
                                              </div>
                                          </div>
                                          <br>
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <label for="">Description</label>
                                              </div>
                                              <div class="col-md-8">
                                                  <textarea name="desc[]" class="form-control">
                                                      
                                                  </textarea>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                              </div>
                          </div>
                      </div>
                  </div>
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

<script>
var x = 1;
var y = 1;
document.getElementById('add').addEventListener('click', function(){
    if(x < 10){ //max input box allowed
        // $('#nav-bil'+x).after('<li class="nav-item" id="nav-bil'+(x+1)+'"><a class="nav-link" id="home-tab" data-toggle="tab" href="#billing'+(x+1)+'" role="tab" aria-controls="home" aria-selected="true">Billing-'+(x+1)+'</a></li>');
        $('#nav-bil'+x).after(`<li class="nav-item" id="nav-bil${(x+1)}">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#billing${x+1}" role="tab" aria-controls="home" aria-selected="true">Billing-${x+1}</a>
         </li>`);
        $('#billing'+x).after(`<div class="tab-pane fade show" id="billing${x+1}" role="tabpanel" aria-labelledby="home-tab">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">No. Invoice</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="noinvoice[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Nominal Invoice</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="nominalinv[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Billing Period</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="pstart[]" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="pend[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Submit Date</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="date" name="sd[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Due Date Payment</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="ddp[]" class="custom-select">
                                                    <option value="7">7</option>
                                                    <option value="14">14</option>
                                                    <option value="30">30</option>
                                                    <option value="45">45</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">status</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="status[]" class="custom-select">
                                                    <option value="process">Process</option>
                                                    <option value="paid">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Description</label>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea name="desc[]" class="form-control">
                                                    
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>`);
        x++; 
        return "success";
    }
});

document.getElementById('del').addEventListener('click', function(){
    if(x > 1){
        $('#nav-bil'+x).remove();
        $('#billing'+x).remove();
        x--;
    }
    
});

document.getElementById('add2').addEventListener('click', function(){
    if(y < 10){ //max input box allowed
        // $('#nav-bil'+x).after('<li class="nav-item" id="nav-bil'+(x+1)+'"><a class="nav-link" id="home-tab" data-toggle="tab" href="#billing'+(x+1)+'" role="tab" aria-controls="home" aria-selected="true">Billing-'+(x+1)+'</a></li>');
        $('#addnav-bil'+y).after(`<li class="nav-item" id="addnav-bil${(y+1)}">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#addBilling${y+1}" role="tab" aria-controls="home" aria-selected="true">Billing-${y+1}</a>
         </li>`);
        $('#addBilling'+y).after(`<div class="tab-pane fade show" id="addBilling${y+1}" role="tabpanel" aria-labelledby="home-tab">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">No. Invoice</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="noinvoice[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Nominal Invoice</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="nominalinv[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Billing Period</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="pstart[]" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="date" name="pend[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Submit Date</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="date" name="sd[]" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Due Date Payment</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="ddp[]" class="custom-select">
                                                    <option value="7">7</option>
                                                    <option value="14">14</option>
                                                    <option value="30">30</option>
                                                    <option value="45">45</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">status</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="status[]" class="custom-select">
                                                    <option value="process">Process</option>
                                                    <option value="paid">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="">Description</label>
                                            </div>
                                            <div class="col-md-8">
                                                <textarea name="desc[]" class="form-control">
                                                    
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>`);
        y++; 
        return "success";
    }
});

document.getElementById('del2').addEventListener('click', function(){
    if(y > 1){
        $('#addnav-bil'+y).remove();
        $('#addBilling'+y).remove();
        y--;
    }
    
});

</script>