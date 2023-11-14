<style>
    .lbl{
        font-size: 14px;
        padding: 0 8px;
        color: #FFF;
        border-radius: 4px;
    }
    .lbl-warning {
        background: #fd7e14;
    }

    .lbl-success {
        background: #28a745;
    }
    
    .lbl-danger {
        background: #dc3545;
    }
    .lbl-primary {
        background: #1a8cff;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">Daftar Pengajuan <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="<?=site_url('SCM/pengajuan_peminjaman_mobil_all')?>" class="btn btn-warning">Cek Semua Data Pengajuan</a>
                        <a href="<?=site_url('SCM/form_pengajuan_mobil')?>" class="btn btn-info">Tambah Pengajuan</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" >
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Mobil Pengajuan</td>
                                <td>Nama Pengajuan</td>
                                <td>Tanggal Pengajuan</td>
                                <td>Tanggal Awal Pemakaian</td>
                                <td>Tanggal Selesai Pemakaian</td>
                                <td>Status Pengajuan</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
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
<?php
foreach($get_extend->result() as $i):
            $pnjm_id= $i->pnjm_id;
            $pnjm_mobil_id= $i->pnjm_mobil_id;
            $tmp=  $i->tmp;
            $tsp=  $i->tsp;
            $get_extend=  $i->extend;
?>
<div class="modal fade" id="modal_extend<?php echo $pnjm_id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengajuan Extend</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'SCM/extend'?>">
                <div class="modal-body">
                <div class="form-group">
                        <label class="control-label col-xs-3" >Extend Waktu Pemakaian</label>
                        <div class="col-xs-8">
                            <input name="pnjm_id" value="<?php echo $pnjm_id;?>" class="form-control" type="hidden" placeholder="" readonly>
                            <input name="pnjm_mobil_id" value="<?php echo $pnjm_mobil_id;?>" class="form-control" type="hidden" placeholder="" readonly>
                            <input name="get_extend" value="<?php echo $get_extend;?>" class="form-control" type="hidden" placeholder="" >
                            <input name="extend" value="<?php echo $get_extend;?>" class="form-control" type="text" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Waktu Mulai Pemakaian</label>
                        <div class="col-xs-8">
                            <input name="tmp" value="<?php echo $tmp;?>" class="form-control" type="text" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Waktu Selesai Pemakaian</label>
                        <div class="col-xs-8">
                            <input name="tsp" value="<?php echo $tsp;?>" class="form-control" type="text" placeholder="" readonly>
                        </div>
                    </div>
                    <?php
                    if ($get_extend != '') {
                        ?>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Waktu Extend Pemakaian</label>
                                <div class="col-xs-8">
                                    <input value="<?php echo $get_extend;?>" class="form-control" type="text" placeholder="" readonly>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Submit</button>
                </div>
            </form>
            </div>
            </div>
        </div>
<?php endforeach;?>



