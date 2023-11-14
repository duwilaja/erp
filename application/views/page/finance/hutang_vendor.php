<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 col">Hutang Partner</div>
                        
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Partner</th>
                                <th>Name</th>
                                <th>ID Project</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>No. Invoice</th>
                                <th>Invoice Date</th>
                                <th>Due Date</th>
                                <th>Nominal Payment</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>HTG001</td>
                                <td>Gaguk WIharsono</td>
                                <td>M001</td>
                                <td>Pengadaan N3N</td>
                                <td>Instalasi N3N</td>
                                <td>00/00/0000</td>
                                <td></td>
                                <td></td>
                                <td>Unpaid</td>
                                <td style="width:9%">
                                    <a href="#" data-toggle="modal" data-target="#detailModal" class="btn btn-dark btn-sm"><i class="fas fa-info-circle" ></i></a>
                                    <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-danger btn-sm"><i class="far fa-edit"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Hutang Internal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6"><h5 style="color: tomato;">Basic Info</h5></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">ID Partner</label></div>
                                    <div class="col-md-7 col"><input name="id_partner" type="text" class="form-control" disabled></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Name</label></div>
                                    <div class="col-md-7 col"><input name="name" type="text" class="form-control" disabled></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">ID Project</label></div>
                                    <div class="col-md-7 col"><input name="id_project" type="text" class="form-control" disabled></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Service</label></div>
                                    <div class="col-md-7 col"><textarea name="service" class="form-control" disabled></textarea></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Description</label></div>
                                    <div class="col-md-7 col"><textarea name="desc" class="form-control" disabled></textarea></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">No.Invoice</label></div>
                                    <div class="col-md-7 col"><input name="no_invoice" type="text" class="form-control" disabled></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Invoice Date</label></div>
                                    <div class="col-md-7 col"><input name="invoice_date" type="date" class="form-control" disabled></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Due Date</label></div>
                                    <div class="col-md-7 col"><input name="due_date" type="date" class="form-control" disabled></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Invoice</label></div>
                                    <div class="col-md-7 col"><a href="" class="btn btn-outline-danger btn-sm" style="width: 100%;">View</a></div>
                                </div>
                                <br>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6"><h5 style="color: tomato;">Count</h5></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">No. Faktur Pajak</label></div>
                                    <div class="col-md-7 col"><input name="no_faktur" type="text" class="form-control"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">FP Date</label></div>
                                    <div class="col-md-7 col"><input name="fp_date" type="date" class="form-control"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Nilai Pokok</label></div>
                                    <div class="col-md-7 col"><input name="nilai_pokok" type="text" class="form-control"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID"></label></div>
                                    <div class="col-md-7 col">
                                        <div class="form-check form-check-inline">
                                            <input id="my-input" class="form-check-input" type="checkbox" name="ppn" value="true">
                                            <label for="my-input" class="form-check-label">PPN 10%</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">PPH</label></div>
                                    <div class="col-md-7 col">
                                        <select name="pph" class="custom-select">
                                            <option value="pph4">PPH 4 (10%)</option>
                                            <option value="pph23">PPH 23 (2%)</option>
                                            <option value="PPH26">PPH 26 (20%)</option>
                                            <option value="pph21">PPH 21 (2.5%)</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Nominal Payment</label></div>
                                    <div class="col-md-7 col"><input name="nominal_payment" type="text" class="form-control" value="hitung otomatis" disabled></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Status</label></div>
                                    <div class="col-md-7 col">
                                        <select name="status" id="" class="custom-select">
                                            <option value="unpaid">Unpaid</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Pay Date</label></div>
                                    <div class="col-md-7 col"><input name="pay_date" type="date" class="form-control"></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Bukti Pembayaran</label></div>
                                    <div class="col-md-7 col"><input name="bukti_pembayaran" type="file" class="form-control"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6"><h5 style="color: tomato;">Payment</h5></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">No. Rekening</label></div>
                                    <div class="col-md-7 col"><input name="norek" type="text" class="form-control" disabled></div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-5 col"><label for="ID">Pemilik Rekening</label></div>
                                    <div class="col-md-7 col"><input name="rekening_pemilik" type="text" class="form-control" disabled></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" value="Save">
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<!-- detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail HTG001</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6"><h5 style="color: tomato;">Basic Info</h5></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col"><label for="">ID</label></div>
                                <div class="col-md-6 col">HTG001</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col"><label for="">Name</label></div>
                                <div class="col-md-6 col">Gaguk Whardoyo</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col"><label for="">Description</label></div>
                                <div class="col-md-6 col">Installasi N3N</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col"><label for="">No.Invoice</label></div>
                                <div class="col-md-6 col">S20/01-007</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col"><label for="">Invoice Date</label></div>
                                <div class="col-md-6 col">15 Januari 2020</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col"><label for="">Due Date</label></div>
                                <div class="col-md-6 col">27 Januari 2020</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col"><label for="">Invoice</label></div>
                                <div class="col-md-6 col"><a href="" class="btn btn-outline-danger btn-sm" style="width: 100%;">View</a></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col"><label for="">Status</label></div>
                                <div class="col-md-6 col">Unpaid</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6"><h5 style="color: tomato;">Payment</h5></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">No. Rekening</label></div>
                                <div class="col-md-6 col">356386895</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">Pemilik Rekening</label></div>
                                <div class="col-md-6 col">Gaguk Wiharsono</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6"><h5 style="color: tomato;">Count</h5></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">No. Faktur Pajak</label></div>
                                <div class="col-md-6 col">-</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">FP Date</label></div>
                                <div class="col-md-6 col">-</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">Nilai Pokok</label></div>
                                <div class="col-md-6 col">1.050.000</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">PPN 10%</label></div>
                                <div class="col-md-6 col">-</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">PPH</label></div>
                                <div class="col-md-6 col">PPH 2.5% (Pasal 21)</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">Nominal Payment</label></div>
                                <div class="col-md-6 col">Nilai Pokok / PPH</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">Pay Date</label></div>
                                <div class="col-md-6 col">22 Jan 2020</div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 col"><label for="">Bukti Pembayaran</label></div>
                                <div class="col-md-6 col"><a href="" class="btn btn-outline-danger btn-sm" style="width: 100%;">View</a></div>
                            </div>
                            <br>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>