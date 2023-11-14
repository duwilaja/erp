<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-3 col-3">
                            <h3 class="card-title" >Detail : <strong> <?=$val['nama_karyawan'];?> </strong></h3>
                        </div>
                        <div class="col-md-2 col-4">
                            
                        </div>
                        <div class="col-md-7 col-5 text-right">
                           
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table id="tabel" class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Jobdesc</td>
                                <td>Performance Goal</td>
                                <td>Weight</td>
                                <td>Key Performance Indicator</td>
                                <td>Target</td>
                                <td>Realization</td>
                                <td>Score</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                                <?php foreach (@$val['kpiKaryawan'] as $v) { ?>
                                   <tr>
                                       <td><?=$v->nma_jabatan;?></td>
                                       <td><?=$v->pg;?></td>
                                       <td><?=$v->weight;?><input type="hidden" name="weight[]" id="weight" value="<?=$v->weight;?>"></td>
                                       <td><?=$v->kpi;?></td>
                                       <td><?=$v->target;?></td>
                                       <td><?=$v->realization;?></td>
                                       <td style="width:70px;"><input type="text" name="score-<?=$v->id;?>" onchange="changeScore('<?=$v->id;?>','<?=$v->score;?>','<?=$v->weight;?>','<?=$v->karyawan_id;?>')" class="form-control" value="<?=$v->score;?>"></td>
                                       <td><span id="txt-total-<?=$v->id;?>"><?=$v->total;?></span><input type="hidden" name="total[]" id="total"></td>
                                   </tr>
                                <?php } ?>
                            
                            <tr>
                                <td colspan="7">
                                    <strong>Total Score</strong>
                                </td>
                                <td>
                                    <strong><span id="total_all"><?=@$val['total_all'];?></span></strong>
                                </td>
                            </tr>

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
