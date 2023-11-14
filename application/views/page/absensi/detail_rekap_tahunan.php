<style>
    canvas { 
        width: 100%;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <?=$nama;?>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Masuk</th>
                                <th>Izin</th>
                                <th>Cuti</th>
                                <th>Sakit</th>
                                <th>Telat</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($absenBulan as $v ) { ?>
                            <tr>
                                <td><?=$v['bulan'];?></td>
                                <td><?=$v['masuk'];?></td>
                                <td><?=$v['izin'];?></td>
                                <td><?=$v['cuti'];?></td>
                                <td><?=$v['sakit'];?></td>
                                <td><?=$v['telat'];?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script>
    var ctx = document.getElementById("myChart");
    
    let datake = [[19, 10, 6], [4, 12, 2], [22, 4, 10], [2, 5, 2]];
        
    let absen = [{
        label: '# Masuk',
        data: datake[0],
        backgroundColor: [
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        'rgba(46, 184, 114, 1)',
        
        ]
    },{
        label: 'Izin',
        data: datake[1],
        backgroundColor: [
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)',
        'rgba(56, 66, 89, 1)'
        ]
    },
    {
        label: 'Cuti',
        data: datake[2],
        backgroundColor: [
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        'rgba(249, 89, 89, 1)',
        ]
    },
    {
        label: 'Sakit',
        data: datake[3],
        backgroundColor: [
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        'rgba(33, 101, 131, 1)',
        ]
    }];
    
    var myChart = new Chart(ctx, {
        type: 'bar',
        responsive: true,
        data: {
            labels: ["Jan", "Feb", "Mar", "April", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
            datasets: <?=$grafikAbsen;?>,
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
                        beginAtZero: true,
                        stepSize: 1
                    }
                }]
            }
        }
    });
</script>