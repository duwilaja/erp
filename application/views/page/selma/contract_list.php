<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Contract List
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>End Customer</th>
                                <th>Service</th>
                                <th>No. Contract</th>
                                <th>Period</th>
                                <th>Nominal</th>
                                <th style="min-width: 100px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>M001</td>
                                <td>Telkom</td>
                                <td>Pertamina</td>
                                <td>Pengadaan N3N</td>
                                <td>025/PO/II/2020</td>
                                <td>36 (tgl)</td>
                                <td>500.000.000</td>
                                <td>
                                    <a href="<?=site_url('selma/detail_contract')?>" class="btn btn-dark btn-sm"><i class="fas fa-info-circle"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- edit Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Contract</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" id="nav-con1">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#con1" role="tab" aria-controls="contract" aria-selected="true">Contract 1</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="con1" role="tabpanel" aria-labelledby="contract">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">ID</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="id[]" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">Customer</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="customer[]" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">End Customer</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="endcus[]" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">Service</label>
                                            </div>
                                            <div class="col-md-7">
                                                <textarea name="service[]" class="form-control" disabled></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">No. Contract</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="nocon[]" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">Period</label>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">Start</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="date" name="start[]" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">End</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="date" name="end[]" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">Nominal Contract</label>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" name="nominal[]" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="">Contract</label>
                                            </div>
                                            <div class="col-md-7">
                                                <a href="" class="btn btn-outline-danger btn-sm" style="width: 100%;">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row" style="padding-top: 20px;">
                            <br>
                            <div class="col-md-12 text-center">
                                <a href="#" id="add" class="btn btn-success btn-sm">Renual Contract</a>
                                <a href="#" id="del" class="btn btn-danger btn-sm"><i class="fas fa-backspace"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<script>
    var x = 1;
    
    document.getElementById('add').addEventListener('click', function(){
        if(x < 10){
            $('#nav-con'+x).after(`
            <li class="nav-item" id="nav-con${x+1}">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#con${x+1}" role="tab" aria-controls="contract" aria-selected="true">Contract ${x+1}</a>
            </li>`);
            
            $('#con'+x).after(`
            <div class="tab-pane fade" id="con${x+1}" role="tabpanel" aria-labelledby="contract">
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">ID</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="id[]" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Customer</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="customer[]" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">End Customer</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="endcus[]" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Service</label>
                    </div>
                    <div class="col-md-7">
                        <textarea name="service[]" class="form-control"></textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">No. Contract</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="nocon[]" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Period</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Start</label>
                    </div>
                    <div class="col-md-7">
                        <input type="date" name="start[]" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">End</label>
                    </div>
                    <div class="col-md-7">
                        <input type="date" name="end[]" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Nominal Contract</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" name="nominal[]" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-5">
                        <label for="">Contract</label>
                    </div>
                    <div class="col-md-7">
                        <input type="file" name="filecon[]" class="form-control">
                    </div>
                </div>
            </div>`);
            x++;
        }
    });

    document.getElementById('del').addEventListener('click', function(){
        if(x>1){
            $('#nav-con'+x).remove();
            $('#con'+x).remove();
            x--;
        }
    });
</script>