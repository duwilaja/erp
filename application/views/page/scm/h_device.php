<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">History Device - <a href="<?=site_url('SCM/form_device/'.$this->input->get('dv_id'))?>"> #<?=$this->input->get('dv_id');?> <span id="txtLE"></span></a></h3>
                </div>
                <input type="hidden" name="device_id" id="device_id" value="<?=$this->input->get('dv_id');?>">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Note</td>
                                <td>Date</td>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
