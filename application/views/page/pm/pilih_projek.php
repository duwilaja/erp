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
							<table class="table table-bordered" id="tabel">
								<thead class="bg-dark">
									<tr>
										<th>No</th>
										<th>Project</th>
										<th>Customers</th>
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