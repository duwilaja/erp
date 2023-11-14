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
    
    .clist{
        border-top:solid 1px #DDD;
        margin-top:10px;
        padding-top:10px;
        font-size: 15px;
        color: #555;
    }

    .jdl{
        font-size:18px;
    }
</style>

<div class="row">
	<div class="col-md-12">
		<div class="card">
        <form action="javascript:void(0);" id="formAddPipActivity" >
			<div class="card-body">
					<h3>Activity</h3>
					<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="input">
                                <input type="hidden" name="id" value="<?=$this->uri->segment('3');?>">
                                <input type="hidden" id="actx" value="<?=$this->input->get('act');?>">
                                <input type="hidden" name="act" value="<?=$pa['act'];?>">
									<div class="t-jdl">Category</div>
									<div class="txt-bottom txtCategory"><?=$pa['category'];?></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input mt-2">
									<div class="t-jdl">Customer</div>
									<div class="txt-bottom txtCustomer"><?=$pa['customer'];?></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input mt-2">
									<div class="t-jdl">End Customer</div>
									<div class="txt-bottom txtEndCustomer"><?=$pa['custend'];?></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input mt-2">
									<div class="t-jdl">Solution</div>
									<div class="txt-bottom txtSolution"><?=$pa['solution'];?></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input mt-2">
									<div class="t-jdl">Produk</div>
									<div class="txt-bottom txtProduk"><?=$pa['product'];?></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input mt-2">
									<div class="t-jdl">Note</div>
									<div class="txt-bottom txtProduk"><?=$pa['note'];?></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input mt-2">
									<div class="t-jdl">Detail</div>
									<a href="<?=site_url('SelMa/detail_pipeline/'.$this->uri->segment('3').'?act='.$this->input->get('act'));?>"  class="btn btn-dark btn-sm">Lihat History</i></a>
								</div>
							</div>
                            <div class="col-md-12">
                                <hr>
                            </div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
								<div class="col-md-12">
									<div class="mb-2">Aktivitas</div>
									<select class="form-control" name="activity">
										<option value="">-- Pilih Aktifitas --</option>
										<!-- <option value="1">Contact Potential</option>
										<option value="2">Persentation</option>
										<option value="3">Technical Presentation</option>
										<option value="4">POC</option>
										<option value="5">SPH</option>
										<option value="6">BAKN</option>
										<option value="7">PO</option>
										<option value="8">Lost</option>
										<option value="9">Close Deal</option> -->
										<?php foreach ($act as $v) { ?>
											<option value="<?=$v['no'];?>"><?=$v['nama'];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-12 mt-2">
									<div class="row" id="hasil">
									</div>

									<div class="row">
										<div class="col-md-12">
										    <hr>
											<div>Perkiraan Projek Deal </div>
											<select name="persen" id="note" class="form-control">
												<option value="10">10%</option>
												<option value="15">15%</option>
												<option value="20">20%</option>
												<option value="25">25%</option>
												<option value="30">30%</option>
												<option value="35">35%</option>
												<option value="40">40%</option>
												<option value="45">45%</option>
												<option value="50">50%</option>
												<option value="55">55%</option>
												<option value="60">60%</option>
												<option value="65">65%</option>
												<option value="70">70%</option>
												<option value="75">75%</option>
												<option value="80">80%</option>
												<option value="85">85%</option>
												<option value="90">90%</option>
												<option value="95">95%</option>
												<option value="100">100%</option>
											</select>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
										    <hr>
											<div>Note</div>
											<textarea name="note" id="note" class="form-control" placeholder="Masukan note anda disini"></textarea>
										</div>
									</div>
								</div>
						</div>
					</div>
                    <div class="col-md-6">
                        <div class="card" id="box_act" style="width:472px;">
                            <div class="card-body">
                               <div class="jdl">Aktivitas</div>
                                <div class="getAct">
                                    <!-- <div class="clist"><i class="fa fa-check" id="act1"></i> Contact Potential</div>
                                    <div class="clist"><i class="fa fa-check" id="act2"></i> Persentation</div>
                                    <div class="clist"><i class="fa fa-check" id="act3"></i> Technical Presentation</div>
                                    <div class="clist"><i class="fa fa-check" id="act4"></i> POC</div>
                                    <div class="clist"><i class="fa fa-check" id="act5"></i> SPH</div>
                                    <div class="clist"><i class="fa fa-check" id="act6"></i> BAKN</div>
                                    <div class="clist"><i class="fa fa-check" id="act7"></i> PO</div>
                                    <div class="clist"><i class="fa fa-check" id="act8"></i> Lost</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
            <div class="card-footer text-right">
				<a href="<?=$this->input->get('act') == '2' ? site_url('SelMa/new_cust') : site_url('SelMa/pipeline') 
				?>" class="btn btn-danger">Batal</a>
                <input type="submit" class="btn btn-success" value="Simpan">
            </div>
        </form>
		</div>
	</div>
</div>
