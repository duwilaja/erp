<style>
	a{
		color: #a3a3a3;
	}

	a:hover{
		color: tomato;
	}

	tr td {
		padding:5px !important;
		font-size:12px;
		width: 1px;
		white-space: nowrap;
		display: table-cell !important; vertical-align: middle !important;
		text-align:center;
	}
</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<br>
							<h6><strong>Pengadaan Sewa Jaringan Komunikasi di Korlantas Polri</strong></h6>
							<br>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<ul class="nav justify-content-center nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="timeline-tab" data-toggle="tab" href="#timeline" role="tab" aria-controls="timeline" aria-selected="true">Timeline</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="scope-tab" data-toggle="tab" href="#scope" role="tab" aria-controls="scope" aria-selected="false">Scope</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="rd-tab" data-toggle="tab" href="#rd" role="tab" aria-controls="rd" aria-selected="false">Resource Device</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="mp-tab" data-toggle="tab" href="#mp" role="tab" aria-controls="mp" aria-selected="false">Man Power</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="budget-tab" data-toggle="tab" href="#budget" role="tab" aria-controls="budget" aria-selected="false">Budget</a>
								</li>
							</ul>
							
						</div>
					</div>
					<br>
					<div class="row" style="min-height: 200px;">
						<div class="col-md-12">
							<div class="tab-content" id="myTabContent">
								<!-- tab timeline -->
								<div class="tab-pane fade show active" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
									<div class="row">
										<div style="padding-right: 0px;" class="col-md-12 col table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<td rowspan="2" >NO</td>
														<td rowspan="2" colspan="2" >PEKERJAAN</td>
														<td rowspan="2" colspan="<?=@count($psb);?>">PSB</td>
														<td rowspan="2" colspan="<?=@count($dismantle);?>">DISMANTLE</td>
														<?php  
														foreach ($dx['month'] as $k => $v) { 
															?>
															<td colspan="<?=$v['jml']?>"><?=$v['month']?></td>
														<?php }  ?>
													</tr>
													<tr>
														<?php  
														foreach ($dx['week'] as $k => $v) { 
															?>
															<td colspan="7"><?=$v['nama']?></td>
														<?php }  ?>
													</tr>
													<tr>
														<td>1</td>
														<td>KEGIATAN</td>
														<td>KATEGORI</td>
														<?php if(!$psb){ echo "<td></td>"; }else{ foreach ($psb as $k => $v) { ?>
															<td><?=$v->model;?></td>
														<?php } } ?>
														<?php if(!$dismantle){ echo "<td></td>"; }else{ foreach ($dismantle as $k => $v) { ?>
															<td><?=$v->model;?></td>
														<?php } } ?>
														<?php foreach ($dx['data'] as $k => $v) { ?>
															<td><?=$v['tgl']?></td>
														<?php } ?>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1; foreach (@$projek as $k => $v) { ?>
														<tr>
															<td></td>
															<td><?=$v['projek'];?></td>
															<td><?=@$v['kategori'];?></td>
                                                        <!-- <td><?=$v['start_date'];?></td>
                                                        	<td><?=$v['end_date'];?></td> -->
                                                        	<?php  foreach ($v['psb'] as $k => $xc) { ?>
                                                        		<td><?=$xc;?></td>
                                                        	<?php } ?>
                                                        	<?php foreach ($v['dismantle'] as $k => $xz) { ?>
                                                        		<td><?=$xz;?></td>
                                                        	<?php } ?>
                                                        	<?php  foreach ($dx['data'] as $k => $vx) { ?>
                                                        		<td <?=ok($v['calc'],$vx['date'])?>></td>
                                                        	<?php } ?>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                        function ok($calc,$k){
                                        	foreach ($calc as $v) {
                                        		if ($v == $k) {
                                        			echo 'style="background:#4CAF50;"';
                                        		}
                                        	}
                                        }
                                        ?>
                                    </div>
                                    <br>
                                    <div class="row">
                                    	<div class="col-md-12 text-center">
                                    		<a href="#" data-toggle="modal" data-target="#addtaskModal" class="btn btn-danger">Add Task</a>
                                    	</div>
                                    </div>
                                </div>
                                <!-- tab scope -->
                                <div class="tab-pane fade" id="scope" role="tabpanel" aria-labelledby="scope-tab">
                                	<!-- if file has't Uploaded -->
                                	
                                    <!-- <div class="row" style="padding-top: 40px;">
                                        <div class="col-md-12 text-center">
                                            <p style="color: tomato;">Upload Scope</p>
                                        </div>
                                        <div class="col-md-4 offset-md-4">
                                            <form action="">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                  </div>
                                            </form>
                                        </div>
                                    </div> -->
                                    <br>
                                    
                                    <!-- if file uploaded -->

                                    <div class="row">
                                    	<div class="col-md-12 text-right">
                                    		<a href="" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</a>
                                    	</div>
                                    	<div class="col-md-12 text-center">
                                    		<a href="">
                                    			<i class="fas fa-file-alt" style="font-size: 100px;"></i> <br>
                                    			Scope.pdf
                                    		</a>
                                    	</div>
                                    </div>
                                </div>
                                <!-- tab resource device -->
                                <div class="tab-pane fade" id="rd" role="tabpanel" aria-labelledby="rd-tab">
                                	<div class="row">
                                		<div class="col-md-5 col-12">
                                			<h5 style="color: tomato;">Device Type</h5>
                                			<br>
                                			<div class="table-responsive">
                                				<table class="table table-bordered">
                                					<thead>
                                						<tr>
                                							<th>No</th>
                                							<th>Device</th>
                                							<th>Qty</th>
                                							<th>Unit</th>
                                						</tr>
                                					</thead>
                                					<tbody>
                                						<tr>
                                							<td>1</td>
                                							<td>HSA-500</td>
                                							<td>20</td>
                                							<td>unit</td>
                                						</tr>
                                					</tbody>
                                				</table>
                                			</div>
                                		</div>
                                		<div class="col-md-7 col-12">
                                			<div class="row">
                                				<div class="col-md-6 col"><h5 style="color: tomato;">SN Device</h5></div>
                                				<div class="col-md-6 text-right">
                                					<select name="" id="" class="custom-select">
                                						<option value="">perangkat yg di input scm</option>
                                					</select>
                                				</div>
                                			</div>
                                			<br>
                                			<div class="table-responsive">
                                				<table class="table  table-bordered">
                                					<thead>
                                						<tr>
                                							<th>No</th>
                                							<th>Device</th>
                                							<th>SN</th>
                                							<th>MAC</th>
                                						</tr>
                                					</thead>
                                					<tbody>
                                						<tr>
                                							<td>1</td>
                                							<td>HSA-500</td>
                                							<td>HSA291230</td>
                                							<td>MAC324949</td>
                                						</tr>
                                					</tbody>
                                				</table>
                                			</div>
                                		</div>
                                	</div>
                                </div>
                                <!-- tab man power -->
                                <div class="tab-pane fade" id="mp" role="tabpanel" aria-labelledby="mp-tab">
                                	<div class="row">
                                		<div class="col-md-12">
                                			<h4 style="color: tomato;">Service Delivery Team Mapping</h4>
                                			<br>
                                			<div class="table-responsive">
                                				<table class="table table-bordered">
                                					<thead>
                                						<tr>
                                							<th>No</th>
                                							<th>Name</th>
                                							<th>Task</th>
                                							<th>Area</th>
                                						</tr>
                                					</thead>
                                					<tbody>
                                						<tr>
                                							<td>1</td>
                                							<td>Hisyam Koswari</td>
                                							<td>Staging</td>
                                							<td>Bali</td>
                                						</tr>
                                					</tbody>
                                				</table>
                                			</div>
                                		</div>
                                	</div>
                                </div>
                                <!-- tab budget -->
                                <div class="tab-pane fade" id="budget" role="tabpanel" aria-labelledby="budget-tab">tes5 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- add task Modal -->
<div class="modal fade" id="addtaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Timeline</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="javascript:void(0);" method="post" id="formAddTimeline">
					<div class="row">
						<div class="col-md-12">
							<h5 style="color: tomato;">Project Timeline</h5>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4 col">
							<label for="">Start</label>
						</div>
						<div class="col-md-4 col">
							<input name="pk_id" type="hidden" class="form-control" value="<?=$this->input->get('id')?>">
							<input name="start" type="date" value="<?=$pl['start_date']?>" class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-4 col">
							<label for="">End</label>
						</div>
						<div class="col-md-4 col">
							<input name="end" type="date" value="<?=$pl['end_date']?>" class="form-control">
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-4 col">
							<label for="">PSB</label>
						</div>
						<div class="col-md-4 col">
							<select class="form-control" name="psb[]" id="spsb" multiple>
							</select>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-md-4 col">
							<label for="">Dismantle</label>
						</div>
						<div class="col-md-4 col">
							<select class="form-control" name="dismantle[]" id="sdismantle" multiple>
							</select>
						</div>
					</div>
					<br>
					<div class="row ">
						<div class="col-md-6">
							<h5 style="color: tomato;">Task</h5>
						</div>
						<div class="col-md-6 text-right">
							<a href="#" onclick="add()" class="btn btn-success btn-sm">Add</a>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>

										<tr>
											<th>Pekerjaan</th>
											<th>Tanggal Mulai</th>
											<th>Tanggal Berkahir</th>
											<th>Keterangan</th>
											<th colspan="3" id="tpsb">PSB</th>
											<th colspan="2" id="tdismantle">DISMANTLE</th>
											<th>#</th>
										</tr>
									</thead>
									<tbody id="okrek">
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<br>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
