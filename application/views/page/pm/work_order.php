<style>
	/* Variables */
	/* Fonts */


	/* Layout */
	* {
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
		box-sizing: border-box;
	}

	/* Styling */
	.timeline {
		position: relative;
		max-width: 46em;
	}
	.timeline:before {
		background-color: #eeeeee;
		content: '';
		margin-left: -1px;
		position: absolute;
		top: 0;
		left: 2em;
		width: 2px;
		height: 100%;
	}

	.timeline-event {
		position: relative;
	}
	.timeline-event:hover .timeline-event-icon {
		-moz-transform: rotate(-45deg);
		-ms-transform: rotate(-45deg);
		-webkit-transform: rotate(-45deg);
		transform: rotate(-45deg);
		background-color: tomato;
	}
	.timeline-event:hover .timeline-event-thumbnail {
		-moz-box-shadow: inset 40em 0 0 0 tomato;
		-webkit-box-shadow: inset 40em 0 0 0 tomato;
		box-shadow: inset 40em 0 0 0 tomato;
	}

	.timeline-event-copy {
		padding: 2em;
		position: relative;
		top: -1.875em;
		left: 4em;
		width: 80%;
	}
	.timeline-event-copy h3 {
		font-size: 1.75em;
	}
	.timeline-event-copy h4 {
		font-size: 1.2em;
		margin-bottom: 1.2em;
	}
	.timeline-event-copy strong {
		font-weight: 700;
	}
	.timeline-event-copy p:not(.timeline-event-thumbnail) {
		padding-bottom: 1.2em;
	}

	.timeline-event-icon {
		-moz-transition: -moz-transform 0.2s ease-in;
		-o-transition: -o-transform 0.2s ease-in;
		-webkit-transition: -webkit-transform 0.2s ease-in;
		transition: transform 0.2s ease-in;
		border-radius: 50%;
		background-color: #cccccc;
		outline: 10px solid white;
		display: block;
		margin: 0.5em 0.5em 0.5em -0.5em;
		position: absolute;
		top: 0;
		left: 2em;  
		width: 1em;
		height: 1em;
	}

	.timeline-event-thumbnail {
		-moz-transition: box-shadow 0.5s ease-in 0.1s;
		-o-transition: box-shadow 0.5s ease-in 0.1s;
		-webkit-transition: box-shadow 0.5s ease-in;
		transition: box-shadow 0.5s ease-in 0.1s;
		color: white;
		font-size: 0.75em;
		background-color: black;
		-moz-box-shadow: inset 0 0 0 0em #ef795a;
		-webkit-box-shadow: inset 0 0 0 0em #ef795a;
		box-shadow: inset 0 0 0 0em #ef795a;
		display: inline-block;
		margin-bottom: 1.2em;
		padding: 0.25em 1em 0.2em 1em;
	}

	ul{
		list-style: none;
	}

	.tm{
		transition: all 2s linear;
		display: block;
	}

	.hidden {
		transition: all 2s linear;
		display: none;
	}

</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 table-responsive">
							<table class="table table-bordered" id="table">
								<thead class="bg-dark">
									<tr>
										<th>No</th>
										<th>Project</th>
										<th>Status</th>
										<th>Devision</th>
										<th>By</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody>
                        	</tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</section>

<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="javascript:void(0)" method="post" id="editPM">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4 col">
						<label for="">Service</label>
					</div>
					<div class="col-md-6 col">
						<textarea name="service"  id="service" class="form-control" disabled>Pengadaan bla bla bla</textarea>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col">
						<label for="">Qty</label>
					</div>
					<div class="col-md-2 col">
						<input type="text" name="qty" id="qty" disabled class="form-control" value="600">
						<input type="hidden" name="pk_id" id="pk_id"  class="form-control">
						<input type="hidden" name="pm_id" id="pm_id"  class="form-control">
					</div>
					<div class="col-md-4"><label for="">Titik</label></div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col">
						<label for="">PO</label>
					</div>
					<div class="col-md-6 col">
						<div id="po"><a href="" class="btn btn-outline-danger btn-sm" id="po" style="width: 100%;">View</a></div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col">
						<label for="">PM</label>
					</div>
					<div class="col-md-6 col">
						<select name="pm" class="custom-select" id="pm">
							<option value="1">Ade Putra</option>
							<option value="2">Aldie Oktavian</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col">
						<label for="">Project Plan</label>
					</div>
					<div class="col-md-6 col">
						<div id="pp"><a href="<?=site_url('pm/project_plan')?>" class="btn btn-outline-danger btn-sm" style="width: 100%;">View</a></div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col">
						<label for="">Status</label>
					</div>
					<div class="col-md-6 col">
						<select name="status" id="status" class="custom-select">
							<option value="1">Planning</option>
							<option value="2">Waiting for Approval</option>
							<option value="3">Approved</option>
							<option value="4">Not Approved</option>
						</select>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-4 col">
						<label for="">Remarks</label>
					</div>
					<div class="col-md-6 col">
						<textarea name="remark" id="remark" class="form-control"></textarea>
					</div>
				</div>
				<br>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Detail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-11 offset-md-1">
						<h5 style="color: tomato;">Basic Info</h5>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<label for="">Service</label>
					</div>
					<div class="col-md-8" id="g_service">-</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<label for="">Qty</label>
					</div>
					<div class="col-md-8"><span id="g_qty">0</span> Titik</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<label for="">PO</label>
					</div>
					<div class="col-md-8" id="g_po"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<label for="">PM</label>
					</div>
					<div class="col-md-8" id="g_pm">-</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3 offset-md-1">
						<label for="">Project Plan</label>
					</div>
					<div class="col-md-8" id="g_pp"></div>
				</div>
				<br>
                <div class="row">
					<div class="col-md-3 offset-md-1">
						<label for="">Remarks</label>
					</div>
					<div class="col-md-8" id="g_remarks">-</div>
				</div>
				<div class="row">
					<div class="col-md-4 offset-md-1">
						<label for="">Status</label>
					</div>
					<div class="col-md-11 offset-md-1">
						<ul class="timeline" id="tml">
                        
						</ul> 
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

