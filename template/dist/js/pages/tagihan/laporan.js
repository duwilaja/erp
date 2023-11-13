var ctx = document.getElementById('myChart').getContext('2d');
var ctx2 = document.getElementById('bulat').getContext('2d');
var ctx3 = document.getElementById('line').getContext('2d');
var ctx4 = document.getElementById('lineMargin').getContext('2d');

$(document).ready(function () {
    setTimeout(() => {
        stat();
    }, 150);
    showtable();
});


// Statistik Jumlah 

const stat_jumlah = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [],
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                }
            }]
        },
        maintainAspectRatio: false,
    },
    
});

// Statistik Status

var stat_status = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['Lunas','Tidak Aktif','Berjalan'],
        datasets : [
            {
                
            }
        ]
    },
    options : {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position : "bottom",
            labels : {
                padding : 20
            }
        }
    },
});



// Statistik Margin

const data_nilai = {
    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    datasets: []
    // datasets: [{
    //     label: 'Terbayar',
    //     backgroundColor: "#6f42c1",
    //     data: [1450000.21, 1750000, 1700000, 1510000, 1400000, 1400000, 1535000, 1590000, 1620000, 1590000, 1630000, 1350000, 1350000, 1700000]
    // }, {
    //     label: 'Tertunda',
    //     backgroundColor: "#e6727d",
    //     data: [1650000, 1600000, 1350000, 1550000, 1300000, 1350000, 1350000, 1390000, 1410000, 1400000, 1700000, 1300000, 1300000, 1455000]
    // }, {
    //     label: 'Margin Income',
    //     type: 'line',
    //     borderWidth: 0.1,
    //     pointRadius: 0,
    //     backgroundColor: "#ece1ff",
    //     data: [1450000, 1750000, 1700000, 1510000, 1400000, 1400000, 1535000, 1590000, 1620000, 1590000, 1630000, 1350000, 1350000, 1700000]
    // }, {
    //     label: 'Margin Lose',
    //     type: 'line',
    //     borderWidth: 0.1,
    //     pointRadius: 0,
    //     backgroundColor: "#d81b6036",
    //     data: [30, 1600000, 1350000, 1550000, 1300000, 1350000, 1350000, 1390000, 1410000, 1400000, 1700000, 1300000, 1300000, 1455000]
    // }]
};


const stat_nilai = new Chart(ctx3, {
    type: 'bar',
    data: data_nilai,
    options: {
        title: {
            display: true,
            fontStyle: 'bold',
        },
        legend: {
            position: "bottom",
            labels: {}
        },
        tooltips: {
            mode: 'label',
            bodySpacing: 10,
            cornerRadius: 0,
            titleMarginBottom: 15,
        },
        scales: {
            xAxes: [{
                ticks: {}
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    // Return an empty string to draw the tick line but hide the tick label
                    // Return `null` or `undefined` to hide the tick line entirely
                    userCallback: function(value, index, values) {
                        // Convert the number to a string and splite the string every 3 charaters from the end
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);
                        
                        // Convert the array to a string and format the output
                        value = value.join('.');
                        return 'Rp ' + value;
                    }
                }
            }]
        },
        responsive: true,
    }
});

const stat_margin = new Chart(ctx4, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: []
    },
    options: {
        title: {
            display: true,
            fontStyle: 'bold',
        },
        legend: {
            position: "bottom",
            labels: {}
        },
        tooltips: {
            mode: 'label',
            bodySpacing: 10,
            cornerRadius: 0,
            titleMarginBottom: 15,
        },
        scales: {
            xAxes: [{
                ticks: {}
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    // Return an empty string to draw the tick line but hide the tick label
                    // Return `null` or `undefined` to hide the tick line entirely
                    userCallback: function(value, index, values) {
                        // Convert the number to a string and splite the string every 3 charaters from the end
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);
                        
                        // Convert the array to a string and format the output
                        value = value.join('.');
                        return value+'%';
                    }
                }
            }]
        },
        responsive: true,
    }
});

function stat() { 
    $.ajax({
        type: "POST",
        url: "apiStatLaporan",
        dataType: "json",
        data : {
            'tahun' : $('#tahun').val(),
            'bulan' : $('#bulan').val(),
        },
        success: function (res) {
            
            stat_status.data.datasets =  [
                {
                    data : res.status,
                    backgroundColor : ["#34c38f","#e83e8c","#ffc107"],
                    weight : 2
                }
            ];
            
            stat_status.update();   

            stat_jumlah.data.datasets =  [
                {
                    label: "Jumlah Tagihan", 
                    type : 'line',
                    data: res.jumlah.t_tagihan,
                    backgroundColor: '#34c38f'
                },
                {
                    label: 'Jumlah Terbayar',
                    type : 'line',
                    data:  res.jumlah.t_terbayar,
                    backgroundColor: '#6f42c1',
                },
                {
                    label: "Jumlah Terhutang", 
                    type : 'line',
                    data: res.jumlah.t_terhutang,
                    backgroundColor: '#f46a6a'
                },
            ];

            stat_jumlah.options.scales.yAxes[0].ticks.max = res.jumlah.max;
            
            stat_jumlah.update();   

            stat_nilai.data.datasets =  [
                {
                    label: 'Total Tagihan',
                    type : 'line',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    data: res.harga.tagihan
                },
                {
                    label: 'Terhutang',
                    backgroundColor: "#dc35452e",
                    data: res.harga.terhutang
                },
                {
                    label: 'Terbayar',
                    backgroundColor: "#6e42c12b",
                    data: res.harga.terbayar
                }, {
                    label: 'Tertunda',
                    type : 'line',
                    borderColor: '#e83e8c',
                    backgroundColor: 'rgba(0, 0, 0, 0)',
                    data: res.harga.tertunda
                }
            ];
            
            stat_nilai.update();  

            stat_margin.data.datasets =  [
                {
                    label: 'Margin Income',
                    type : 'line',
                    borderColor: '#34c38f',
                    backgroundColor: '#20c9973d',
                    data: res.margin.income
                },{
                    label: 'Margin Lose',
                    type : 'line',
                    borderColor: '#e83e8c',
                    backgroundColor: '#d81b601a',
                    data: res.margin.lose
                },
            ];
            stat_margin.options.scales.yAxes[0].ticks.max = 100;

            stat_margin.update();  

            $('#t_tagihan').text(res.jml_harga.tagihan);
            $('#t_terbayar').text(res.jml_harga.terbayar);
            $('#t_terhutang').text(res.jml_harga.terhutang);
            $('#t_sisa_tagihan').text(res.jml_harga.sisa_tagihan);
        }
    });
}

$('#formFilter').submit(function (e) { 
    e.preventDefault();
    stat();
    showtable();
});

function cekStat(a,b) { 
    $(a).show();
    $(b).hide();
}

function showtable() {
	//console.log('list');
    $('#tabel').DataTable({
        // Processing indicator
        "bAutoWidth": false,
        "destroy": true,
        "searching": true,
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        "scrollX": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
          "url": 'dtTagihanLaporan',
          "type": "POST",
          "data": {
              'tahun' : $('#tahun').val(),
              'status' : $('#status').val()
          }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [5],
          "orderable": false
        }]
      });
  }

  $('#status').change(function (e) { 
      e.preventDefault();
      showtable();
  });