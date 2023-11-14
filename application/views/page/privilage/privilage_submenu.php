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
    <div class="col-md-4">
      <div class="card mycard">
        
        <div class="card-body" style="min-height: 200px;">
          <div class="row">
            <div class="col-md-12 text-center" style="padding-top: 20px;">
              <h5 class="display-4">
                <i class="fas fa-user-lock"></i>
              </h5>
            </div>
            <div class="col-md-12" style="padding-top: 50px;">
              <form action="post" action="javascript:void(0);" id="form-add">
                <div class="row">
                  <div class="col-6">
                    <label for="" class="cg">Jabatan</label>
                    <br>
                    <select name="jabata" onchange="getByMenu(this.value)" id="jabatan" class="custom-select jb">
                      
                    </select>
                  </div>
                  <div class="col-6">
                    <label for="" class="cg">Menu</label>
                    <br>
                    <select name="menu_id" id="menu" class="custom-select jb">
                      
                    </select>
                  </div>
                  
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <label for="" class="cg">Sub Menu</label>
                    <input type="text" class="form-control" name="submenu" id="submenu">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fitur" id="crud" value="c,r,u,d" checked>
                      <label class="form-check-label" for="inlineRadio1">CRUD</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fitur" id="crudh" value="c,r,u,d,h">
                      <label class="form-check-label" for="inlineRadio2">CRUDH</label>
                    </div>
                  </div>
                  <div class="col-4 text-right">
                    <label for="" style="color: white;">-</label>
                    <button type="submit" class="btn btn-outline-danger btn-sm">Submit</button>
                  </div>
                </div>
              </form>
              
              <!-- edit form -->
              <form action="javascript:void(0);" id="form-edit" method="POST" style="display: none;">
                <div class="row">
                  <div class="col">
                    <input type="hidden" name="id" id="eid">
                    <label for="" class="cg">Jabatan</label>
                    <br>
                    <select name="jabatan" onchange="egetByMenu(this.value)" id="ejabatan" class="custom-select">
                      
                    </select>
                  </div>
                  <div class="col">
                    <label for="" class="cg">Menu</label>
                    <br>
                    <select name="menu_id" id="emenu" class="custom-select"></select>
                  </div>
                  
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12">
                    <label for="" class="cg">Sub Menu</label>
                    <input type="text" id="esubmenu" name="submenu" class="form-control">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fitur" id="ecrud" value="c,r,u,d" checked>
                      <label class="form-check-label" for="inlineRadio1">CRUD</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fitur" id="ecrudh" value="c,r,u,d,h">
                      <label class="form-check-label" for="inlineRadio2">CRUDH</label>
                    </div>
                  </div>
                  <div class="col-5 text-right">
                    <label for="" style="color: white;">-</label>
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                    <button type="reset" id="cancel" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></button>

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
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
                  <th>Jabatan</th>
                  <th>Menu</th>
                  <th>Sub Menu</th>
                  <th style="width: 100px;"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Operation</td>
                  <td>Ticket</td>
                  <td>Report Ticket</td>
                  <td>
                    <a href="" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                    <a href="#" onclick="confirm('Are you sure ?')" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
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

<script>
  
</script>
