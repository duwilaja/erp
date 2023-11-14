<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>Add KPI Employes</b>
                </div>
                <form action="<?=site_url('kpi/inKpiEmployes')?>" id="formKPI" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                    <label>Employes</label>
                                    <select name="karyawan"  class=form-control>
                                    <option value=""></option>
                                    <?php foreach ($val['karyawan'] as $v) { ?>
                                        <option <?=$this->uri->segment(4) == $v->id ? 'selected' : ''?> value="<?=$v->id;?>"><?=$v->nama;?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                <label>Position</label>
                                <select name="jabatan"  class=form-control>
                                    <option value=""></option>
                                    <?php foreach ($val['jabatan'] as $v) { ?>
                                        <option <?=$this->uri->segment(3) == $v->id ? 'selected' : ''?> value="<?=$v->id;?>"><?=$v->nma_jabatan;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <table class="table table-bordered table-responsive" style="width:100%;display: table;border-top: solid 2px#343a40;margin-top: 6px;">
                                <thead>
                                    <th>Performance Goal</th>
                                    <th>Weight</th>
                                    <th>KPI</th>
                                    <th>Target</th>
                                </thead>
                                <tbody class="ts">

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-danger">Save</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </section>
