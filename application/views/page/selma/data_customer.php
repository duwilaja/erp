<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Data Master Customer
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-danger">Add New</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabelC">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer</th>
                                <th>Last Update</th>
                                <th>Update By</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" id="formCustomer">
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Customer Name</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="text" class="form-control" name="customer">
                        </div>
                        <br>
                        <div class="col-md-12 text-right">
                            <br>
                            <input type="submit" class="btn btn-outline-danger" value="Add" style="width:100%">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editCust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" id="formEdtCustomer">
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Customer Name</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="hidden" class="form-control" name="e_id">
                            <input type="text" class="form-control" name="e_customer">
                        </div>
                        <br>
                        <div class="col-md-12 text-right">
                            <br>
                            <input type="submit" class="btn btn-outline-danger" value="Save" style="width:100%">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>