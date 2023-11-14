<table style="width:100%;">
            <tr>
                <td>Izin</td>
                <td>:</td>
                <td>Cuti</td>
            </tr>
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
                <td>Keterangan</td>
                <td>:</td>
                <td><?=$peng->keterangan?></td>
            </tr>
        </table>