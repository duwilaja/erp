<table style="width:100%;">
            <tr>
                <td>Tanggal Mulai</td>
                <td>:</td>
                <td><?=$this->bantuan->tgl_indo($peng->start_date)?></td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>:</td>
                <td><?=$this->bantuan->tgl_indo($peng->end_date)?></td>
            </tr>
            <tr>
                <td>Waktu Mulai</td>
                <td>:</td>
                <td><?=$peng->start_time?></td>
            </tr>
            <tr>
                <td>Waktu Selesai</td>
                <td>:</td>
                <td><?=$peng->end_time?></td>
            </tr>
            <tr>
                <td>Projek</td>
                <td>:</td>
                <td><?=$peng->project_id?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><?=$peng->keterangan?></td>
            </tr>
            <tr>
                <td>Laporan</td>
                <td>:</td>
                <td><?=$peng->laporan?></td>
            </tr>
        </table>