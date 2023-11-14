<style>
    .actv{
        background: #20c997;
        padding: 5px;
        font-size: 14px;
        border-radius: 4px;
        color: #FFF;
    }
    
    .non-actv{
        background: #d81b60;
        padding: 5px;
        font-size: 14px;
        border-radius: 4px;
        color: #FFF;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="info-box" style="cursor: pointer;" onclick="checkListEmployes(1,'Active')">
                <span class="info-box-icon bg-info"><i class="far fa-address-book"></i></span>
                
                <div class="info-box-content">
                    <span class="info-box-text">Employes Active</span>
                    <span class="info-box-number"><?=@$jmlActive;?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box" style="cursor: pointer;" onclick="checkListEmployes(0,'Non Active')">
                <span class="info-box-icon bg-danger"><i class="far fa-address-book"></i></span>
                
                <div class="info-box-content">
                    <span class="info-box-text">Employes Non Active</span>
                    <span class="info-box-number"><?=@$jmlNonActive;?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-12">
        <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-search"></i><span class="ml-1">Filter Data</span>
                </a>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card">
                    <form action="javascript:void(0);" method="post" id="filter_karyawan">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p>Jabatan/Posisi</p>
                                    <select name="f_jabatan" id="f_jabatan">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div style="float:right;">
                        <button type="reset" onclick="reset_form()" class="btn btn-warning">Reset</button>
                        <button type="submit" id="cari" class="btn btn-success" type="submit" >Cari</button>
                        <!-- <button type="submit" id="cari" class="btn btn-success" type="submit" onclick="lihatDt()">Cari</button> -->
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">List Employes <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="<?=site_url('main/tambah_karyawan')?>" class="btn btn-info">Add Employes</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>NIP</td>
                                <td>Name</td>
                                <td>Position</td>
                                <!-- <td>Grade</td> -->
                                <td>Action</td>
                            </tr>
                        </thead>
                        
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
