<style>
  .profile{
    padding-top: 50px;
    padding-bottom: 20px;
  }
  
  .profile h5{
    margin-top: 20px;
  }
  
  .profile p{
    color : #999999;
  }
  
  
  .pp{
    width: 100px;
    height: 100px;
    background-image: url('<?=base_url('./data/foto_profile/'.@$karyawan->foto)?>');
    background-position: center;
    background-size: cover;
    border-radius: 50%;
    margin-left: auto;
    margin-right: auto;
  }
  
  .lab{
    padding-top: 30px;
    padding-bottom: 30px;
  }
  
  
  .mycard{
    background-color: white;
    margin-bottom: 20px;
    -webkit-box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
    -moz-box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
    box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
  }
  
  
  .pt{
    color : #999999;
  }

  @media (max-width: 1024px) {
  
  .tes{
    height: 200px;
  }
  
}
  
  
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<section class="content">
  <?php
  $this->load->view('page/dashboard/dashboard_teknisi');
  $this->load->view('page/dashboard/dashboard_hcm');
  $this->load->view('page/dashboard/dashboard_sales');
  $this->load->view('page/dashboard/dashboard_serdev');
  $this->load->view('page/dashboard/dashboard_pm');
  ?>
  <!-- All User Dashboard -->
  
  <div class="row">
    
    <div class="col-md-8">
      <!-- <div class="row">
        <div class="col-md-12">
          <div class="mycard rounded">
            <div class="card-body text-center">
              <div class="row">
                <div class="col-md-12 text-center" style="margin-bottom: 20px;">
                  <p style="color: #999999;">Today Attendance</p s>
                  </div>
                </div>
                <div class="row">
                  
                  <div class="col-md-6 col" style="color: #3282b8;">
                    <i class="fas fa-sign-in-alt"></i><br>
                    Masuk <?=$jam_masuk;?>
                  </div>
                  
                  <div class="col-md-6 col" style="border-left: 1px solid  #f2f2f2; color: #fd5e53;">
                    <i class="fas fa-sign-in-alt"></i><br>
                    Keluar <?=$jam_keluar;?>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div> -->
        
        
        <div class="row">
          <div class="col-md-12"> 
            <div class="mycard rounded">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 col">
                    <p style="color:#999999; ;">Data Kehadiran Perminggu</p>
                  </div>
                  <div class="col-md-2 text-right col">
                    <select onchange="dataAbsenJson(this.value)" id="thn" class="custom-select">
                      <option value="2020" <?= date('y') == '2020' ? 'selected' : ''; ?> >2020</option>
                      <option value="2021" <?= date('y') == '2021' ? 'selected' : ''; ?> >2021</option>
                      <option value="2022" <?= date('y') == '2022' ? 'selected' : ''; ?> >2022</option>
                      <option value="2023" <?= date('y') == '2023' ? 'selected' : ''; ?> >2023</option>
                      <option value="2024" <?= date('y') == '2024' ? 'selected' : ''; ?> >2024</option>
                      <option value="2025" <?= date('y') == '2025' ? 'selected' : ''; ?> >2025</option>
                    </select>
                  </div>
                  <div class="col-md-4 text-right col">
                    <select onchange="dataAbsenJson(this.value)" id="tgl" class="custom-select">
                      <option value="01" <?= date('m') == '01' ? 'selected' : ''; ?> >Januari</option>
                      <option value="02" <?= date('m') == '02' ? 'selected' : ''; ?> >Februari</option>
                      <option value="03" <?= date('m') == '03' ? 'selected' : ''; ?> >Maret</option>
                      <option value="04" <?= date('m') == '04' ? 'selected' : ''; ?> >April</option>
                      <option value="05" <?= date('m') == '05' ? 'selected' : ''; ?> >Mei</option>
                      <option value="06" <?= date('m') == '06' ? 'selected' : ''; ?> >Juni</option>
                      <option value="07" <?= date('m') == '07' ? 'selected' : ''; ?> >Juli</option>
                      <option value="08" <?= date('m') == '08' ? 'selected' : ''; ?> >Agustus</option>
                      <option value="09" <?= date('m') == '09' ? 'selected' : ''; ?> >September</option>
                      <option value="10" <?= date('m') == '10' ? 'selected' : ''; ?> >Oktober</option>
                      <option value="11" <?= date('m') == '11' ? 'selected' : ''; ?> >November</option>
                      <option value="12" <?= date('m') == '12' ? 'selected' : ''; ?> >Desember</option>
                    </select>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-12 text-center" style="padding-top: 35px; padding-bottom: 35px;">
                    <canvas id="myChart">10 </canvas>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="mycard rounded">
              <div class="card-body">
                <div class="container">
                  <div class="row">
                    <div class="col-md-12 text-center profile">
                      <div class="pp"></div>
                      <h5><strong><?=@$karyawan->nama;?></strong></h5>
                      <p><?=@$karyawan->nma_jabatan;?></p>
                      
                      <a href="<?=site_url('karyawan/profile/'.$this->session->userdata('karyawan_id'))?>" class="btn btn-danger">Lihat Profile</a>
                      <a href="<?=site_url('karyawan/edit_profile/'.$this->session->userdata('karyawan_id'))?>">
                        <button class="btn btn-success" max-width: 200px;">
                          <i class="fas fa-user-edit"></i>
                        </button>
                      </a>
                    </div>
                  </div>
                  
                  <br>
                  <div class="row" style="margin-top: 50px;">
                    <div class="col-md-6 col text-center">
                      <h5><?=$cuti;?></h5>
                      <p style="color: #999999;">Cuti</p>
                    </div>
                    
                    <div class="col-md-6 col text-center">
                      <h5><?=$sakit;?></h5>
                      <p style="color: #999999;">Sakit</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="row">
          <div class="col-md-12">
            <div class="mycard rounded">
              <div class="card-body text-center">
                <div class="row">
                  <div class="col-md-12 text-center" style="margin-bottom: 20px;">
                    <p style="color: #999999;">Today Attendance</p s>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-md-6 col" style="color: #3282b8;">
                      <i class="fas fa-sign-in-alt"></i><br>
                      Masuk <?=$jam_masuk;?>
                    </div>
                    
                    <div class="col-md-6 col" style="border-left: 1px solid  #f2f2f2; color: #fd5e53;">
                      <i class="fas fa-sign-in-alt"></i><br>
                      Keluar <?=$jam_keluar;?>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
        </div> -->
        
        
      </div>
    </div>
  </section>
  
  
  <script>
    
  
    // var myChart = new Chart(ctx, {
      //   type: 'pie',
      //   data: {
        //     labels: ['Tepat Waktu', 'Telat'],
        //     datasets: [{
          //       label: '# of Tomatoes',
          //       data: [<?=$jml_tepat?>, <?=$jml_telat;?>],
          //       backgroundColor: [
          //       'rgba(50, 130, 184, 1)',
          //       'rgba(253, 94, 83, 1)',
          //       ],
          //     }]
          //   },
          //   options: {
            //     cutoutPercentage: 40,
            //     responsive: true,
            
            //     title: {
              //       display: false
              //     },
              
              //     legend: {
                //       display: false,
                
                //     }
                
                //   }
                // });
                
                let curr = new Date 
                let week = []
                
                for (let i = 1; i <= 7; i++) {
                  let first = curr.getDate() - curr.getDay() + i 
                  let day = new Date(curr.setDate(first)).toISOString().slice(0, 10)
                  week.push(day)
                }

                console.log(week);
              </script>