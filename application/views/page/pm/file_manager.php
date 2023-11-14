<style>
	.font-100 {
		font-size: 100px;
	}

	.op02 {
		opacity: 0.2;
	}

	.a{
      text-decoration: none;
      color: inherit;
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
</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					File Manager
				</div>
				<div class="card-body">
					<div class="row">
						<div class="container">
						<div class="row">
							<div class="col-md-2 col-sm-auto mb-2">
								<select name="" onchange="projek(this.value);" id="pjk" class="form-control">
									<option value="">All Projek</option>
								</select>
							</div>
							<div class="col-md-2 col-sm-auto mb-2">
								<select name="" onchange="projek(this.value);" id="ktg" class="form-control">
									<option value="">Kategori</option>
									<option value="docx">.docx</option>
									<option value="pdf">.pdf</option>
									<option value="jpg">.jpg</option>
									<option value="png">.png</option>
									<option value="xlsx">.xlsx</option>
								</select>
							</div>
							<div class="col-sm-auto ml-auto">
							<input type="text" class="form-control" onchange="projek(this.value);" placeholder="Cari..." id="search">
							</div>
						</div>
							<hr>
							<div class="my-3">
								<div class="row" id="card">
									
								</div>
								<div id="load_data_message"></div>
							</div>
						</div>
					</div>
                </div>
            </div>

        </div>
    </div>
</div>
</section>


