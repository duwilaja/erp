<table style="width:100%;">
            <tr>
                <td>Izin</td>
                <td>:</td>
                <td>Sakit</td>
            </tr>
            <tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td><?=$this->bantuan->tgl_indo($peng->created_date)?></td>
            </tr>
            <tr>
                <td>Bukti</td>
                <td>:</td>
                <td><a href="<?=site_url('data/bukti_sakit/'.@$peng->bukti)?>"><?=@$peng->bukti;?></a></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><?=$peng->keterangan?></td>
            </tr>
        </table>