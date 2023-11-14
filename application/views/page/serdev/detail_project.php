<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 style="color: tomato;"><strong>Pengadaan sewa jaringan komunikasi di korlantas Polri</strong>   </h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-2 col">
                                        <label for="">No. Contract</label>
                                    </div>
                                    <div class="col-md-8 col">: 025/PO/II/2020 </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col">
                                        <label for="">Timeline</label>
                                    </div>
                                    <div class="col-md-8 col">: 1 Januari 2020 - 31 Januari 2020</div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Segment</th>
                                            <th>Nama Unit</th>
                                            <th>Online</th>
                                            <th>Installation</th>
                                            <th>Shipping</th>
                                            <th>Cancel</th>
                                            <th>Staging</th>
                                            <th>Grand Total</th>
                                            <th>Actual</th>
                                            <th>Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Backhaul</td>
                                            <td>Backhaul RTMC Polda Bali</td>
                                            <td>44</td>
                                            <td>27</td>
                                            <td>66</td>
                                            <td>11</td>
                                            <td>3</td>
                                            <td>140</td>
                                            <td>31.43%</td>
                                            <td>15%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <canvas id="speedChart"></canvas>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div style="padding-right: 0px;" class="col-md-3 col">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr><th>Uraian</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Rencana Progress Harian</td>
                                        </tr>
                                        <tr>
                                            <td>Rencana Progress Kumulatif</td>
                                        </tr>
                                        <tr>
                                            <td>Aktual Progres Hari Ini</td>
                                        </tr>
                                        <tr>
                                            <td>Rencana Progress Kumulatif</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding-left: 0px;" class="col-md-9 col table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr id="tgl">
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>6</th>
                                            <th>7</th>
                                            <th>8</th>
                                            <th>9</th>
                                            <th>10</th>
                                            <th>11</th>
                                            <th>12</th>
                                            <th>13</th>
                                            <th>14</th>
                                            <th>15</th>
                                            <th>16</th>
                                            <th>17</th>
                                            <th>18</th>
                                            <th>19</th>
                                            <th>20</th>
                                            <th>21</th>
                                            <th>22</th>
                                            <th>23</th>
                                            <th>24</th>
                                            <th>25</th>
                                            <th>26</th>
                                            <th>27</th>
                                            <th>28</th>
                                            <th>29</th>
                                            <th>30</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script>
    var speedCanvas = document.getElementById("speedChart");
    
    Chart.defaults.global.defaultFontFamily = "Lato";
    Chart.defaults.global.defaultFontSize = 12;
    $tgl1 = document.getElementById('tgl');
    let tgl = ["1"];
    for(var i = 1; i<31 ; i++){
        tgl[i-1] = i.toString();
        
    }
    var speedData = {
        labels: tgl,
        datasets: [{
            label: "Car Speed (mph)",
            data: [0, 59, 75, 20, 20, 55, 40],
            lineTension: 0,
            fill: false,
            borderColor: 'orange',
            backgroundColor: 'transparent',
            borderDash: [5, 5],
        },
        {
            label: "Car Speed (mph)",
            data: [0, 12, 73, 10, 40, 45, 20],
            lineTension: 0,
            fill: false,
            borderColor: 'tomato',
            backgroundColor: 'transparent',
            borderDash: [5, 5],
        }]
    };
    
    var chartOptions = {
        legend: {
            display: true,
            position: 'top',
            labels: {
                boxWidth: 80,
                fontColor: 'black'
            }
        },
        responsive: true,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max: 100,
                    stepSize: 10
                }
            }],
        } 
    };
    
    var lineChart = new Chart(speedCanvas, {
        type: 'line',
        data: speedData,
        options: chartOptions
    });
    
</script>