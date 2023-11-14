<input type="hidden" name="rahasia" id="rahasia" value="<?=$this->uri->segment(3);?>">
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <select name="jabatan" onchange="pilihKPIJabatan(this)"  class=form-control>
                                <?php foreach ($val['jabatan'] as $v) { ?>
                                    <option <?=$this->uri->segment(3) == $v->id ? 'selected' : ''?> value="<?=$v->id;?>"><?=$v->nma_jabatan;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-4 col-12">
                        </div>
                        <div class="col-md-5 col-5 text-right">
                            <div class="azsa">
                                <a href="<?=site_url('kpi/add_kpi')?>" class="btn btn-outline-danger">Add KPI</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table id="tabel1" class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <td>Performance Goal</td>
                                        <td>Weight</td>
                                        <td class="text-center">Key Performance Indicator<br>(KPI)</td>
                                        <td>Target</td>
                                    </tr>
                                </thead>
                               <tbody>
                                   <?php foreach (@$val['kpiJabatan'] as $v) { ?>
                                   <tr>
                                       <td><?=$v->pg;?></td>
                                       <td><?=$v->weight;?></td>
                                       <td><?=$v->kpi;?></td>
                                       <td><?=$v->target;?></td>
                                   </tr>
                                   <?php } ?>
                               </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title" style="position: relative;top: 10px;">List KPI : <?=@$val['textJabatan'];?></h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="azsa">
                                <a href="<?=site_url('kpi/add_kpi_employes')?>" class="btn btn-outline-danger">Add Employes KPI</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Jabatan</td>
                                <td>Total Score</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<script>
    function pilihKPIJabatan(v) {
        window.location.assign('<?=site_url("kpi/list_kpi/");?>'+v.value);
    }
</script>