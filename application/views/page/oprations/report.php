<section class="content">
    <style>
        .icon-shape{
            display: inline-flex;
            padding: 12px;
            text-align: center;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
        }

        .bg-orange{
            background:#fd7e14;
            color:#FFF;
        }
        
        .mycard{
            background-color: white;
            margin-bottom: 20px;
            -webkit-box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
            -moz-box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
            box-shadow: 0px 7px 11px -6px rgba(0,0,0,0.1);
        }
        
        .content-header{
            display: none;
        }

        thead tr td {
            font-size:14px;
        }

        tbody tr td {
            font-size:12px;
        }

        div.dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }

        #new, #pro, #pen, #res, #clo{
            font-size:16px;
        }
        
    </style>
    
    <div class="row" onload="changes(3)">
        <div class="col-md-12">
            <div class="card mycard" id="sticky" style="z-index:1000000;left:0;right:0;transition: width 2s;">
                <div class="card-body">
                    <form action="javascript:void(0)" id="formFilter">
                        <div class="row">
                            <div class="col-md-8 col">
                                <h4 class="display-4" style="font-size: 30px; color: tomato;"><i class="fas fa-file-contract"></i> Report Ticket</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="bulan" name="bulan" class="custom-select form-control form-control-sm">
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
                                    <div class="col-md-6">
                                        <select id="tahun" name="tahun" class="custom-select form-control form-control-sm">
                                            <?php for ($i=0; $i < 10 ; $i++) { ?> 
                                                <option value="202<?=$i;?>" <?= date('Y') == '202'.$i ? 'selected' : ''; ?>><?='202'.$i?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col text-right">
                            <hr>
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <select class="form-control form-control-sm" name="status" id="status">
                                            <option value="">All Status</option>
                                            <option value="new">new</option>
                                            <option value="pending">pending</option>
                                            <option value="progress">progress</option>
                                            <option value="resolved">resolved</option>
                                            <option value="closed">closed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control form-control-sm" name="customer" id="customer">
                                            <option value="">All Customer</option>
                                            <?php foreach ($customers as $v) { ?>
                                                <option value="<?=$v->id;?>"><?=$v->custend;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="padding:0 10px;font-size:12px;" id="basic-addon1">Tanggal Mulai</span>
                                            </div>
                                            <input type="date" name="tgl_mulai" id="tgl_mulai"  class="form-control form-control-sm" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="padding:0 10px;font-size:12px;" id="basic-addon1">Tanggal Akhir</span>
                                            </div>
                                            <input type="date" name="tgl_akhir" id="tgl_akhir"  class="form-control form-control-sm" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-default btn-sm w-100"><i class="fa fa-search"></i> Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-3" >
        <div class="col-md-3">
            <div class="card mycard card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">New</h5><br>
                            <span class="h2 font-weight-bold mb-0" id="new"></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-orange text-white rounded-circle shadow" >
                                <i class="fas fa-inbox"  style="color:#FFF;"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card mycard card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Pending</h5><br>
                            <span class="h2 font-weight-bold mb-0" id="pen"></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow" >
                                <i class="far fa-pause-circle"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card mycard card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Progress</h5><br>
                            <span class="h2 font-weight-bold mb-0" id="pro"></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow" >
                                <i class="fas fa-spinner"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                    </p>
                </div>
            </div>
        </div>
        

        <div class="col-md-2">
            <div class="card mycard card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0" >Resolved</h5><br>
                            <span class="h2 font-weight-bold mb-0" id="res"></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow" >
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card mycard card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0" >Closed</h5><br>
                            <span class="h2 font-weight-bold mb-0" id="clo"></span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow" >
                                <i class="far fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mycard" style="min-height: 535px;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Summery Tickets
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="bar-example">
                        <canvas id="st" style="height:400px;"></canvas>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mycard"  style="min-height: 530px;">
                <div class="card-body justify-content-center">
                    <div class="row" style="color: #4a4a4a;">
                        <div class="col-md-12 text-center" style="padding-top: 30px; padding-bottom: 20px;">
                            <i class="far fa-file-alt" style="color: #4d80e4; font-size: 50px;"></i>
                            
                            <h4 style="margin-top: 30px;"><strong  id="all">0</strong></h4>
                            <p>Total Ticket</p>
                        </div>
                        
                        <div id="ticket" class="col-md-10 offset-md-1" style="overflow-y: scroll; max-height: 288px; min-width: 288px;">
                            <div class="row">
                             <canvas id="jml_ticket" ></canvas>  
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-12">
       <div class="card">
          <div class="card-body">
            <div class="jdl" style="border-bottom:dotted 1px #DDD;margin-bottom:20px;">
                <div class="row">
                  <div class="col-md-6">
                    <b>Daftar Report</b>
                  </div>
                  <div class="col-md-6 text-right pb-2">
                    <button class="btn btn-success" onclick="getDownloadReport()">Download</button>
                  </div>
                </div>
            </div>
            <div class="tbticket" style="width:100%" >
                <table class="table display nowrap" id="table">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>No Ticket</td>
                            <td>Open Ticket</td>
                            <td>Close Ticket</td>
                            <td>Time</td>
                            <td>Pic</td>
                            <td>Customer</td>
                            <td>Node ID</td>
                            <td>Kategori</td>
                            <td>Sub Kategori</td>
                            <td>Provinsi</td>
                            <td>Status</td>
                            <td>Action</td>
                            <td>Detail Problem</td>
                            <td>Note</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                <!-- <table class="table display nowrap" id="table">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>No Ticket</td>
                            <td>Open Ticket</td>
                            <td>Close Ticket</td>
                            <td>Customer</td>
                            <td>Layanan</td>
                            <td>Alamat</td>
                            <td>Problem</td>
                            <td>Kategori</td>
                            <td>Sub Kategori</td>
                            <td>Layanan</td>
                            <td>Alamat</td>
                            <td>Problem</td>
                            <td>Status</td>
                            <td>Detail Problem</td>
                            <td>Note</td>
                            <td>Action Plan</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table> -->
            </div>
          </div>
       </div>
      </div>
    </div>
    
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>