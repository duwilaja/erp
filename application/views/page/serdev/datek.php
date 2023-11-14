<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6">Data Teknis</div>
                    <div class="col-md-6"></div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Segment</th>
                                <th style="min-width: 200px;">Nama Unit</th>
                                <th>Provinsi</th>
                                <th style="min-width: 200px;">Alamat</th>
                                <th>PIC Customer</th>
                                <th style="min-width: 130px;">Kontak</th>
                                <th>Partner</th>
                                <th style="min-width: 130px;">Kontak Partner</th>
                                <th>Layanan</th>
                                <th>Bandwidth</th>
                                <th>IP WAN Internet</th>
                                <th>IP WAN VPN</th>
                                <th>IP LAN</th>
                                <th>SN</th>
                                <th>Status</th>
                                <th>Last Update</th>
                                <th>By</th>
                                <th style="min-width: 100px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Backhaul</td>
                                <td>Backhaul RTMC POlda Bali</td>
                                <td>Bali</td>
                                <td>Jl. WR Supratman No.6, Dangin puri kangin, kec. Denpasar Utara, kota Denpasar, Bali</td>
                                <td>Dudung</td>
                                <td>0811 1111 1111</td>
                                <td>Yusril</td>
                                <td>0811 1111 1111</td>
                                <td>VPNIP</td>
                                <td>15 Mbps</td>
                                <td>203.130.248.200/29</td>
                                <td>203.130.248.200/29</td>
                                <td>203.130.248.200/29</td>
                                <td></td>
                                <td>Stagging</td>
                                <td>22/0/2019</td>
                                <td>Hisyam</td>
                                
                                <td>
                                    <a href="<?=site_url('serdev/detail_datek')?>" class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#editModal" class="btn btn-danger btn-sm"><i class="far fa-edit"></i></a></td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Datek</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <h5 style="color: tomato;">Basic Info</h5>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">ID Datek</label></div>
                            <div class="col-md-7"><input name="id" type="text" class="form-control" disabled value="DTK001"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Segment</label></div>
                            <div class="col-md-7"><input name="segment" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Nama Unit</label></div>
                            <div class="col-md-7"><input name="unit" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Province</label></div>
                            <div class="col-md-7">
                                <select name="province" class="custom-select">
                                    <option value="">Bali</option>
                                </select>
                            </div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Alamat</label></div>
                            <div class="col-md-7"><textarea name="alamat" class="form-control"></textarea></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Titik Kordinat</label></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Longtitude</label></div>
                            <div class="col-md-7"><input name="longtitude" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Latitude</label></div>
                            <div class="col-md-7"><input name="latitude" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">PIC</label></div>
                            <div class="col-md-7"><input name="pic" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Kontak PIC</label></div>
                            <div class="col-md-7"><input name="kpic" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <h5 style="color: tomato;">Partner Info</h5>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Partner</label></div>
                            <div class="col-md-7"><input name="partner" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Kontak Partner</label></div>
                            <div class="col-md-7"><input name="kpartner" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Alamat Partner</label></div>
                            <div class="col-md-7"><textarea name="alamat-partner" class="form-control"></textarea></div>     
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <h5 style="color: tomato;">Service Info</h5>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Layanan</label></div>
                            <div class="col-md-7">
                                <select name="layanan" class="custom-select">
                                    <option value="astinet">Astinet</option>
                                    <option value="vpnip">VPNIP</option>
                                </select>
                            </div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Alamat Partner</label></div>
                            <div class="col-md-7"><textarea name="alamat-partner" class="form-control"></textarea></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Bandwidth</label></div>
                            <div class="col-md-7"><input name="bandwidth" type="text" class="form-control" placeholder="Mbps"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">IP WAN Internet</label></div>
                            <div class="col-md-7"><input name="internet" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">IP WAN VPN</label></div>
                            <div class="col-md-7"><input name="vpn" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">IP LAN</label></div>
                            <div class="col-md-7"><input name="lan" type="text" class="form-control"></div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12"><label for="">SN</label></div>
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>

                                        <tr id="ts1">
                                            <th>Device</th>
                                            <th>SN</th>
                                            <th>MAC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="ts">
                                            <td>

                                                <select name="device[]" class="custom-select">
                                                    <option value="">dari scm</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="sn[]" id="" class="custom-select">
                                                    <option value="">sesuai device</option>
                                                </select>
                                            </td>
                                            <td><input name="mac[]" type="text" class="form-control" disabled value="sesuai sn"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <a href="#" onclick="add()" style="width: 100%;" class="btn btn-danger btn-sm">Add</a>
                            </div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Status</label></div>
                            <div class="col-md-7">
                                <select name="status" class="custom-select">
                                    <option value="stagging">Stagging</option>
                                    <option value="shipping">Shipping</option>
                                    <option value="survey">Survey</option>
                                    <option value="installation">Installation</option>
                                    <option value="online">Online</option>
                                    <option value="Cancel">Cancel</option>
                                </select>
                            </div>     
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Remarks</label></div>
                            <div class="col-md-7"><textarea name="remarks" class="form-control"></textarea></div>     
                        </div>
                    </div>
                </div>
            </div>
            
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div
          </form>
        </div>
        >
      </div>
    </div>
  </div>

<script>
    var x = 1;
  function add(){
	if(x < 5){ //max input box allowed
        
        $('#ts'+x).after('<tr id="ts'+(x+1)+'"><td><select name="device" class="custom-select"><option value="">dari scm</option></select></td><td><select name="sn" id="" class="custom-select"><option value="">sesuai device</option></select></td><td><input name="mac[]" type="text" class="form-control" disabled value="sesuai sn"></td></tr>'); //add input box
        x++; //text box increment   
    }
    console.log(x);
}
</script>