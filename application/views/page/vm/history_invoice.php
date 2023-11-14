<style>
    .r-8 {
        border-radius:8px;
    }
    ::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="background-color:#FCD4E4;">
                <div class="card-body">
                    <h3 class="text-red my-4 ml-4"><b>History Invoice</b></h3>
                    <form action="">
                        <div class="row ml-3">
                        <div class="col-md-8">
                            <div class="row">
                            <div class="col-md-3">
                                <h6><b>Start Date</b></h6>
                                <input type="date" name="" id="" class="form-control bg-purple r-8">
                            </div>
                            <div class="col-md-3">
                                <h6><b>End Date</b></h6>
                                <input type="date" name="" id="" class="form-control r-8" style="background-color:#B483CD; color:white;">
                            </div>
                            <div class="col-md-3">
                                <h6><b>Status</b></h6>
                                <select name="status" id="" class="form-control r-8" style="background-color:#F98D78; color:white;">
                                    <option value="1">Paid</option>
                                    <option value="2">Pending</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <br>
                                <button type="submit" class="btn btn-outline-primary r-8 mt-1"><i class="fa fa-search"></i> Filter</button>
                            </div>
                            </div>
                        </div>
                        <div style="margin-top:-50px;margin-left:120px;">
                                <i class="fas fa-mail-bulk text-white" style="font-size:120px;"></i>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            Data History Invoice Partner
                        </div>
                        <!-- <div class="col-md-6 text-right">
                            <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-outline-danger btn-sm">Add New</a>
                        </div> -->
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="tabelC">
                        <thead>
                            <tr>
                                <th>ID Partner</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>No. Invoice</th>
                                <th>Invoice Date</th>
                                <th>Nominal Invoice</th>
                                <th>Due Date</th>
                                <th>Invoice</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>PRT001</td>
                                <td>Personal Partner</td>
                                <td>PIC 1</td>
                                <td>Running project 1</td>
                                <td>Instalasi..</td>
                                <td>auto</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="" class="btn btn-outline-danger btn-sm">View</a></td>
                                <td>Paid</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" method="post" id="formCustomer">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <div class="row">
                                <div class="col-md-12"><h5 style="color: tomato;"><strong>Basic Info</strong></h5></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Cateogory</label></div>
                                <div class="col-md-7">
                                    <select name="category" id="cate" class="custom-select">
                                        <option value="personal">Personal Partner</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Name</label></div>
                                <div class="col-md-7">
                                    <select name="name" class="custom-select">
                                        <option value="pic1">PIC 1</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Service</label></div>
                                <div class="col-md-7">
                                    <select name="service" class="custom-select">
                                        <option value="pr1">Project Running 1</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Description</label></div>
                                <div class="col-md-7">
                                    <textarea name="desc" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <div class="row">
                                <div class="col-md-12"><h5 style="color: tomato;"><strong>Invoice</strong></h5></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">No Invoice</label></div>
                                <div class="col-md-7">
                                    <input type="text" name="noinv" class="form-control" disabled value="auto">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Invoice Date</label></div>
                                <div class="col-md-7">
                                    <input type="date" name="invdate" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Nominal Invoice</label></div>
                                <div class="col-md-7">
                                    <input type="date" name="nominalinv" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Due Date</label></div>
                                <div class="col-md-7">
                                    <input type="text" name="duedate" class="form-control" disabled value="auto setelah 14 hari">
                                </div>
                            </div>
                            <br>
                            <div class="row" id="invfile" style="display: none;">
                                <div class="col-md-5"><label for="">Invoice</label></div>
                                <div class="col-md-7">
                                    <input type="file" name="invoicefile" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12"><h5 style="color: tomato;"><strong>Payment</strong></h5></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">No Rekening</label></div>
                                <div class="col-md-7">
                                    <input type="text" name="norek" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5"><label for="">Pemilik Rekening</label></div>
                                <div class="col-md-7">
                                    <input type="text" name="an" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var e = document.querySelector('#cate');
    var f = document.querySelector('#invfile');
    document.querySelector('#cate').addEventListener('click', function(){
        var isi = e.options[e.selectedIndex].value;
        if(isi == 'other'){
            $('#invfile').show();
        }else{
            $('#invfile').hide();
        }
    });
</script>

<!-- detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <br>
                        <div class="row">
                            <div class="col-md-12"><h5 style="color: tomato;"><strong>Basic Info</strong></h5></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">ID Partner</label></div>
                            <div class="col-md-7">
                                PTR001
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Cateogory</label></div>
                            <div class="col-md-7">
                                Personal Partner
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Name</label></div>
                            <div class="col-md-7">
                                Guguk Warsono
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">ID Project</label></div>
                            <div class="col-md-7">
                                PRJ001
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Service</label></div>
                            <div class="col-md-7">
                                Project Running 1
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Description</label></div>
                            <div class="col-md-7">
                                Lalala
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <div class="row">
                            <div class="col-md-12"><h5 style="color: tomato;"><strong>Invoice</strong></h5></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">No Invoice</label></div>
                            <div class="col-md-7">
                                MMtv212
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Invoice Date</label></div>
                            <div class="col-md-7">
                                28 Januari 2020
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Nominal Invoice</label></div>
                            <div class="col-md-7">
                                1.500.000
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Due Date</label></div>
                            <div class="col-md-7">
                               14 Februari 2020
                            </div>
                        </div>
                        <br>
                        <div class="row" id="invfile">
                            <div class="col-md-5"><label for="">Invoice</label></div>
                            <div class="col-md-7">
                                <a href="" class="btn btn-outline-danger btn-sm">View</a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12"><h5 style="color: tomato;"><strong>Payment</strong></h5></div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">No Rekening</label></div>
                            <div class="col-md-7">
                                42348237489
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-5"><label for="">Pemilik Rekening</label></div>
                            <div class="col-md-7">
                                Guguk Warsono
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>