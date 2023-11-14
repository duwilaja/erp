<table style="width:100%;">
<tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td><?=$peng->created_date?></td>
            </tr>
            <tr>
                <td>Tanggal Mulai</td>
                <td>:</td>
                <td><?=$peng->start_date?></td>
            </tr>
            <tr>
                <td>Tanggal Selesai</td>
                <td>:</td>
                <td><?=$peng->end_date?></td>
            </tr>
            <tr>
                <td>Diajukan Oleh</td>
                <td>:</td>
                <td><?=$peng->leader_id;?></td>
            </tr>
            <tr>
                <td>Karyawan yang diajukan</td>
                <td>:</td>
                <td><?=$peng->karyawan_obj;?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><?=$peng->keterangan?></td>
            </tr>
        </table>