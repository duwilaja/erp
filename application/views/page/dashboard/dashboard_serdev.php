<style>
    #myChart2{
        max-height: 400px;
    }

    .bott{
        padding-top: 30px;
        border-top: 1px solid #f2f2f2;
        margin-top: 20px;
    }
</style>

<?php if ($this->session->userdata('level') == '21') { ?>
    <div class="row">
        <div class="col-md-3 col-6">
            <div class="mycard rounded">
                <div class="card-body text-center">
                    <br>
                    <h4 style="color: #706c61"><i class="fas fa-clipboard-check"></i> <strong>5</strong></h4>
                    <p class="pt">Project Done</p>
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6">
            <div class="mycard rounded">
                <div class="card-body text-center">
                    <br>
                    <h4 style="color: #2c7873;"><i class="fas fa-file-import"></i> <strong>20</strong></h4>
                    <p class="pt">Running Project</p>
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6">
            <div class="mycard rounded">
                <div class="card-body text-center">
                    <br>
                    <h4 style="color: #2c7873;"><i class="fas fa-server"></i> <strong>550</strong></h4>
                    <p class="pt">Device Ready</p>
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6">
            <div class="mycard rounded">
                <div class="card-body text-center">
                    <br>
                    <h4 style="color: #5f6caf;"><i class="fas fa-tools"></i> <strong>15</strong></h4>
                    <p class="pt">Running Maintenance</p>
                    
                </div>
            </div>
        </div>

        
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="mycard rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="pt">Project Summary <small>(Based on the number of PO)</small></p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                    <br>
                    <div class="row bott">
                        <div class="col-md-6 text-center">
                            <h4 style="color: tomato;"><strong>600 Titik</strong></h4>
                            <p class="pt">Delivery Target</p>
                        </div>

                        <div class="col-md-6 text-center" style="border-left: #f2f2f2 1px solid;">
                            <h4 style="color: #5f6caf;"><strong>200 Titik</strong></h4>
                            <p class="pt">To Be Close</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-md-12">
            <div class="mycard rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="pt">Pipeline this Month</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>End Customer</th>
                                        <th>Solution</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>M001</td>
                                        <td>Telkom</td>
                                        <td>Pertamina</td>
                                        <td>SD-Wan</td>
                                        <td>RasNet</td>
                                        <td>Quilified Oportonity</td>
                                        <td>PO</td>
                                    </tr>

                                    <tr>
                                        <td>M002</td>
                                        <td>Telkom</td>
                                        <td>CEll</td>
                                        <td>SD-Wan</td>
                                        <td>RasNet</td>
                                        <td>Quilified Oportonity</td>
                                        <td>PO</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="" style="color: tomato;">View More..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
        <div class="col-md-12">
            <div class="mycard rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="pt">Invoice Status</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>No. Contact</th>
                                        <th>Period</th>
                                        <th>Bill of</th>
                                        <th>Status</th>
                                        <th>Desc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>M001</td>
                                        <td>Telkom</td>
                                        <td>Pertamina</td>
                                        <td>SD-Wan</td>
                                        <td>RasNet</td>
                                        <td>Quilified Oportonity</td>
                                        <td>PO</td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>M002</td>
                                        <td>Telkom</td>
                                        <td>CEll</td>
                                        <td>SD-Wan</td>
                                        <td>RasNet</td>
                                        <td>Quilified Oportonity</td>
                                        <td>PO</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-top: 20px; margin-bottom: 20px;">
                            <a href="" style="color: tomato;">View More..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    
    <script>
        var ctx = document.getElementById("myChart2");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09", "2015-10", "2015-11", "2015-12"],
                datasets: [{
                    label: '# of Tomatoes',
                    data: [12, 19, 3, 5, 2, 3, 20, 3, 5, 6, 2, 1],
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    xAxes: [{
                        ticks: {
                            maxRotation: 90,
                            minRotation: 80
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>