<section class="content">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="position: relative;top: 10px;">Project List</h3>
                    <div class="azsa" style="float: right;">
                        <select class="custom-select project" style="width: auto;" onchange="cekProject(this.value)">
                            <option value="1">Profitability Plan</option>
                            <option value="2">Project Archive</option>
                            <option value="3">Request Invoicing</option>
                        </select>
                        <a href="<?=site_url('project/profitability_plan')?>" id="addHref" class="btn btn-outline-info"><i class="fa fa-plus"></i><span class="pl-2">Add</span></a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tabel" class="table">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Project</td>
                                <td>Customer</td>
                                <td>Total Project</td>
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
