<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>Add KPI</b>
                </div>
                <form action="<?=site_url('kpi/inKpi')?>" id="formKPI" method="post">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-1">
                                <span style="position: relative;top: 8px;font-weight: bold;">Position </span>
                            </div>
                            <div class="col-md-6">
                                <select name="jabatan" onchange="pilihKPIJabatan(this)"  class=form-control>
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
                                    <th><button type="button" class="btn btn-secondary btn-sm w-100" onclick="add()">Add</button></th>
                                </thead>
                                <?php 
                                if ($val['kpiJabatan']) {
                                foreach (@$val['kpiJabatan'] as $v) { ?>
                                <tr class="tsx">
                                    <td><input type="hidden" name="id[]" value="<?=$v->id;?>"><input class="form-control" name="up_pg[]" placeholder="Performance Goal" value="<?=$v->pg;?>"></td>
                                    <td><input class="form-control" name="up_weight[]" placeholder="Weight" value="<?=$v->weight;?>"></td>
                                    <td><input class="form-control" name="up_kpi[]" placeholder="KPI" value="<?=$v->kpi;?>"></td>
                                    <td><input class="form-control" name="up_target[]" placeholder="Target" value="<?=$v->target;?>" ></td>
                                    <td><button type="button" class="btn btn-warning btn-sm w-100" disabled>-</button></td>
                                    <!-- <td><a href="<?=site_url('kpi/deKpi/'.$v->id)?>" onclick="return confirm('Are you sure to remove this data ?')"><button type="button" class="btn btn-warning btn-sm w-100">Hapus</button></a></td> -->
                                </tr>
                                <?php } } ?>
                                <tr class="ts">
                                    <td><input class="form-control" name="pg[]" placeholder="Performance Goal"></td>
                                    <td><input class="form-control" name="weight[]" placeholder="Weight"></td>
                                    <td><input class="form-control" name="kpi[]" placeholder="KPI"></td>
                                    <td><input class="form-control" name="target[]" placeholder="Target"></td>
                                    <td><button type="button" class="btn btn-warning btn-sm w-100" disabled>-</button></td>
                                </tr>

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

    <script>
        function pilihKPIJabatan(v) {
            window.location.assign('<?=site_url("kpi/add_kpi/");?>'+v.value);
        }
    </script>