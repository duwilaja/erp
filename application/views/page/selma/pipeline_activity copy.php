<style>
   
   .t-jdl{
    font-size:16px;
   }
   .txt-bottom{
        font-size:12px;
    }
    #formActivity{
        padding: 0px 10px;
    }
</style>

<div class="row">
<div class="col-md-12">
<div class="card">
        <div class="card-body">
        <div class="col-md-12">
            <h3>Activity</h3>
            <hr>
        </div>
            <div class="row">
                <div class="col-md-12">
                   <div class="row">
                   <div class="col-md-12">
                        <div class="input">
                            <div class="t-jdl">Category</div>
                            <div class="txt-bottom txtCategory"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input">
                            <div class="t-jdl">Customer</div>
                            <div class="txt-bottom txtCustomer"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input">
                            <div class="t-jdl">End Customer</div>
                            <div class="txt-bottom txtEndCustomer"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input">
                            <div class="t-jdl">Solution</div>
                            <div class="txt-bottom txtSolution"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input">
                            <div class="t-jdl">Produk</div>
                            <div class="txt-bottom txtProduk"></div>
                        </div>
                    </div>
                   </div>
                </div>
                <div class="col-md-12">
                    <form action="javascript:void(0);" id="formActivity" >
                        <div class="row">
                            <div class="col-md-12">
                              <hr>
                               <div class="mb-2">Aktifitas</div>
                                <select class="form-control" name="activity">
                                    <option value="">-- Pilih Aktifitas --</option>
                                    <option value="1">Contact Potential</option>
                                    <option value="2">Persentation</option>
                                    <option value="3">Technical Presentation</option>
                                    <option value="4">POC</option>
                                    <option value="5">SPH</option>
                                    <option value="6">BAKN</option>
                                    <option value="7">PO</option>
                                    <option value="8">Lost</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                 <div class="row" id="hasil">
                                     <!-- Persentation -->
                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">Tanggal Persentasi</div>
                                        <input type="date" name="present_date" class="form-control" id="pd">
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">MOM</div>
                                        <input type="file" name="mom" class="form-control" id="mom">
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">Customer Butuhkan</div>
                                        <input type="file" name="customer_needs" class="form-control" id="cn">
                                     </div>

                                    <!-- Technical Present -->
                                     <div class="col-md-12">
                                        <input type="checkbox" name="pl"id="pl"> Persentasi Lanjutan
                                     </div>

                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">Tanggal Persentasi</div>
                                        <input type="date" name="present_date" class="form-control" id="pd">
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">MOM</div>
                                        <input type="file" name="mom" class="form-control" id="mom">
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">Customer Butuhkan</div>
                                        <input type="file" name="customer_needs" class="form-control" id="cn">
                                     </div>

                                     <!-- POC -->

                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">Tanggal Poc</div>
                                        <input type="date" name="present_date" class="form-control" id="pd">
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">Tim Teknikal</div>
                                        <input type="file" name="mom" class="form-control" id="mom">
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">MOM</div>
                                        <input type="file" name="customer_needs" class="form-control" id="cn">
                                     </div>

                                      <!-- SPH -->

                                      <div class="col-md-12">
                                        <div class="mb-2 mt-2">Pricing</div>
                                        <input type="radio" name="p" id="pl"> CAPEX  <input type="radio" name="p" id="pl"> OPEX
                                     </div>

                                     <div class="col-md-12">
                                        <div class="card">
                                        <div class="card-header">SPH</div>
                                            <div class="card-body p-0">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Judul Pekerjaan</th>
                                                            <th>No SPH</th>
                                                            <th>SPH</th>
                                                            <th><button id="add_sph" class="btn btn-success"><i class="fa fa-plus"></i></button></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><textarea name="jp" id="jp" cols="30" rows="10" class="form-control"></textarea></td>
                                                            <td><input type="text" class="form-control" name="no_sph"></td>
                                                            <td><input type="file" class="form-control" name="sph"></td>
                                                            <td><button id="hapus_sph" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                     </div>   

                                     <!-- BAKN -->

                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">Judul Pelayanan</div>
                                        <input name="jp" id="jp" class="form-control"/>
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">Nominal BAKN</div>
                                        <input type="number" name="nominal" class="form-control" id="nominal">
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">Upload BAKN</div>
                                        <input type="file" name="bkan" class="form-control" id="upload_bkan">
                                     </div>

                                     <!-- PO/SPK -->
                                      
                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">No PO</div>
                                        <input name="no_po" id="no_po" class="form-control"/>
                                     </div>
                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">Judul Pelayanan</div>
                                        <input name="jp" id="jp" class="form-control"/>
                                     </div>
                                     <div class="col-md-6">
                                        <div class="mb-2 mt-2">Jumlah Titik/Lokasi</div>
                                        <input type="number" name="jml" class="form-control" id="jml_titik">
                                     </div>
                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">Nominal PO</div>
                                        <input name="nominal_po" id="po" class="form-control"/>
                                     </div>
                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">Period</div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-2 mt-2">Tanggal Mulai</div>
                                                <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2 mt-2">Tanggal Selesai</div>
                                                <input type="date" name="tgl_selesai" class="form-control" id="tgl_selesai">
                                            </div>
                                        </div>
                                     </div>
                                     <div class="col-md-12">
                                        <div class="mb-2 mt-2">Upload PO</div>
                                        <input type="file" name="upload_po" class="form-control" id="upload_po">
                                     </div>


                                 </div>
                            </div>
                        </div>
                    </form>
                </div>
             </div>
        </div>
    </div>
</div>
</div>
