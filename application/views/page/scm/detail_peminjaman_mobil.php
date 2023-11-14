<?php 
foreach ($pengajuan_user as $key => $value) {
    // echo $value['img_start'];
    // die();
}?>
<style>
    .lbl{
        font-size: 14px;
        padding: 0 8px;
        color: #FFF;
        border-radius: 4px;
    }
    .lbl-warning {
        background: #fd7e14;
    }

    .lbl-success {
        background: #28a745;
    }
    
    .lbl-danger {
        background: #dc3545;
    }
    .lbl-primary {
        background: #1a8cff;
    }
</style>
<div class="card">
    <div class="card-header">
        <!-- Detail Pengajuan - <?=$k->nama?> -->
        Detail Pengajuan Peminjaman Mobil 
    </div>
    <div class="card-body">

       <table class="table table-bordered">
            <tr>
                <td>Nama </td>
                <!-- <td>:</td> -->
                <td><?php echo $value['nama'];?></td>
            </tr>
            <tr>
                <td>Mobil Yang Di Ajukan</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['pnjm_merek_mobil'];?></td>
            </tr>
            <tr>
                <td>Tanggal pengajuan</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['pnjm_waktu_pengajuan'];?></td>
            </tr>
            <tr>
                <td>Tanggal Mulai Peminjaman</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['tmp'];?></td>
            </tr>
            <tr>
                <td>Tanggal Selesai Peminjaman</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['tsp'];?></td>
            </tr>
            <tr>
                <td>Tanggal Extend</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['extend'];?></td>
            </tr>
            <tr>
                <td>Tujuan</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['tujuan'];?></td>
            </tr>
            <tr>
                <td>Projek</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['projek'];?></td>
            </tr>
            <?php
            if ($value['status_pengajuan'] == 5 || $value['status_pengajuan'] == 6) {
               ?>
                <tr>
                <td>Km Awal</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['km_start'];?></td>
            </tr>
            <tr>
                <td>Km Akhir</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['km_end'];?></td>
            </tr>
            <tr>
                <td>Bensin Awal</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['bensin_start'];?></td>
            </tr>
            <tr>
                <td>Bensin Akhir</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['bensin_end'];?></td>
            </tr>
            <tr>
                <td>Kondisi Fisik Mobil Setelah Pemakaian</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['status_kendaraan'];?></td>
            </tr>
            <tr>
                <td>Img Start</td>
                <!-- <td>:</td> -->
                <td><img src="<?php echo base_url('./data/mobil/img_start/'.$value['img_start'])?>" alt="" border=3 height=100 width=100 data-toggle="modal" data-target="#exampleModal0"></img></td>
            </tr>
            <tr>
                <td>Img End</td>
                <!-- <td>:</td> -->
                <td><img src="<?php echo base_url('./data/mobil/img_end/'.$value['img_end'])?>" alt="" border=3 height=100 width=100 data-toggle="modal" data-target="#exampleModal1"></img></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['pnjm_keterangan'];?></td>
            </tr>
               <?php
            }else{
                ?>
                 <tr>
                <td>Keterangan</td>
                <!-- <td>:</td> -->
                <td><?php echo $value['pnjm_keterangan'];?></td>
            </tr>
                <?php
            }
            
            ?>
        </table>

        <div class="row">
            <div class="col-md-12">
                <hr>
                <h5>History Approved</h5>
                <table class="table table-bordered">
                    <tr>
                        <td>Nama</td>
                        <td>Status</td>
                        <td>Tanggal</td>
                        <td>Keterangan Persetujuan</td>
                    </tr>
                    
                    <?php foreach ($hpeng as $v) { ?>
                    <tr>
                        <td><?=$v['nama'];?></td>
                        <!-- <td> -->
                        <?php
                        //   if ($v['status'] == 1) {
                        //      echo "Belum Di Proses";
                        //   }elseif ($v['status'] == 2) {
                        //      echo "Di Setujui";
                        //   }elseif ($v['status'] == 3) {
                        //      echo "Di Tolak | Ada Prioritas Pengajuan Lain";
                        //   }elseif ($v['status'] == 4) {
                        //      echo "Di Tolak";
                        //   }elseif ($v['status'] == 5) {
                        //     echo "Selesai";
                        //  }elseif ($v['status'] == 6) {
                        //     echo "Di Batalkan Oleh Sipengaju";
                        //  }
                        ?>
                            
                        <!-- </td> -->
                        <td><?=$v['pnjm_status_keterangan'];?></td>
                        <td><?=$v['tanggal_persetujuan'];?></td>
                        <td><?=$v['keterangan_status'];?></td>
                    </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr>
                <h5>Log Activity</h5>
                <table class="table table-bordered">
                    <tr>
                        <td>Nama</td>
                        <td>Tanggal</td>
                        <td>Keterangan Log</td>
                    </tr>
                    
                    <?php foreach ($log as $v) { ?>
                    <tr>
                        <td><?=$v['user'];?></td>
                        <td><?=$v['tanggal'];?></td>
                        <td><?=$v['aktifitas'];?></td>
                    </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal markup: https://getbootstrap.com/docs/4.4/components/modal/ -->
<div class="modal fade" id="exampleModal0" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="d-block w-100" src="<?php echo base_url('./data/mobil/img_start/'.$value['img_start'])?>">
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="d-block w-100" src="<?php echo base_url('./data/mobil/img_end/'.$value['img_end'])?>">
      </div>
    </div>
  </div>
</div>
