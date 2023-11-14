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

    <form method="post" action="<?=site_url('payroll/inTf_gaji_karyawan');?>">
        <div class="card">
            <div class="card-body text-center">
                <b>
                    <h3 class="mb-0"><span style="text-decoration: underline;">SLIP PEMBAYARAN GAJI</span></h3>
                    <div>Gaji Bulan : <select class="form-control-sm" name="bulan_tf" style="width:200px;" required>
                        <option value="">- Pilih Bulan Transfer -</option>
                        <?php foreach ($bulan as $val ) { ?>
                            <option value="<?=$val[1]?>" <?=$val[0] == @date('m') ? 'selected' : '';?>><?=$val[1];?></option>
                        <?php } ?>
                    </select> <?=date('Y')?></div>
                </b>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <div class="idslip" style="border: solid 1px #555; width:200px;float: right;">
                            IDSLIP : <span id="txtidslip">-</span>
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
                                <td>
                                    <select class="form-control" name="karyawan" onchange="getKaryawan(this.value)" required>
                                    <option value="">- Pilih  Karyawan -</option>
                                    <?php foreach ($karyawan as $v) { ?>
                                        <option value="<?=$v->id?>" <?=@$val['nama'] == $v->nama ? 'selected' : '';?>><?=$v->nama;?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="text-left">
                                <td>Jabatan </td>
                                <td>:</td>
                                <td id="jabatan">-</td>
                            </tr>
                            <tr class="text-left">
                                <td>Direktorat </td>
                                <td>:</td>
                                <td id="direktorat">-</td>
                            </tr>
                            <tr class="text-left">
                                <td>Departemen </td>
                                <td>:</td>
                                <td id="departemen">-</td>
                            </tr>
                            <tr class="text-left">
                                <td>Golongan</td>
                                <td>:</td>
                                <td id="golongan">-</td>
                            </tr>
                            <tr class="text-left">
                                <td>Status Karyawan</td>
                                <td>:</td>
                                <td id="status_karyawan">-</td>
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
                                    <td  class="text-right"><input type="number" name="gp" onchange="cekTotalPenghasilan()" value="0"></td>
                                </tr>

                                <!-- Tunjangan Lainnya Buka-->
                                <tr class="text-left">
                                    <td><b>+ Tunjangan</b></td>
                                </tr>
                                <tr class="text-left">
                                    <td class="geser">Tunjangan Jabatan</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td  class="text-right"><input type="number" onchange="cekTotalPenghasilan()" name="tj" value="0"></td>
                                </tr>
                                <tr class="text-left">
                                    <td class="geser">Tunjangan Oprational</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td class="text-right"><input type="number" onchange="cekTotalPenghasilan()" name="to" value="0"></td>
                                </tr>
                                <tr class="text-left">
                                    <td class="geser">Tunjangan Khusus</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td  class="text-right"><input type="number" onchange="cekTotalPenghasilan()" name="tk" value="0"></td>
                                </tr>
                                <tr class="text-right">
                                    <td></td>
                                    <td class="text-left"></td>
                                    <td colspan="2">
                                        <div class="total total_penghasilan">
                                            <span class="text-left">Rp.</span> <span id="hasilPenghasilan" style="position: absolute;right: 10px;">0</span>
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
                                    <td  class="text-right"><input type="number" name="p_pph21"
                                    onchange="cekTotalPotongan()" value="0"></td>
                                </tr>

                                <tr class="text-left">
                                    <td width="5">2. </td>
                                    <td>BPJS Kesehatan</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td class="text-right"><input type="number" name="p_bpjs_kes"
                                    onchange="cekTotalPotongan()" value="0"></td>
                                </tr>

                                <tr class="text-left">
                                    <td width="5">3. </td>
                                    <td>BPJS Ketenagakerjaan</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td class="text-right"><input type="number" name="p_bpjs_ket"
                                    onchange="cekTotalPotongan()" value="0"></td>
                                </tr>

                                <tr class="text-left">
                                    <td width="5">4. </td>
                                    <td>Asuransi</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td class="text-right"><input type="number" name="p_ta" onchange="cekTotalPotongan()" value="0"></td>
                                </tr>

                                <tr class="text-left">
                                    <td width="5">6. </td>
                                    <td>Potongan Kenaikan Kelas Asuransi</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td class="text-right"><input type="number" name="p_kka"
                                    onchange="cekTotalPotongan()" value="0"></td>
                                </tr>

                                <tr class="text-left">
                                    <td width="5">5. </td>
                                    <td>Pinjaman</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td class="text-right"><input type="number" name="p_pinjaman"
                                    onchange="cekTotalPotongan()" value="0"></td>
                                </tr>
                                
                                <tr class="text-right">
                                    <td></td>
                                    <td></td>
                                    <td class="text-left"></td>
                                    <td colspan="2">
                                        <div class="total">
                                            <span class="text-left">Rp.</span> <span id="hasilPotongan" style="position: absolute;right: 10px;">0</span>
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
                                    <td class="geser" style="width: 264px;">Tunjangan BPJS Kesehatan</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td  class="text-right"><input type="number" name="bpjs_kes"  onchange="cekTotalTunjanganLain()" value="0"></td>
                                </tr>

                                <tr class="text-left">
                                    <td class="geser">Tunjangan BPJS Ketenagakerjaan</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td class="text-right"><input type="number" name="bpjs_ket" onchange="cekTotalTunjanganLain()"  value="0"></td>
                                </tr>
                                
                                <tr class="text-left">
                                    <td class="geser">PPh21</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td  class="text-right"><input type="number" name="pph21" onchange="cekTotalTunjanganLain()" value="0"></td>
                                </tr>
                               
                                <tr class="text-left">
                                    <td class="geser">Tunjangan Asuransi</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td  class="text-right"><input type="number" name="ta" onchange="cekTotalTunjanganLain()" value="0"></td>
                                </tr>
                                
                                <tr class="text-left">
                                    <td class="geser">Penambahan Jumlah Asuransi</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td  class="text-right"><input type="number" onchange="cekTotalTunjanganLain()" name="pja" value="0"></td>
                                </tr>

                                <tr class="text-left">
                                    <td class="geser">Lembur</td>
                                    <td>:</td>
                                    <td>Rp.</td>
                                    <td class="text-right"><input type="number" name="lembur" onchange="cekTotalTunjanganLain()" value="0"></td>
                                </tr>

                                <tr class="text-right">
                                    <td></td>
                                    <td class="text-left"></td>
                                    <td colspan="2">
                                        <div class="total total_penghasilan">
                                            <span class="text-left">Rp.</span> <span id="hasilTunjanganLain" style="position: absolute;right: 10px;">0</span>
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
                                <span class="text-left">Rp.</span> <span id="hasilGajiKotor" style="position: absolute;right: 10px;">0</span>
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
                                <p><b>Rp.</b><b id="hasilGajiBersih">0</b></p>
                                <p><i id="terbilang" class="text-capitalize">-</i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right mt-2">
                    <input type="hidden" name="idslip">
                    <input type="hidden" name="total_gj_kotor">
                    <input type="hidden" name="total_gj_bersih">
                    <input type="hidden" name="total_tj">
                    <input type="hidden" name="total_tj_lainnya">
                    <input type="hidden" name="total_gj_potongan">
                    <input type="submit" name="btn" class="btn btn-success mr-2" value="Simpan" >
                    </div>
                </div>
            </div>
                </div>
             </div>

          </div>
        </div>
          
    </form>