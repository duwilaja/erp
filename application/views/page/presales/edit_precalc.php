<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="color: tomato;"><strong>Basic Info</strong></h5>
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">ID</label>
                                </div>
                                <div class="col-md-3">M001</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Customer</label>
                                </div>
                                <div class="col-md-3">Telkom</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">End Customer</label>
                                </div>
                                <div class="col-md-3">Pertamina</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Sales</label>
                                </div>
                                <div class="col-md-3">Ferly Febriyani</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="">Presales</label>
                                </div>
                                <div class="col-md-3">Kurnia Hadi</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="sizing-tab" data-toggle="tab" href="#sizing" role="tab" aria-controls="sizing" aria-selected="true">Sizing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="opex-tab" data-toggle="tab" href="#opex" role="tab" aria-controls="opex" aria-selected="false">Precalc OPEX</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="capex-tab" data-toggle="tab" href="#capex" role="tab" aria-controls="capex" aria-selected="false">Precalc CAPEX</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="sizing" role="tabpanel" aria-labelledby="sizing-tab">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <a href="" class="btn btn-danger btn-sm">Download</a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a href="">
                                                <i class="fas fa-file-alt" style="font-size: 60px;"></i><br>
                                                file.pdf
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <div class="tab-pane fade" id="opex" role="tabpanel" aria-labelledby="opex-tab">
                                    <form action="">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 style="color: tomato;"><strong>Biaya Hardware (OTC)</strong></h5>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th style="min-width: 300px;">Description</th>
                                                            <th style="min-width: 150px;">Type</th>
                                                            <th>QTY</th>
                                                            <th>Unit</th>
                                                            <th>Duration</th>
                                                            <th>Year</th>
                                                            <th style="min-width: 150px;">Cost/Unit</th>
                                                            <th style="min-width: 200px;">Total Cost</th>
                                                            <th style="min-width: 150px;">Modal</th>
                                                            <th style="min-width: 150px;">Kurs</th>
                                                            <th style="min-width: 150px;">Total Modal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <th>Biaya Pembelian Hardware</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th><input type="text" class="form-control" id="kurss" value="0"></th>
                                                            <th></th>
                                                        </tr>
                                                        <tr id="hw1">
                                                            <td>1</td>
                                                            <td>Perangkat HSG</td>
                                                            <td>
                                                                <select name="hardw" id="hard1" class="custom-select" onclick="hit('hard1', 'qty1', 'cu1', 'tc1', 'mod1', 'kurss1', 'totm1')">
                                                                    <option value="0">hw 1</option>
                                                                    <option value="1">hw 2</option>
                                                                </select>
                                                            </td>
                                                            <td id="qty1"></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td id="cu1"></td>
                                                            <td id="tc1"></td>
                                                            <td id="mod1">sesuai hw yg dipilih</td>
                                                            <td id="kurss1">modal x kurs</td>
                                                            <td id="totm1">modal x kurs x qty</td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="text-align: center;">
                                                                <button id="btnhw" type="button" class="btn btn-success btn-sm">Add</button>
                                                                <button id="delhw" type="button" class="btn btn-danger btn-sm">Del</button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>A</th>
                                                            <th></td>Sub total hardware</th>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <th>Sum total hardware</th>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <th>Biaya Pembelian Warranty</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                        <tr id="war1">
                                                            <td>1</td>
                                                            <td>Perangkat HSG</td>
                                                            <td>
                                                                <select name="hardw" id="hard1" class="custom-select" onclick="hit('hard1', 'qty1', 'cu1', 'tc1', 'mod1', 'kurss1', 'totm1')">
                                                                    <option value="0">hw 1</option>
                                                                    <option value="1">hw 2</option>
                                                                </select>
                                                            </td>
                                                            <td id="qty1"></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td id="cu1"></td>
                                                            <td id="tc1"></td>
                                                            <td id="mod1">sesuai hw yg dipilih</td>
                                                            <td id="kurss1">modal x kurs</td>
                                                            <td id="totm1">modal x kurs x qty</td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="text-align: center;">
                                                                <button id="btnwar" type="button" class="btn btn-success btn-sm">Add</button>
                                                                <button id="delwar" type="button" class="btn btn-danger btn-sm">Del</button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>B</th>
                                                            <th></td>Sub total Warranty</th>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <th>Sum total Warranty</th>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Sum Total Modal</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <h5 style="color: tomato;"><strong>Biaya Set Up & Implementasi (OTC)</strong></h5>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th style="min-width: 150px;">Pointer</th>
                                                            <th style="min-width:150px">Type</th>
                                                            <th>QTY</th>
                                                            <th>Unit</th>
                                                            <th style="min-width:150px">Cost/Unit</th>
                                                            <th style="min-width:150px">Total Cost</th>
                                                            <th style="min-width:150px">Modal</th>
                                                            <th style="min-width:150px">Kurs</th>
                                                            <th style="min-width:150px">Total Modal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="si1">
                                                            <td>1</td>
                                                            <td>Project Management Cost</td>
                                                            <td>
                                                                <select name="" id="" class="custom-select">
                                                                    <option value="">tes</option>
                                                                </select>
                                                            </td>
                                                            <td>1</td>
                                                            <td>Unit</td>
                                                            <td>Sesuai Hardware yg di pilih</td>
                                                            <td>QTY x unit/cost</td>
                                                            <td>sesuai hardware yg di pilih</td>
                                                            <td>modal x kurs</td>
                                                            <td>(moda x kurs) x qty</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="text-align: center;">
                                                                <button id="siadd" type="button" class="btn btn-success btn-sm">Add</button>
                                                                <button id="sidel" type="button" class="btn btn-danger btn-sm">Del</button>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>C</th>
                                                            <th></td>Sub total Set Up</th>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <th>Sum total setup</th>
                                                            <td>Sum total modal</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row mt-3">
                                            <div style="margin-left: 10px;" class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    <strong>MRC</strong>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-md-12">
                                                <h5 style="color: tomato;"><strong>Biaya Managed Service (Monthly)</strong></h5>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th style="min-width: 150px;">Description</th>
                                                            <th style="min-width: 150px;">Sub Description</th>
                                                            <th>Qty</th>
                                                            <th>Unit</th>
                                                            <th style="min-width: 10px;">Duration</th>
                                                            <th>Month</th>
                                                            <th style="min-width: 150px;">Cost/Unit</th>
                                                            <th style="min-width: 150px;">Total Cost</th>
                                                            <th style="min-width: 150px;">Modal</th>
                                                            <th style="min-width: 150px;">Kurs</th>
                                                            <th style="min-width: 150px;">Total Modal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="ms1">
                                                            <td>1</td>
                                                            <td>PM Cost</td>
                                                            <td></td>
                                                            <td>1</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Sesuai Hardware</td>
                                                            <td>QTY x unit/cost</td>
                                                            <td>sesuai Hardware</td>
                                                            <td>Modal x Kurs</td>
                                                            <td>modal x kurs x qty</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="text-align: center;">
                                                                <button id="msadd" type="button" class="btn btn-success btn-sm">Add</button>
                                                                <button id="msdel" type="button" class="btn btn-danger btn-sm">Del</button>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th>D</th>
                                                            <th></td>Sub total Managed Service
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <th>Sum total setup</th>
                                                                <td>Sum total modal</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <h5 style="color: tomato;"><strong>Summary</strong></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Description</th>
                                                                <th>Total Cost</th>
                                                                <th>Note</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <h5 style="color: tomato;"><strong>Budget Internal</strong></h5>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Pointer</th>
                                                                <th>Cost</th>
                                                                <th>Total Cost</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Sub Total Hardware</td>
                                                                <td>total harga modal</td>
                                                                <td>total harga modal</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Sub Total Warranty</td>
                                                                <td>total harga modal</td>
                                                                <td>total harga modal</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Sub Total Set Up</td>
                                                                <td>total harga modal</td>
                                                                <td>total harga modal</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Sub Total Managed Service</td>
                                                                <td>total harga modal</td>
                                                                <td>total harga modal</td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <th>Total</th>
                                                                <td></td>
                                                                <th>SUM</th>
                                                            </tr>
                                                            <tr style="background-color: #f5f5f5;">
                                                                <td><br></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>COM</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Overhead</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Bussiness Risk</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>CE</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>5</td>
                                                                <td>PPH 23</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>6</td>
                                                                <td>Administrasi Cost & Overhead Project</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>7</td>
                                                                <td>Marketing</td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <th>Total</th>
                                                                <td></td>
                                                                <th>Sum</th>
                                                            </tr>
                                                            <tr style="background-color: #f5f5f5;">
                                                                <td><br></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th>Total Cost Internal</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th>Margin Bersih</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th>Presetase Margin Denagah Harga Jual</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                            <tr>
                                                                <th></th>
                                                                <th>Presetase Margin Denagah Harga Modal</th>
                                                                <th></th>
                                                                <th></th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row ">
                                                <div class="col-md-12">
                                                    <h5 style="color: tomato;"><strong>Term and Condition</strong></h5>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea name="tnc" id="" rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <button type="submit" class="btn btn-danger">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="capex" role="tabpanel" aria-labelledby="capex-tab">...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        let x = 1;
        let y = 1;
        let z = 1;
        let a = 1;
        document.getElementById('btnhw').addEventListener('click', function(){
            if(x < 11){
                $('#hw'+x).after(`
                <tr id="hw${x+1}">
                    <td>${x+1}</td>
                    <td>Perangkat HSG</td>
                    <td>
                        <select name="hardw" id="hard${x+1}" class="custom-select" onclick="hit('hard${x+1}', 'qty${x+1}', 'cu${x+1}', 'tc${x+1}', 'mod${x+1}', 'kurss${x+1}', 'totm${x+1}')">
                            <option value="0">hw 1</option>
                            <option value="1">hw 2</option>
                        </select>
                    </td>
                    <td id="qty${x+1}"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="cu${x+1}"></td>
                    <td id="tc${x+1}"></td>
                    <td id="mod${x+1}">sesuai hw yg dipilih</td>
                    <td id="kurss${x+1}">modal x kurs</td>
                    <td id="totm${x+1}">modal x kurs x qty</td>
                </tr>`);
                x++;
            }
        });
        
        document.getElementById('delhw').addEventListener('click', function(){
            if(x > 1){
                $('#hw'+x).remove();
                x--;
            }
        });
        
        document.getElementById('btnwar').addEventListener('click', function(){
            if(y < 11){
                $('#war'+y).after(`
                <tr id="war${y+1}">
                    <td>${y+1}</td>
                    <td>Perangkat HSG</td>
                    <td>
                        <select name="hardw" id="hard${y+1}" class="custom-select" onclick="hit('hard${y+1}', 'qty${y+1}', 'cu${y+1}', 'tc${y+1}', 'mod${y+1}', 'kurss${y+1}', 'totm${y+1}')">
                            <option value="0">hw 1</option>
                            <option value="1">hw 2</option>
                        </select>
                    </td>
                    <td id="qty${y+1}"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id="cu${y+1}"></td>
                    <td id="tc${y+1}"></td>
                    <td id="mod${y+1}">sesuai hw yg dipilih</td>
                    <td id="kurss${y+1}">modal x kurs</td>
                    <td id="totm${y+1}">modal x kurs x qty</td>
                </tr>`);
                y++;
            }
        });
        
        document.getElementById('delwar').addEventListener('click', function(){
            if(y > 1){
                $('#war'+y).remove();
                y--;
            }
        });
        
        document.getElementById('siadd').addEventListener('click', function(){
            if(z < 10){
                $('#si'+z).after(`
                <tr id="si${z+1}">
                    <td>${z+1}</td>
                    <td>Project Management Cost</td>
                    <td>
                        <select name="" id="" class="custom-select">
                            <option value="">tes</option>
                        </select>
                    </td>
                    <td>1</td>
                    <td>Unit</td>
                    <td>Sesuai Hardware yg di pilih</td>
                    <td>QTY x unit/cost</td>
                    <td>sesuai hardware yg di pilih</td>
                    <td>modal x kurs</td>
                    <td>(moda x kurs) x qty</td>
                </tr>
                `);
                z++;
            }
        });
        
        document.getElementById('sidel').addEventListener('click', function(){
            if(z > 1){
                $('#si'+z).remove();
                z--;
            }
        });
        
        document.getElementById('msadd').addEventListener('click', function(){
            if(a < 10){
                $('#ms'+a).after(`
                <tr id="ms${a+1}">
                    <td>${a+1}</td>
                    <td>PM Cost</td>
                    <td></td>
                    <td>1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Sesuai Hardware</td>
                    <td>QTY x unit/cost</td>
                    <td>sesuai Hardware</td>
                    <td>Modal x Kurs</td>
                    <td>modal x kurs x qty</td>
                </tr>
                `);
                
                a++;
            }
        });
        
        document.getElementById('msdel').addEventListener('click', function(){
            if(a > 1){
                $('#ms'+a).remove();
                a--;
            }
        });
        //coba2
        let hws = [
        {
            name: 'hw1',
            cu : 5000,
            qty : 2,
            modal:4000
        },
        {
            name: 'hw2',
            cu : 3000,
            qty : 4,
            modal : 2000
        }
        ];
        
        
        function hit(pill, qty, cu, tc, mod, kurs, todm){
            let pilih = document.getElementById(pill);
            let vpil = pilih.options[pilih.selectedIndex].value;
            
            let qtyx = document.getElementById(qty);
            let cusx = document.getElementById(cu);
            let tcx = document.getElementById(tc);
            let modx = document.getElementById(mod);
            let kursx = document.getElementById(kurs);
            let totmx = document.getElementById(todm)
            let kurssx = document.getElementById('kurss').value;
            for(let i = 0; i < hws.length; i++){
                if(vpil == i){
                    
                    qtyx.innerHTML = hws[i].qty;
                    cusx.innerHTML = hws[i].cu;
                    tcx.innerHTML = hws[i].qty*hws[i].cu;
                    modx.innerHTML = hws[i].modal;
                    kursx.innerHTML = hws[i].modal * kurssx;
                    totmx.innerHTML = hws[i].modal * kurssx * hws[i].qty;
                }
            }
            
        }
        
        
    </script>