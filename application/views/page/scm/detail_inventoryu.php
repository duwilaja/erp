<style>
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #E91E63;
    background-color: #FFF;
    border-radius: 20px;
    border: solid 1px #E91E63;
}

.nav-pills .nav-link:not(.active):hover {
    color: #E91E63;
}

.ths{
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}

</style>
<section class="content">
<?php $id_req = $this->input->get('id_req');?>
<input type="hidden" name="" id="id_req" value="<?= $id_req;?>">
    <div class="row">
        <div class="ml-auto mb-3 mr-3">
            <a href="<?= site_url('scm/inventoryu');?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
	<div class="row" id="d_inventory">
		
	</div>
	<!-- /.row -->
</section>

