<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Master Pricing
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="hardware-tab" data-toggle="tab" href="#hardware" role="tab" aria-controls="hardware" aria-selected="true">Hardware</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="warranty-tab" data-toggle="tab" href="#warranty" role="tab" aria-controls="warranty" aria-selected="false">Warranty</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="setup-tab" data-toggle="tab" href="#setup" role="tab" aria-controls="setup" aria-selected="false">Set Up & Implementasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="service-tab" data-toggle="tab" href="#service" role="tab" aria-controls="sevice" aria-selected="false">Managed Service</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="hardware" role="tabpanel" aria-labelledby="hardware-tab">
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" data-toggle="modal" data-target="#newHardware" class="btn btn-outline-danger btn-sm">Add New</a>
                                    <p></p>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Type</th>
                                                <th>Cost/unit</th>
                                                <th>Modal</th>
                                                <th style="width: 100px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>HSG-100</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#editHardware" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- new hardware Modal -->
                                <div class="modal fade" id="newHardware" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Hardware</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Type</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="type" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Unit/Cost</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="unit" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Modal</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="modal" class="form-control">
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

                                <!-- edit hardware Modal -->
                                <div class="modal fade" id="editHardware" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Hardware</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Type</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eType" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Unit/Cost</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eUnit" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Modal</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eModal" class="form-control">
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
                            </div>
                        </div>

                        <div class="tab-pane fade" id="warranty" role="tabpanel" aria-labelledby="warranty-tab">
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" data-toggle="modal" data-target="#newWarranty" class="btn btn-outline-danger btn-sm">Add New</a>
                                    <p></p>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Type</th>
                                                <th>Cost/unit</th>
                                                <th>Modal</th>
                                                <th style="width: 100px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>HSG-100</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#editWarranty" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- new Warranty Modal -->
                                <div class="modal fade" id="newWarranty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Warranty</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Type</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="typeW" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Unit/Cost</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="unitW" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Modal</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="modalW" class="form-control">
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

                                <!-- edit Warranty Modal -->
                                <div class="modal fade" id="editWarranty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Warranty</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Type</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eTypeW" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Unit/Cost</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eUnitW" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Modal</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eModalW" class="form-control">
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
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="setup" role="tabpanel" aria-labelledby="setup-tab">
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" data-toggle="modal" data-target="#newSetup" class="btn btn-outline-danger btn-sm">Add New</a>
                                    <p></p>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Cost/unit</th>
                                                <th>Modal</th>
                                                <th style="width: 100px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>HSG-100</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#editSetup" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- new Warranty Modal -->
                                <div class="modal fade" id="newSetup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Setup & Implementasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Pointer</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="pointerS" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Unit/Cost</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="unitS" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Modal</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="modalS" class="form-control">
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

                                <!-- edit Setup Modal -->
                                <div class="modal fade" id="editSetup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Setup & Implementation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Pointer</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="ePointerS" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Unit/Cost</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eUnitS" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Modal</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eModalS" class="form-control">
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
                            </div>
                        </div>
                        <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="service-tab">
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <a href="#" data-toggle="modal" data-target="#newManaged" class="btn btn-outline-danger btn-sm">Add New</a>
                                    <p></p>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Description</th>
                                                <th>Cost/unit</th>
                                                <th>Modal</th>
                                                <th style="width: 100px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>HSG-100</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#editManaged" class="btn btn-success btn-sm"><i class="far fa-edit"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- new Warranty Modal -->
                                <div class="modal fade" id="newManaged" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">New Setup & Implementasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Description</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="descM" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Unit/Cost</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="unitM" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Modal</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="modalM" class="form-control">
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

                                <!-- edit Setup Modal -->
                                <div class="modal fade" id="editManaged" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Setup & Implementation</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Description</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eDescM" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Unit/Cost</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eUnitM" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-5"><label for="">Modal</label></div>
                                                        <div class="col-md-7">
                                                            <input type="text" name="eModalM" class="form-control">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>