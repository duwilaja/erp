    <style>
        .table td, .table th {
            padding: 0.25rem;
            vertical-align: top;
            border-top: none;
        }
        .geser{
            position: relative;
            left: 20px;
        }
        .total{
            display: flex;
            border-top: solid;
            border-bottom: solid;
            font-weight: 700;
        }
        .total_gj_bersih{
            border: solid 2px #000;
             padding-top: 14px;
        }
    </style>
    <div class="card">
        <div class="card-body text-center">
            <b>
                <h3 class="mb-0"><span style="text-decoration: underline;">SLIP PEMBAYARAN GAJI</span></h3>
                <p>Gaji Bulan : <?= $slr->bulan.' '.$slr->tahun;; ?> </p>
            </b>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="idslip" style="border: solid 1px #555; width:200px;float: right;">
                        IDSLIP : <span><?= $slr->idslip; ?></span>
                    </div>
                </div>
            </div>
            <div class="garis" style="border-bottom: 2px #6c757d;margin-top: 15px; border-style: double;"></div>

            <div class="row">
                <div class="col-md-6">
                    <table id="detail_karyawan " class="table">
                        <tr class="text-left">
                            <td>Nama Karyawan </td>
                            <td>:</td>
                            <td><b><?=$karyawan->nama;?></b></td>
                        </tr>
                        <tr class="text-left">
                            <td>Jabatan </td>
                            <td>:</td>
                            <td><?=$karyawan->nma_jabatan;?></td>
                        </tr>
                        <!-- <tr class="text-left">
                            <td>Direktorat </td>
                            <td>:</td>
                            <td><?=$karyawan->direktorat;?></td>
                        </tr> -->
                        <tr class="text-left">
                            <td>Departemen </td>
                            <td>:</td>
                            <td><?=$karyawan->departemen;?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Golongan</td>
                            <td>:</td>
                            <td><?=$karyawan->gol;?></td>
                        </tr>
                        <tr class="text-left">
                            <td>Status Karyawan</td>
                            <td>:</td>
                            <td><?=$karyawan->status_karyawan == 1 ? 'Kontrak' : 'Tetap';?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                         <h6 class="text-left font-weight-bold">PENGHASILAN</h6>
                         <table id="detail_penghasilan " class="table" width="100">
                            <tr class="text-left">
                                <td><b>+ Gaji Pokok</b></td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td  class="text-right"><?= srlde($salary->gp);?></td>
                            </tr>

                            <!-- Tunjangan Lainnya Buka-->
                            <tr class="text-left">
                                <td><b>+ Tunjangan</b></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser">Tunjangan Jabatan</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td  class="text-right"><?= number_format(srlde($salary->tj) == '' ? 0 : srlde($salary->tj),0,'.','.');?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser">Tunjangan Keahlian</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td  class="text-right"><?= number_format(srlde($salary->tkah) == '' ? 0 : srlde($salary->tkah),0,'.','.');?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser">Tunjangan Oprational</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td class="text-right"><?= number_format(srlde($salary->to) == '' ? 0 : srlde($salary->to),0,'.','.');?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser">Tunjangan Khusus</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td  class="text-right"><?= number_format(srlde($salary->tk) == '' ? 0 : srlde($salary->tk),0,'.','.');?></td>
                            </tr>
                            <tr class="text-right">
                                <td></td>
                                <td class="text-left"></td>
                                <td colspan="2">
                                    <div class="total total_penghasilan">
                                        <span class="text-left">Rp.</span> <span style="position: absolute;right: 10px;"><?= @number_format(srlde($slr->total_tj),0,'.','.');?></span>
                                    </div>
                                </td>
                            </tr>
                            <!-- Tunjangan Lainnya Tutup -->
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-left font-weight-bold">POTONGAN</h6>
                        <table id="detail_penghasilan " class="table" width="100">
                            <tr class="text-left">
                                <td width="5">1. </td>
                                <td>PPh21</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td class="text-right"><?= number_format(srlde($salary->p_pph21) == '' ? 0 : srlde($salary->p_pph21) ,0,'.','.');?></td>
                            </tr>

                            <tr class="text-left">
                                <td width="5">2. </td>
                                <td>BPJS Kesehatan</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td class="text-right"><?= number_format(srlde($salary->p_bpjs_kes) == '' ? 0 : srlde($salary->p_bpjs_kes),0,'.','.');?></td>
                            </tr>

                            <tr class="text-left">
                                <td width="5">3. </td>
                                <td>BPJS Ketenagakerjaan</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td class="text-right"><?= number_format(srlde($salary->p_bpjs_ket) == '' ? 0 : srlde($salary->p_bpjs_ket),0,'.','.');?></td>
                            </tr>

                            <tr class="text-left">
                                <td width="5">4. </td>
                                <td>Asuransi</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td class="text-right"><?= ($salary->p_ta);?></td>
                            </tr>
                            
                            <tr class="text-left">
                                <td width="5">5. </td>
                                <td>Potongan Kenaikan Kelas Asuransi</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td class="text-right"><?= number_format(srlde($salary->p_pja) == '' ? 0 : srlde($salary->p_pja),0,'.','.');?></td>
                            </tr>

                            <tr class="text-left">
                                <td width="5">6. </td>
                                <td>Pinjaman</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td class="text-right"><?= number_format(srlde($salary->p_pinjaman) == '' ? 0 : srlde($salary->p_pinjaman),0,'.','.');?></td>
                            </tr>

                            <tr class="text-right">
                                <td></td>
                                <td></td>
                                <td class="text-left"></td>
                                <td colspan="2">
                                    <div class="total">
                                        <span class="text-left">Rp.</span> <span style="position: absolute;right: 10px;"><?= number_format(srlde($slr->total_gj_potongan),0,'.','.');?></span>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                         <table id="detail_penghasilan " class="table" width="100">
                            <!-- Tunjangan Lainnya Buka-->
                            <tr class="text-left">
                                <td><b>+ Tunjangan Lainnya</b></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser" style=" width: 264px;">Tunjangan BPJS Kesehatan</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td  class="text-right"><?= number_format(srlde($salary->bpjs_kes) == '' ? 0 : srlde($salary->bpjs_kes),0,'.','.');?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser">Tunjangan BPJS Ketenagakerjaan</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td class="text-right"><?= number_format(srlde($salary->bpjs_ket) == '' ? 0 : srlde($salary->bpjs_ket),0,'.','.');?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser">PPh21</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td  class="text-right"><?= number_format(srlde($salary->pph21) == '' ? 0 : srlde($salary->pph21),0,'.','.');?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser">Tunjangan Asuransi</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td  class="text-right"><?= number_format(srlde(@$salary->ta) == '' ? 0 : srlde($salary->ta),0,'.','.');?></td>
                            </tr>
                            <tr class="text-left">
                                <td class="geser">Lembur</td>
                                <td>:</td>
                                <td>Rp.</td>
                                <td  class="text-right"><?= srlde($salary->lembur) == '' ? 0 : @srlde($salary->lembur) ?></td>
                            </tr>
                            <tr class="text-right">
                                <td></td>
                                <td class="text-left"></td>
                                <td colspan="2">
                                    <div class="total total_penghasilan">
                                        <span class="text-left">Rp.</span> <span style="position: absolute;right: 10px;"><?= number_format(srlde($slr->total_tj_lainnya),0,'.','.');?></span>
                                    </div>
                                </td>
                            </tr>
                            <!-- Tunjangan Lainnya Tutup -->
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-left font-weight-bold">GAJI KOTOR</h6>
                    </div>
                     <div class="col-md-6">
                        <div class="total">
                            <span class="text-left">Rp.</span> <span style="position: absolute;right: 10px;"><?= number_format(srlde($slr->total_gj_kotor),0,'.','.');?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="total_gj_bersih mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p><b>Total Gaji Bersih Diterima</b></p>
                            <p><i>Terbilang</i></p>
                        </div>
                        <div class="col-md-6">
                            <p><b>Rp.</b><b><?= number_format(srlde($slr->total_gj_bersih),0,'.','.');?></b></p>
                            <p style="text-transform: capitalize;"><i><?=$terbilang;?></i></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                   <div class="dibayar text-left mt-5">
                       <p style="margin:0;">Depok, 31 Januari 2020</p>
                       <p style="margin:0;">Dibayar Oleh,</p>
                       <p style="margin:0;">PT. Madina Mitra Teknik</p>
                       <div class="kosongan" style="height: 100px">
                           
                       </div>
                       <p style="margin:0;">(Devita Aulia Fitri)</p>
                       <p>HRD</p>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>