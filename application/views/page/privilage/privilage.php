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
        <div class="card-header">
          <div class="row">
            <div class="col-md-6 col">
              List Privilage 
            </div>
            <div class="col-md-6 text-right">
              <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalx">Add</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="tabel" class="table"> 
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th style="width: 100px;"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Fariz</td>
                  <td>Operation Manager</td>
                  <td >
                    <a href="" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-info-circle"></i></a>
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


<!-- Modal -->
<div class="modal fade" id="exampleModalx" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Privilage</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addFormPrivilage" action="javascript:void(0);" method="post">
      <div class="modal-body">
        <div class="row">
           <div class="col-md-6">
          
                <div class="row">
                  <div class="col-md-4"><label for="">Karyawan</label></div>
                    <div class="col-md-7">
                      <select name="karyawan" id="karyawan" onchange="getInfo(this.value)" class="custom-select">
                        <option value="telkom">Name 1</option>
                        <option value="lintasarta">Name 2</option>
                        <option value="pins">Name 3</option>
                      </select>
                  </div>
                </div>
                <br>

                <!-- <div class="row">
                  <div class="col-md-4"><label for="">Position</label></div>
                    <div class="col-md-7">
                      <select name="poisis" id="" class="custom-select">
                        <option value="telkom">P 1</option>
                        <option value="lintasarta">P 2</option>
                        <option value="pins">P 3</option>
                      </select>
                  </div>
                </div> -->

            </div>
        </div>  
        
        <hr size="10px">
        <br>

      
        <div class="row" id="tform">
           <div class="col-md-6">
                <div class="row">
                  <div class="col-md-4"><label for="">Menu</label></div>
                    <div class="col-md-7">
                      <select name="menu" onchange="getSubmenu(this.value)" id="menu" class="custom-select">
                      </select>
                  </div>
                </div>
                <br>

           </div>

           <div class="col-md-6">
                <div class="row">
                  <div class="col-md-4"><label for="">Sub Menu</label></div>
                    <div class="col-md-7">
                      <select name="submenu" id="submenu" onchange="fitur(this.value)" data-val="" class="custom-select">
                      </select>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-md-4"><label for=""></label></div> 
                    <div class="col-md-7">
                        <div class="row mb-4" id="tfitur">

                        </div>
                    </div>
                </div>
           </div>
        </div>

        
        <!-- <div class="row">
           <div class="col-md-6">
                <div class="row">
                  <div class="col-md-4"><label for=""></label></div>
                    <div class="col-md-7">
                      <a href="#" class="btn btn-danger btn-sm" onclick="addPriv()"><i class="fas fa-plus-circle"></i>&nbsp; Add Menu</a>
                    </div>
                </div>
           </div>
        </div> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Privilage</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="">
          <div class="container">

               <div class="row">
                  <div class="col-md-4 col">Name</div>
                    <div class="col-md-6 col">
                      <label for="" id="lnama">-</label>
                    </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-4 col">Position</div>
                    <div class="col-md-6 col">
                      <label for="" id="ljabatan">-</label>
                    </div>
                  </div>
               </div>

                <table class="table" >
                            <thead>
                                <th>Menu</th>
                                <th>C</th>
                                <th>R</th>
                                <th>U</th>
                                <th>D</th>
                                <th>H</th>
                            </thead>
                            <tbody id="detailTabel">
                                <tr>
                                    <td><label for="">Ticketing</label></td>
                                </tr>
                                <tr>
                                    <td>All Ticket</td>
                                    <td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>
                                    <td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>
                                    <td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>
                                    <td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>
                                    <td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>
                                </tr>
                                <tr>
                                    <td>My Ticket</td>
                                    <td></td>
                                    <td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>
                                    <td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>
                                    <td></td>
                                    <td><i class="fas fa-check-circle" style="color:#9ACD32"></i></td>
                                </tr>
                            
                            </tbody>
                    </table>
                 </div>
           </form>
      </div>
    </div>
  </div>
</div>
