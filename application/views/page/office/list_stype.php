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
                    <h3 class="card-title" style="position: relative;top: 10px;">List Staff Type <span id="txtLE"></span></h3>
                    <div class="azsa" style="float: right;">
                        <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-danger" onclick="nyu();">Add Type</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>Code</td>
                                <td>Name</td>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Staff Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" id="exampleForm">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Code</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="code">
                        </div>
					</div>
					<div class="row">
                        <div class="col-md-4">
                            <label>Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name">
                        </div>
					</div>
                    <div class="form-row">
                        <div class="col-md-12">
						<br />
                            <input type="hidden" name="id" value="0">
                            <input type="submit" class="btn btn-outline-danger" value="Save" style="width:100%">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
