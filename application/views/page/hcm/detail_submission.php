<div class="card">
    <div class="card-header">
        Detail Pengajuan - <?=$k->nama?>
    </div>
    <div class="card-body">

        <?php 
            if ($jenis == 'CU') {
                $this->load->view('page/hcm/submission/cu');
            }else if ($jenis == 'L') {
                $this->load->view('page/hcm/submission/l');
            }else if ($jenis == 'PD') {
                $this->load->view('page/hcm/submission/pd');
            }else if ($jenis == 'SK') {
                $this->load->view('page/hcm/submission/sk');
            }
        ?>

        <div class="row">
            <div class="col-md-12">
                <hr>
                <h5>History Approved</h5>
                <table class="table table-bordered">
                    <tr>
                        <td>Nama</td>
                        <td>Disetujui</td>
                        <td>Tanggal</td>
                        <td>Catatan</td>
                    </tr>
                    
                    <?php foreach ($hpeng as $v) { ?>
                    <tr>
                        <td><?=$v['nama'];?></td>
                        <td><?=$v['approve'];?></td>
                        <td><?=$v['tgl'];?></td>
                        <td><?=$v['alasan'];?></td>
                    </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</div>