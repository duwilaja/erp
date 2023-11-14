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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">List Member Employes <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="#" class="btn btn-info">Add Member Employes</a>
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
