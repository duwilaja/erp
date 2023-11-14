<style>
.has-search .form-control {
    padding-left: 3.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 3.2rem;
    text-align: center;
    pointer-events: none;
    color: #00c0ef;
    font-size:1.2rem;
    padding-left:1rem;
}
.icon-jobs {
    background-color: #f5f2fd;
    height: 4.5rem;
    width: 4rem;
    border-radius:10px;
    color: #00c0ef;
    text-align:center;
    font-size:2rem;
    margin-left:2rem;
}

.job a:hover{
    border: 1px solid #00c0ef;
}

.dot-flashing {
		position: relative;
		width: 10px;
		height: 10px;
		border-radius: 5px;
		background-color: #ED0714;
		color: #ED0714;
		animation: dotFlashing 1s infinite linear alternate;
		animation-delay: .5s;
	}

	.dot-flashing::before, .dot-flashing::after {
		content: '';
		display: inline-block;
		position: absolute;
		top: 0;
	}

	.dot-flashing::before {
		left: -15px;
		width: 10px;
		height: 10px;
		border-radius: 5px;
		background-color: #ED0714;
		color: #ED0714;
		animation: dotFlashing 1s infinite alternate;
		animation-delay: 0s;
	}

	.dot-flashing::after {
		left: 15px;
		width: 10px;
		height: 10px;
		border-radius: 5px;
		background-color: #ED0714;
		color: #ED0714;
		animation: dotFlashing 1s infinite alternate;
		animation-delay: 1s;
	}

	@keyframes dotFlashing {
		0% {
			background-color: #ED0714;
		}
		50%,
		100% {
			background-color: #ebe6ff;
		}
	}

    .slt .select2-container .select2-selection--single {
        border: 1px solid #ced4da!important;
        height: calc(2.25rem + 11px)!important;
    }

</style>
<section class="content">
    <div class="row">
        <div class="mb-4 mr-4 ml-auto">
            <a href="javascript:void(0);" class="btn btn-success" onclick="addModal()"><i class="fa fa-plus"></i> Add Jobs</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="form-group has-search input-group-lg">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control" placeholder="Search" onchange="jobs(this.value);" id="srch">
            </div>
        </div>
        <div class="col-md-3 slt">
            <select name="" id="lct" class="form-control lct" onchange="jobs(this.value);" style="">
                <option value="">Location</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
           <p class="font-weight-normal">We've found <b class="text-info" id="jml_job"></b> jobs! </p>
        </div>
        <div class="ml-auto">
        </div>
    </div>
    <div class="job" id="jobs">
    </div>
    <div id="load_data_message"></div>
    <br>
</section>


<!-- Add Modal -->
<div class="modal fade" id="formAddJob" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" method="post" id="addJob">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jobName">Job Name</label>
                                <input type="text" name="job_name" class="form-control" id="job_name" placeholder="Job Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select class="form-control lct" name="provinsi" id="provinsi">
                                    <option value="0">--Pilih Provinsi--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kkota">Kota</label>
                                <select class="form-control" name="kota" id="kota" disabled>
                                    <option value="0">--Pilih Kota--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Addreas</label>
                        <textarea class="form-control" name="addreas" id="addreas" rows="3" disabled></textarea>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" id="btnSave">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailJob" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Jobs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jobName">Job Name :</label>
                            <p id="d_jobName"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price :</label>
                            <p id="d_price"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description :</label>
                    <p id="d_description"></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="provinsi">Provinsi :</label>
                            <p id="d_provinsi"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kota">Kota :</label>
                            <p id="d_kota"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Addreas :</label>
                    <p id="d_addreas"></p>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="modal-footer" id="d_fot">
                            <!-- <a href="javascript:void(0);" onclick="editJob();" class="btn btn-warning text-white"><i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" onclick="deleteJob();" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editJob" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Jobs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="javascript:void(0);" method="post" id="formEditJob">
                <input type="hidden" name="id" id="e_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jobName">Job Name</label>
                                <input type="text" name="job_name" class="form-control" id="e_jobName" placeholder="Job Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" name="price" class="form-control" id="e_price" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea class="form-control" name="description" id="e_description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select class="form-control lct" onchange="getKota(this.value,'','#e_kota')" name="provinsi" id="e_provinsi">
                                    <option value="0">--Pilih Provinsi--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <select class="form-control" name="kota" id="e_kota">
                                    <option value="0">--Pilih Kota--</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Addreas</label>
                        <textarea class="form-control" name="addreas" id="e_addreas" rows="3"></textarea>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary" id="btnUbah">Ubah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

