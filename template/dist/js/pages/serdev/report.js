$(document).ready(function () {
  dt();
});

var ctx = document.getElementById('chart_progress').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'horizontalBar',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: 'Project Progress',
      data: [12, 19, 3, 5, 2, 3],
      borderColor: 'rgba(0, 0, 0, 0)',
      backgroundColor: '#555',
      // borderColor: [
      //     'rgba(255, 99, 132, 1)',
      //     'rgba(54, 162, 235, 1)',
      //     'rgba(255, 206, 86, 1)',
      //     'rgba(75, 192, 192, 1)',
      //     'rgba(153, 102, 255, 1)',
      //     'rgba(255, 159, 64, 1)'
      // ],
      borderRadius: 100,
      borderWidth: 0,
      scaleSteps : 10,
      scaleStepWidth : 50,
      barPercentage: 0.9,
      // barThickness: 6,
      // maxBarThickness: ,
      minBarLength: 4,
    }]
  },
  options: 
  {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      position: 'top',
    },
    hover: {
      mode: 'label'
    },
    scales: {
      xAxes: [{
        display: true,
        scaleLabel: {
          display: true,
          // labelString: 'Month'
        },
        ticks: {
          beginAtZero: true,
          steps: 90,
          stepValue: 1,
          max: 100
        }
      }],
    },
    // title: {
    //     text: 'Chart.js Line Chart - Legend'
    // }
  },
});

fetch('get_grafik_progress')
.then(response => response.json())
.then(data => {
  myChart.data.labels = data.label;
  myChart.data.datasets[0].data = data.persentase;
  myChart.options.scales.xAxes[0].ticks.max = Math.max(...data.persentase)+10;
  myChart.update(); 
}
);


var ctx_status = document.getElementById('chart_status').getContext('2d');
var myChart_status = new Chart(ctx_status, {
  type: 'pie',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: 'Project Progress',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
        '#eee',
        '#fca921',
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 0
    }]
  },
  options: 
  {
    // Elements options apply to all of the options unless overridden in a dataset
    // In this case, we are setting the border of each horizontal bar to be 2px wide
    responsive: true,
    maintainAspectRatio: false,
    title: {
      display: true,
      text: "Overall Task Status"
    }
  }
});

fetch('get_grafik_status')
.then(response => response.json())
.then(data => {
  myChart_status.data.labels = data.label;
  myChart_status.data.datasets[0].data = data.jml;
  myChart_status.data.datasets[0].backgroundColor = data.color;
  myChart_status.update(); 
}
);


var ctx_obs = document.getElementById('chart_obstacle').getContext('2d');
var myChart_obs = new Chart(ctx_obs, {
  type: 'bar',
  data: {
    labels: ['Red', 'Blue', 'Yellow'],
    datasets: [{
      label: 'Obstacle Project',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 0
    }]
  },
  options: 
  {
    indexAxis: 'y',
    // Elements options apply to all of the options unless overridden in a dataset
    // In this case, we are setting the border of each horizontal bar to be 2px wide
    responsive: true,
    maintainAspectRatio: false,
    elements: {
      bar: {
        borderWidth: 2,
      }
    },
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      }
    }
  },
});

fetch('get_grafik_obstacle')
.then(response => response.json())
.then(data => {
  myChart_obs.data.labels = data.label;
  myChart_obs.data.datasets[0].data = data.jml;
  myChart_obs.update(); 
}
);

const get_wo = ((id) => {
  get_serdev(3).then((result) => {
    fetch('get_projek_wo?id='+id)
      .then(response => response.json())
      .then(data => {
        $('#id').val(data.id);
        $('#priority').val(data.priority);
        setTimeout(() => {
          $('#tech_lead').val(data.team_lead);
        }, 100);
      }
    );
  }).catch((err) => {
    console.log(err.message);
  });
});

async function get_serdev(id){
  new Promise(
    function(resolve, reject) {
      fetch('../Karyawan/getKaryawanByGrp/'+id)
      .then(response => response.json())
      .then(data => {
        $('#tech_lead').html('');
        data.forEach(x => {
          $('#tech_lead').append("<option value="+x.id+">"+x.nama+"</option>");
        });
        resolve(data);
      }
      );
    }
  );
}
  
  $('#form_edit_projek').submit(function (e) { 
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "up_wo",
      data: $('#form_edit_projek').serialize(),
      dataType: "json",
      success: function (r) {
        Swal.fire(
          'Berhasil',
          r.msg,
          'success'
          );
          $('#edit_projek').modal('hide');
          dt();
        }
      });  
    });
    
    function dt() {
      $('#table_progress').DataTable({
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
          "url": 'dt_wo_report',
          "type": "POST",
          // "data": {
          //     'id_wo' : id_wo
          // }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
          "targets": [0],
          "orderable": false
        }]
      });
    }
    
    