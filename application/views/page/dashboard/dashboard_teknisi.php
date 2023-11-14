    <!-- Menu Level 4 / Teknisi--> 
    <?php if ($this->session->userdata('level') == '4') { ?>
        <div class="row">
            <div class="col-md-4 col-6" data-toggle="modal" data-target="#ModalTicket">
                <div class="mycard rounded">
                    <div class="card-body text-center">
                        <br>
                        <h4 style="color: tomato;"><i class="far fa-file"></i> <strong id="newtik"> 20</strong></h4>
                        <p class="pt">New Ticket</p>
                        <br>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-6" data-toggle="modal" data-target="#ModalTask">
                <div class="mycard rounded">
                    <div class="card-body text-center">
                        <br>
                        <h4 style="color: #2c7873">
                            <i class="fas fa-thumbtack"></i> <strong id="tota"> 20/30</strong>
                        </h4>
                        <p class="pt">Today Task</p>
                        <br>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-12">
                <div class="mycard rounded">
                    <div class="card-body text-center">
                        <br>
                        <a href="<?=site_url('oprations/preventive')?>">
                        <h4 style="color: #5f6caf;">
                            <i class="nav-icon fas fa-tools"></i> <strong id="prv"> 52</strong></h4>
                            <p class="pt">Preventive Maintenance <br> on Schedule</p>
                        </a>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
            
            <!-- Modal Ticket -->
            <div class="modal fade" id="ModalTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: tomato;"><i class="far fa-file"></i> New Tickets</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail</th>
                                        <th>Customer</th>
                                         <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody id="tiklist">
                                
                                </tbody>
                            </table>
                            <br>
                            <div class="row" style="padding-bottom: 20px;">
                                <div class="col-md-12 text-center">
                                    <a href="http://localhost/erm/oprations/all_ticket">View More</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

             <!-- Modal Daily Task-->
             <div class="modal fade" id="ModalTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: tomato;"><i class="far fa-file"></i> Hasn't written a task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Teknisi</td>
                                        
                                    </tr>
                                </thead>
                            </table>
                            <br>
                            <div class="row" style="padding-bottom: 20px;">
                                <div class="col-md-12 text-center">
                                    <a href="">View More</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

<?php }?>


