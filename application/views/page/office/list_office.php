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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">List Office <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="<?=site_url('office/add_office')?>" class="btn btn-info">Add Office</a>
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
