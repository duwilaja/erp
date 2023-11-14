<!-- Menu Level 3 / HCM--> 
<?php if ($this->session->userdata('level') == '3') { ?>
  <div class="row">
    <div class="col-md-3 col-6">
      <div class="mycard rounded">
        <div class="card-body text-center">
          <br>
          <a href="<?=site_url('hcm/list_izin_cuti')?>">
            <h4 style="color: tomato;"><i class="far fa-file"></i> <strong> 20</strong></h4>
            <p class="pt">Submission Request</p>
          </a>
        </div>
      </div>
    </div>
    
    <div class="col-md-3 col-6">
      <div class="mycard rounded">
        <div class="card-body text-center">
          <br>
          <a href="<?=site_url('hcm/list_izin_cuti')?>">
            <h4 style="color: #916dd5"><i class="fas fa-file-signature"></i><strong> 12</strong></h4>
            <p class="pt">Submission Request</p>
          </a>
        </div>
      </div>
    </div>
    
    <div class="col-md-3 col-6">
      <div class="mycard rounded">
        <div class="card-body text-center">
          <br>
          <a href="<?=site_url('hcm/list_izin_cuti')?>">
            <h4 style="color: #2c7873"><i class="fas fa-graduation-cap"></i> <strong> 4</strong></h4>
            <p class="pt">Training Request</p>
          </a>         
        </div>
      </div>
    </div>
    
    <div class="col-md-3 col-6" data-toggle="modal" data-target="#exampleModal">
      <div class="mycard rounded">
        <div class="card-body text-center">
          <br>
          <h4 style="color: #5f6caf"><i class="nav-icon fas fa-user-tie"></i> <strong> 33</strong></h4>
          <p class="pt">New Applicants</p>
          
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Applicants</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Lowongan</th>
                    <th>Tanggal</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Sahrul Rizal</td>
                    <td>Quality Assurance</td>
                    <td>22 Januari 2020</td>
                    <td>
                      <a href="" class="btn btn-dark btn-sm"><i class="fas fa-eye"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <hr>
          <br>
          <div class="row">
            <div class="col-md-12 text-center">
              <a href="" style="color: tomato;">View More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php }?>