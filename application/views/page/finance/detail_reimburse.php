<style>
    .imgs{
        max-width:100%;
        max-height:100%;
    }
    .ket{
        border-bottom: dashed 1px #DDD;
        padding-bottom: 17px;
    }
    .img_struk li{
        list-style-type: decimal;
    }
</style>
<input type="hidden" id="fnc_r_id" value="<?=$this->uri->segment(3);?>">
<section class="content">
    <div class="card">
        <div class="card-body" style="font-size: 14px;">
            <div class="ket mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <table class="w-100">
                            <tr>
                                <td>Karyawan Yang Mengajukan</td>
                                <td>:</td>
                                <td><?= $data['reimburse']['nama'] ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Pengajuan</td>
                                <td>:</td>
                                <td><?= $data['reimburse']['tgl_pengajuan'] ?></td>
                            </tr>
                            <tr>
                                <td>Projek/Other</td>
                                <td>:</td>
                                <td><?= $data['reimburse']['projek'] ?></td>
                            </tr>
                            <tr>
                                <td>Status Pengajuan</td>
                                <td>:</td>
                                <td><?= $data['reimburse']['status'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <?=$data['tombol'];?>
                    </div>
                </div>
            </div>
            <div class="data_reimburse">
                <div class="label-reimburse mb-4" style="font-size: 18px;"><i class="fa fa-list"></i><b> Daftar Reimburse</b></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Klaim</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['daftar_reimburse']['dt_daftar'] as $value) { ?>
                            <tr>
                                <td><?= $this->bantuan->tgl_indo($value->tgl_klaim); ?></td>
                                <td><?= $value->klaim ?></td>
                                <td><?= $value->keterangan ?></td>
                                <td><?= torp($value->total); ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3"><b>Total Keseluruhan</b></td>
                            <td><b><?=$data['daftar_reimburse']['total_keseluruhan']; ?></b></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;" colspan="4"><b>BUKTI STRUK</b></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <ul class="img_struk">
                                    <?php $no=1; foreach ($data['bukti_struk']['file'] as $value) {
                                        ?>
                                         <li><a href="<?=site_url('data/finance/reimburse/'.$value->file)?>"><?= $value->file ?></a></li>
                                        <?php
                                    } ?>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;"><b>Diketahui oleh</b></td>
                            <td colspan="2" style="text-align:center;"><b>Disetujui oleh</b></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;"><?= $data['approval']['diketahui']; ?></td>
                            <td colspan="2" style="text-align:center;"><?= $data['approval']['disetujui']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="data_history">
                <div class="label-reimburse mb-3" style="font-size: 18px;"><b> History</b></div>
                <table class="table table-bordered">
                    <tbody>
                            <?php foreach ($data['history'] as $value) { ?>
                                <tr>
                                     <td>
                                        <i><?= $this->bantuan->tgl_indo($value->ctddate); ?></i><br>
                                        <?= $this->mf->set_history_status($value->status_confirm,$value->pic_status) ?>
                                        <?= $value->nama; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <!-- <tr>
                            <td>
                                <i>14 Desember 2020, 18:00 WIB.</i><br>
                                Di Setujui oleh Nur Lidiyawati
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i>14 Desember 2020, 13:50 WIB.</i><br>
                                Di Ketahui oleh Ahmad Farisy
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <i>13 Desember 2020, 10:00 WIB.</i><br>
                                Mengajukan Reimburse, Aldi Sumarna
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>