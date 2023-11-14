<style>
    .nma{
        font-size:14px;
        margin-bottom:4px;
    }
</style>
<div class="card">
    <div class="card-header">
        Manage Device
    </div>
    <form action="javascript:void(0);" method="post" id="form_manage_device">
    <div class="card-body">
    <div class="keterangan">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">Device</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-3"><span id="tdevice">-</span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">SN</div>
                        <div class="col-md-1">:</div>
                        <div class="col-md-3"><span id="tsn">-</span></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="form">
                            
                            <div class="form-group">
                            <input type="hidden" name="device_id" id="device_id" value="<?=$this->input->get('id')?>">
                                <!-- <div class="nma">You can Edit/Replace/RMA device</div> -->
                                <!-- <select class="form-control form-control-sm" name="pilih" id="pilih" onchange="select_action(this.value)">
                                    <option value="edit">Edit</option>
                                    <option value="replace">Replace</option>
                                    <option value="rma">RMA</option>
                                </select> -->
                                <input type="hidden" name="pilih" value="edit">
                            </div>

                            <input type="hidden" name="sn_old" id="sn_old">
                            <input type="hidden" name="sn_new" id="sn_new">
                            <input type="hidden" name="pk_id" id="pk_id">

                            <div class="form-group">
                                <div class="nma">Condition Device Now : <b id="tisn">-</b></div>
                                <select class="form-control form-control-sm" name="status" id="status">
                                    <option value=""> -- Select Condition --</option>
                                    <option value="baik">Baik</option>
                                    <option value="rusak">Rusak</option>
                                </select>
                            </div>

                            <div class="form-group" id="rsl"> </div>

                            <div class="form-group">
                                <div class="nma">Description</div>
                                <textarea class="form-control form-control-sm" name="ket" id="ket" placeholder="Fill this description"></textarea>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="#" onclick="return window.history.back();" class="btn btn-default">Back</a>
        <a href="<?=site_url('SCM/h_device?dv_id='.$this->input->get('id'))?>" class="btn btn-default">History Device</a>
        <input class="btn btn-success float-right" type="submit" value="Save">
    </div>
    </form>
</div>