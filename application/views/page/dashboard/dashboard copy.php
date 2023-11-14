 <!-- Small boxes (Stat box) -->
 <div class="row">
  
          <!-- ./col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Rekapitulasi Absensi</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>

                    <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="360" style="height: 180px; display: block; width: 476px;" width="952" class="chartjs-render-monitor"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Kehadiran</strong>
                    </p>

                    <div class="progress-group">
                      Izin
                      <span class="float-right"><b><?=$izin['sisa'];?></b>/2</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width:<?=$izin['persen'];?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Cuti
                      <span class="float-right"><b><?=$cuti['sisa'];?></b>/12</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: <?=$cuti['persen'];?>%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Sakit</span>
                      <span class="float-right"><b><?=$sakit['sisa'];?></b>/5</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: <?=$sakit['persen'];?>%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-fingerprint"></i> </span>
                      <h5 class="description-header">MASUK</h5>
                      <span class="description-text"><?=$jam_masuk;?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-fingerprint"></i></span>
                      <h5 class="description-header">KELUAR</h5>
                      <span class="description-text"><?=$jam_keluar;?></span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>


        </div>
        <!-- /.row -->
      
        


        <!-- Main row -->
     
        <!-- /.row (main row) -->
