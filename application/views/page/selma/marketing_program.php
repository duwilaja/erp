<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Marketing Program
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-danger btn-sm">Add new</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" id="tabelMarProg">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Program</th>
                                <th>Start</th>
                                <th>Until</th>
                                <th>Description</th>
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



<!-- add Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Marketing Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" id="addMarkProg" method="post">
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Program Title</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="text" name="title" class="form-control">
                        </div>
                        <br>
                   </div>
                    <br>
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Start</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <br>
                        
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Until</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Description</label>
                        </div>
                        <div class="col col-md-8">
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <br>
                        
                    </div>
                    <div class="col-md-12 text-right">
                        <br>
                        <input type="submit" class="btn btn-outline-danger" value="Add" style="width:100%">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Marketing Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" id="editMarkProg" method="post">
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Program Title</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="hidden" name="e_id" class="form-control">
                            <input type="text" name="e_title" class="form-control">
                        </div>
                        <br>
                   </div>
                    <br>
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Start</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="date" name="e_start_date" class="form-control">
                        </div>
                        <br>
                        
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Until</label>
                        </div>
                        <div class="col col-md-8">
                            <input type="date" name="e_end_date" class="form-control">
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col col-md-4">
                            <label>Description</label>
                        </div>
                        <div class="col col-md-8">
                            <textarea class="form-control" name="e_description"></textarea>
                        </div>
                        <br>
                        
                    </div>
                    <div class="col-md-12 text-right">
                        <br>
                        <input type="submit" class="btn btn-outline-danger" value="Edit" style="width:100%">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>