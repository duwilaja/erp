

<div class="card">
    <div class="card-header card-black">
        <h3 class="card-title"><?=$titleForm;?></h3>
    </div>
    <form name="myForm" role="form" method="POST" action="<?=site_url('SCM/'.$action);?>" onsubmit="return validateForm()">
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Pilih Mobil</label>    
                        <select name="pnjm_mobil_id" class="form-control" onchange="pilihFor(this.value)">
                        <option value="0">-Pilih-</option>
                        <?php 
                            		$query = $this->db->get_where('pnjm_mobil',array('pnjm_status_pemakaian' => '0'));
                                    foreach ($query->result() as $row)
                                    {
                                            ?>
                                              <option value="<?php echo $row->pnjm_id_mobil ?>"><?php echo $row->pnjm_merek_mobil ?></option>
                                            <?php
                                    }     
                        ?>
						</select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" class="form-control" name="pnjm_tujuan" placeholder="Ex : Kantor" value="">         
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Mulai Peminjaman</label>
                        <input type="text" class="form-control" name="tmp" >         
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tanggal Selesai Peminjaman</label>
                        <input type="text" class="form-control" name="tsp" >         
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Projek</label>
                        <select name="pnjm_projek" class="form-control" onchange="pilihFor(this.value)">
                            <option value="0">-Pilih-</option>
							<option value="1">opty</option>
                            <option value="2">Lelang/Bid</option>
                            <option value="3">Running</option>
                            <option value="4">Other</option>
						</select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Keterangan Pengajuan</label>
                        <textarea class="form-control" name="pnjm_keterangan" placeholder="Ex: Kunjungan Industri"></textarea>
                    </div>
                </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="bttn" style="float:right;">
			<?php if(!empty($val['pnjm_id'])){?>
				<input type="button" class="btn btn-danger" onclick="this.form.action='<?=site_url('SCM/del_vendor');?>';this.form.submit();" value="Hapus">
            <?php }?>
            <input type="submit" class="btn btn-success" id="btnSubmit" value="Simpan" onclick="var e=this;setTimeout(function(){e.disabled=true;},0);return true;">
            </div>
        </div>
    </form>
</div>
