<style>
  .mycard{
    background-color: white;
    margin-bottom: 20px;
    -webkit-box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
    -moz-box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
    box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
  }

  .cg{
    color: tomato;
  }
</style>


<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card mycard">
        
        <div class="card-body" style="min-height: 200px;">
          <div class="row">
            <div class="col-md-12 text-center" style="padding-top: 20px;">
              <h5 class="display-4">
                <i class="fas fa-user-lock"></i>
              </h5>
            </div>
            <div class="col-md-6 offset-md-3" style="padding-top: 50px; padding-bottom: 50px;">
              <form id="form-add" action="javascript:void(0);" method="POST">
                  <div class="row">
                    <div class="col-6">
                      <label for="" class="cg">Jabatan</label>
                      <select name="jabatan_id" id="jabatan" class="custom-select jb"></select>
                    </div>
                    <div class="col-5">
                      <label for="" class="cg">Menu</label>
                      <input type="text" id="menu" name="menu" class="form-control">
                      <input type="hidden" id="id" name="id" class="form-control">
                    </div>
                    <div class="col-1">
                      <label for="" style="color: white;">-</label>
                      <button type="submit" class="btn btn-outline-danger">Submit</button>
                    </div>
                  </div>
              </form>


              
              <form id="form-edit" action="javascript:void(0);" method="POST" style="display: none;">
                <div class="row">
                  <div class="col-6">
                    <label for="" class="cg">Jabatan</label>
                    <select name="jabatan_id" id="ejabatan" class="custom-select"></select>
                  </div>
                  <div class="col-5">
                    <label for="" class="cg">Menu</label>
                    <input type="text" id="emenu" name="menu" class="form-control">
                    <input type="hidden" id="eid" name="id" class="form-control">
                  </div>
                  <div class="col-1">
                    <label for="" style="color: white;">-</label>
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                    
                    <Button id="cancel" type="button" style="margin-top: 20px;" class="btn btn-danger">Cancel</Button>
                  </div>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="card mycard">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 col">
              List Privilage 
            </div>
            
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="tblTicSubject" class="table table-bordered"> 
              <thead>
                <tr>
                  <th>No</th>
                  <th>Menu</th>
                  <th>Jabatan</th>
                  <th style="width: 100px;"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Operation</td>
                  <td>Ticket</td>
                  <td >
                    <a href="" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                    <a href="" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>

