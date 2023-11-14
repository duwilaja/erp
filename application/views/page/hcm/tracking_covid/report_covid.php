<style>
    .actv{
        background: #20c997;
        padding: 5px;
        font-size: 14px;
        border-radius: 4px;
        color: #FFF;
    }
    
    .non-actv{
        background: #d81b60;
        padding: 5px;
        font-size: 14px;
        border-radius: 4px;
        color: #FFF;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 col-sm">
                        <select onchange="totalCovid(this.value); dataGraphCov(this.value)" id="thn" class="custom-select">
                            <option value="2020" <?= date('Y') == '2020' ? 'selected' : ''; ?> >2020</option>
                            <option value="2021" <?= date('Y') == '2021' ? 'selected' : ''; ?> >2021</option>
                            <option value="2022" <?= date('Y') == '2022' ? 'selected' : ''; ?> >2022</option>
                            <option value="2023" <?= date('Y') == '2023' ? 'selected' : ''; ?> >2023</option>
                            <option value="2024" <?= date('Y') == '2024' ? 'selected' : ''; ?> >2024</option>
                            <option value="2025" <?= date('Y') == '2025' ? 'selected' : ''; ?> >2025</option>
                        </select>
                        </div>
                        <div class="col-md-3 col-sm">
                        <select onchange="totalCovid(this.value); dataGraphCov(this.value)" id="bln" class="custom-select">
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
                        <div class="col-md-1 col-sm">
                            <select onchange="totalCovid(this.value); dataGraphCov(this.value)" id="tgl" class="custom-select">
                                <option value="0" >-</option>
                                <option value="01" <?= date('d') == '01' ? 'selected' : ''; ?> >01</option>
                                <option value="02" <?= date('d') == '02' ? 'selected' : ''; ?> >02</option>
                                <option value="03" <?= date('d') == '03' ? 'selected' : ''; ?> >03</option>
                                <option value="04" <?= date('d') == '04' ? 'selected' : ''; ?> >04</option>
                                <option value="05" <?= date('d') == '05' ? 'selected' : ''; ?> >05</option>
                                <option value="06" <?= date('d') == '06' ? 'selected' : ''; ?> >06</option>
                                <option value="07" <?= date('d') == '07' ? 'selected' : ''; ?> >07</option>
                                <option value="08" <?= date('d') == '08' ? 'selected' : ''; ?> >08</option>
                                <option value="09" <?= date('d') == '09' ? 'selected' : ''; ?> >09</option>
                                <option value="10" <?= date('d') == '10' ? 'selected' : ''; ?> >10</option>
                                <option value="11" <?= date('d') == '11' ? 'selected' : ''; ?> >11</option>
                                <option value="12" <?= date('d') == '12' ? 'selected' : ''; ?> >12</option>
                                <option value="13" <?= date('d') == '13' ? 'selected' : ''; ?> >13</option>
                                <option value="14" <?= date('d') == '14' ? 'selected' : ''; ?> >14</option>
                                <option value="15" <?= date('d') == '15' ? 'selected' : ''; ?> >15</option>
                                <option value="16" <?= date('d') == '16' ? 'selected' : ''; ?> >16</option>
                                <option value="17" <?= date('d') == '17' ? 'selected' : ''; ?> >17</option>
                                <option value="18" <?= date('d') == '18' ? 'selected' : ''; ?> >18</option>
                                <option value="19" <?= date('d') == '19' ? 'selected' : ''; ?> >19</option>
                                <option value="20" <?= date('d') == '20' ? 'selected' : ''; ?> >20</option>
                                <option value="21" <?= date('d') == '21' ? 'selected' : ''; ?> >21</option>
                                <option value="22" <?= date('d') == '22' ? 'selected' : ''; ?> >22</option>
                                <option value="23" <?= date('d') == '23' ? 'selected' : ''; ?> >23</option>
                                <option value="24" <?= date('d') == '24' ? 'selected' : ''; ?> >24</option>
                                <option value="25" <?= date('d') == '25' ? 'selected' : ''; ?> >25</option>
                                <option value="26" <?= date('d') == '26' ? 'selected' : ''; ?> >26</option>
                                <option value="27" <?= date('d') == '27' ? 'selected' : ''; ?> >27</option>
                                <option value="28" <?= date('d') == '28' ? 'selected' : ''; ?> >28</option>
                                <option value="29" <?= date('d') == '29' ? 'selected' : ''; ?> >29</option>
                                <option value="30" <?= date('d') == '30' ? 'selected' : ''; ?> >30</option>
                                <option value="31" <?= date('d') == '31' ? 'selected' : ''; ?> >31</option>
                                
                            </select>
                        </div>
                        <div class="col-md-3 col-sm">
                            <select name="" onchange="totalCovid(this.value); dataGraphCov(this.value);" id="direktorat" class="form-control">
                                <option value="">All Direktorat</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="info-box">
                <div class="info-box-content">
                    <span class="info-box-text font-weight-bolder text-gray">Total Positif</span>
                    <span class="info-box-number h1" id="total_covid"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="info-box border border-danger">
                <div class="info-box-content">
                    <span class="info-box-text font-weight-bolder text-danger">Positif Saat Ini</span>
                    <span class="info-box-number h1 text-danger" id="total_positif"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="info-box">
                <div class="info-box-content">
                    <span class="info-box-text font-weight-bolder text-gray">Total Negatif</span>
                    <span class="info-box-number h1" id="total_negatif"></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <div class="info-box">
                <div class="info-box-content">
                    <span class="info-box-text font-weight-bolder text-gray">Total Karyawan</span>
                    <span class="info-box-number h1" id="total_karyawan"></span>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <div class="col-12">
            <div class="card rounded">
                    <div class="row">
                        <div class="col-md-8">
                        <h4 class="pt-3 pl-3">Tracking Covid</h4>
                        <br>
                        <canvas id="myChart" class='pl-3'></canvas>
                        </div>
                        <div class="col-md-4">
                            <div class="border-left border-bottom text-center">
                                <p class="text-gray pt-3">Total Positif Tahun Ini</p>
                                <p class="h4 font-weight-bold" id='total_year'></p>
                            </div>
                            <div class="border-left border-bottom text-center">
                                <p class="text-gray pt-3">Total Positif Bulan Ini</p>
                                <p class="h4 font-weight-bold" id="total_month"></p>
                            </div>
                            <div class="border-left border-bottom text-center">
                                <p class="text-gray pt-3">Total Negatif Bulan Ini</p>
                                <p class="h4 font-weight-bold" id="total_monthNe"></p>
                            </div>
                            <div class="border-left border-bottom text-center">
                                <p class="text-gray pt-3">Tidak Terpapar</p>
                                <p class="h4 font-weight-bold" id="tidak_terpapar"></p>
                            </div>
                            <div class="border-left border-bottom text-center">
                                <p class="text-gray pt-3">Divisi Positif Terbanyak</p>
                                <p class="h4 font-weight-bold" id="divisi_terbanyak"></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold mt-2">List Tracking <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="<?=site_url('hcm/tracking_covid')?>" class="btn btn-primary">View All</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <div class="table-responsive">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Mulai Bergejala</th>
                                <th>Tes Covid Terakhir</th>
                                <th>Hasil Terakhir</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($tracking->result() as $v) {?>
                                <tr>
                                    <td><?= $i++?></td>
                                    <td><?= $v->nama ?></td>
                                    <td><?= $v->tgl_mulai_sakit ?></td>
                                    <td><?= $v->tgl_tes?></td>
                                    <td><span class="badge badge-pill badge-<?= $v->status_covid == '1' ? 'success':'danger'?>"><?= $v->status_covid == '0' ? '': ($v->status_covid == 2 ? 'Positif': 'Negatif')?></span></td>
                                    <td><a href="javascript:void(0)" onClick="detail_modal(<?= $v->idtc ?>)" class="btn btn-info btn-sm">detail</a></td>
                                </tr>
                            <?php }?>
                        </tbody>
                        
                    </table>
                </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<!-- Modal Detail-->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailLabel">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4 font-weight-bold">
                <p id="nama"></p>
                <p id="nma_jabatan"></p>
            </div>
            <div class="col-md-4 border-left">
                <p style="font-size: 12px; opacity: 0.5;">Aktivitas Satu Minggu Kebelakang</p>
                <p class="font-weight-bold" id="act_ming_kang"></p>
            </div>
            <div class="col-md-4 border-left" >
                <p style="font-size: 12px; opacity: 0.5;">Aktivitas Diluar Kantor Satu Minggu Kebelakang</p>
                <p class="font-weight-bold" id="act_luar_kntr"></p>
            </div>
        </div>
        <hr>
        <h3>History Tracking</h3>
        <div class="table-responsive">
            <table class="table" id="tabelHis">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Tes Covid</th>
                        <th>Catatan</th>
                        <th>Konsumsi Obat</th>
                        <th>Hasil Akhir</th>
                        <th>Berkas</th>
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
