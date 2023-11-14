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
                    <h3 class="card-title" style="position: relative;top: 10px;">Daftar Persetujuan Peminjaman Mobil <span id="txtLE"></span></h3>
                    <!-- <div class="azsa" style="float: right;">
                        <a href="<?=site_url('SCM/form_vendor')?>" class="btn btn-info">Tambah Pengajuan</a>
                    </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Mobil Pengajuan</td>
                                <td>Nama Pengajuan</td>
                                <td>Keterangan Pengajuan</td>
                                <td>Waktu Pengajuan</td>
                                <td>Status Pengajuan</td>
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
foreach($get_change->result() as $i):
            $pnjm_id= $i->pnjm_id;
            $pnjm_mobil_id= $i->pnjm_mobil_id;
            $tmp=  $i->tmp;
            $tsp=  $i->tsp;
            $get_extend=  $i->extend;
?>
<div class="modal fade" id="modal_change<?php echo $pnjm_id;?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Kendaraan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <!-- new -->
            <form class="form-horizontal" method="post" action="<?php echo base_url().'SCM/change_kendaraan'?>">
                <input type="hidden" name="change_id" id="change_id" value="<?php echo $pnjm_id;?>">
                <input type="hidden" name="mobil_old" id="mobil_old" value="<?php echo $pnjm_mobil_id;?>">
                <div class="modal-body">
                <div class="form-group">
                        <label class="control-label col-xs-3" >Pilih Kendaraan</label>
                        <div class="col-xs-8">
                            <!-- <input name="change" value="<?php echo $pnjm_id;?>" class="form-control" type="text" placeholder="" required> -->
                            <select class="form-control" name="mobil_new" id="mobil_new">
                                <option value="">Change Kendaraan</option>
                            <?php
                                $q = $this->db->get('pnjm_mobil');
                                foreach ($q->result() as $value) {
                                    ?>
                                     <option value="<?= $value->pnjm_id_mobil;?>"><?= $value->pnjm_merek_mobil;?></option>
                                    <?php
                                }
                            ?>                          
                            </select>
                        </div>
                    </div>
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Submit</button>
                </div>
            </form>
            <!-- old -->
            <!-- <form class="form-horizontal" method="post" action="<?php echo base_url().'SCM/change_kendaraan'?>">
                <input type="hidden" name="old" id="old" value="<?php echo $pnjm_id;?>">
                <div class="modal-body">
                <div class="form-group">
                        <label class="control-label col-xs-3" >Pilih Kendaraan</label>
                        <div class="col-xs-8"> -->
                            <!-- <input name="change" value="<?php echo $pnjm_id;?>" class="form-control" type="text" placeholder="" required> -->
                            <!-- <select class="form-control" name="new" id="new">
                                <option value="">Change Kendaraan Dengan jadwal yang sama</option> -->
                            <?php
                            // if ($get_extend != '') {
                            //     $where = "tmp BETWEEN '$tmp' and '$get_extend' AND tsp BETWEEN '$tmp' and '$get_extend' AND status_pengajuan = 2 AND pnjm_mobil_id != '$pnjm_mobil_id'";
                            //     $this->db->select('pnjm_mobil_id,pnjm_id,');
                            //     $this->db->distinct();
                            //     $q = $this->db->get_where('pnjm_pengajuan',$where);
                            //     foreach ($q->result() as $value) {
                                    ?>
                                     <!-- <option value="<?= $value->pnjm_id;?>"><?= $this->db->get_where('pnjm_mobil',['pnjm_id_mobil' => $value->pnjm_mobil_id])->row()->pnjm_merek_mobil; ?></option> -->
                                    <?php
                                // }
                            // }else{
                            //     $where = "tmp BETWEEN '$tmp' and '$tsp' AND tsp BETWEEN '$tmp' and '$tsp' AND status_pengajuan = 2 AND pnjm_mobil_id != '$pnjm_mobil_id'";
                            //     $this->db->select('pnjm_mobil_id,pnjm_id');
                            //     $this->db->distinct();
                            //     $q = $this->db->get_where('pnjm_pengajuan',$where);
                            //     foreach ($q->result() as $value) {
                                    ?>
                                    <!-- <option value="<?= $value->pnjm_id;?>"><?= $this->db->get_where('pnjm_mobil',['pnjm_id_mobil' => $value->pnjm_mobil_id])->row()->pnjm_merek_mobil; ?></option> -->
                                   <?php
                            //     }

                            // }
                            ?>                          
                            <!-- </select>
                        </div>
                    </div>
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Submit</button>
                </div>
            </form> -->
            </div>
            </div>
        </div>
<?php endforeach;?>