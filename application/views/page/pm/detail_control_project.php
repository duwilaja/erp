<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
                <div class="card-header">
                    <div class="row">
                        <div>
                            Detail Control Project
                        </div>
                        <div class="ml-auto">
                            <a href="<?=site_url('PM/control_project')?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                </div>
				<div class="card-body">
                    <div class="row font-weight-light">
                        <div class="col-md-2">Nama Projek</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto"><?= $projek->service?></div>
                    </div>
                    <div class="row font-weight-light">
                        <div class="col-md-2">No Kontrak</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto"><?= $projek->no_kontrak?></div>
                    </div>
                    <div class="row font-weight-light">
                        <div class="col-md-2">Tanggal Kontrak</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto"><?= $projek->tgl_kontrak?></div>
                    </div>
                    <div class="row font-weight-light">
                        <div class="col-md-2">Tanggal Mulai</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto"><?= $projek->start_date?></div>
                    </div>
                    <div class="row font-weight-light">
                        <div class="col-md-2">Tanggal Akhir</div>
                        <div class="col-auto">:</div>
                        <div class="col-auto"><?= $projek->end_date?></div>
                    </div>
                    <table class="table table-bordered mt-2" id="tabel">
                        <thead class="bg-dark">
                            <tr>
                                <th>No</th>
                                <th>Kendala</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>