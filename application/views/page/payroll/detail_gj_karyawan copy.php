<div class="card">
    <div class="card-body">
        <div class="bungkus" style="display:flex;">
            <div class="left" style="width:300px;">
                <table>
                    <tr>
                        <td><?=$config->nama;?></td>
                    </tr>
                    <tr>
                        <td><?=$config->alamat;?></td>
                    </tr>
                    <tr> 
                        <td>TELP. <?=$config->no_telp;?></td>
                    </tr>
                </table>
            </div>
            <div class="center text-center"  style="width:400px;">
                <h3 style="position:relative;right:80px;top:20px;font-weight:bold;">SLIP  GAJI</h3>
            </div>
            
            <div class="right" style="width:300px; text-align:left;">
                <table style="width:100%;">
                    <tr>
                        <td>Gaji Bulan</td>
                        <td width="20">:</td>
                        <td><?=$tf_gaji->bulan;?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td width="20">:</td>
                        <td><?=$this->bantuan->tgl_indo(explode(' ',$tf_gaji->created_date)[0]);?></td>
                    </tr>
                    <tr>
                        <td>Kode Karyawan</td>
                        <td width="20">:</td>
                        <td><?=$karyawan->nip;?></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr style="border:1px solid #555;">
        <div class="bungkus-bawah" style="display: flex;">
            
            <div class="left">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td width="20" align="center">:</td>
                        <td><?=$karyawan->nama;?></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td width="20" align="center">:</td>
                        <td><?=$karyawan->nma_jabatan;?></td>
                    </tr>
                </table>
            </div>
            
            <div class="center text-center"  style="width:280px;"> </div>

            <div class="right" style="width:400px; text-align:left;">
                <table style="width:100%;">
                    <tr>
                        <td>Alamat</td>
                        <td width="20">:</td>
                        <td><?=$karyawan->alamat_tinggal;?></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td width="20">:</td>
                        <td><?=$karyawan->no_telp;?></td>
                    </tr>
                </table>
           </div>

        </div>
        <table style="width: 100%;" class="table table-bordered mt-3">
           <thead style="border-top: solid 2px #555;">
                <tr style="font-weight: bold;">
                    <td width="30">No</td>
                    <td width="400">Keterangan</td>
                    <td>(+) Pendapatan</td>
                    <td>(-) Potongan</td>
                    <td>Total</td>
                </td>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($salary as $v) { ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$v[1];?></td>
                    <td><?=$v[0];?></td>
                    <td><?=$v[0];?></td>
                    <td><?=$v[0];?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-capitalize"><i><?=$terbilang;?></i></td>
                    <td  style="border-bottom: solid 2px #555;">TOTAL DITERIMA : <span><?=$total;?></span></td>
                </tr>
            </tfoot>
        </table>
        <div class="serah_terima mt-4">
            <div class="b-penerima text-center" style="float: left;position: relative;left: 50px;">
                <div class="n-penerima">Penerima,</div>
                <div style="min-height:70px;"></div>
                <div><?=$karyawan->nama;?></div>
            </div>
            <div class="b-pemberi text-center" style="float: right;position: relative;right: 50px;">
                <div class="n-pemberi"><?=$this->bantuan->tgl_indo(date('Y-m-d'))?>,</div>
                <div style="min-height:70px;"></div>
                <div><?=$config->nama;?></div>
            </div>
        </div>
</div>