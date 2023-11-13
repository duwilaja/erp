$(document).ready(function () {
    $('#direktorat').select2();
    getJabatan();
    dataGraphCov();
    totalCovid()
});

  var densityCanvas = document.getElementById("myChart");
      
  Chart.defaults.global.defaultFontSize = 12;
    
  var chartOptions = {
    responsive: true,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            stepSize: 1
          }
        }],
      } 
  };
  
  var barChart = new Chart(densityCanvas, {
    type: 'bar',
    options: chartOptions
  });

  function dataGraphCov() {
    $.ajax({
      type: "GET",
      url: "../hcm/dataGraphCovJson",
      data:{
        'tahun' : $('#thn').val(),
        'bulan' : $('#bln').val(),
        'tanggal' : $('#tgl').val(),
        'direktorat' : $('#direktorat').val() 
      },
      dataType: "json",
      success: function (o) {
        barChart.data = o;
        barChart.update();
      }
    });
  }

  function totalCovid() {
    $.ajax({
      type: "GET",
      url: "../hcm/totalTrackCov",
      data:{
        'tahun' : $('#thn').val(),
        'bulan' : $('#bln').val(),
        'tanggal' : $('#tgl').val(),
        'direktorat' : $('#direktorat').val() 
      },
      dataType: "json",
      success: function (data) {
        $('#total_covid').html(data.totalCovid)
        $('#total_positif').html(data.totalPositif)
        $('#total_negatif').html(data.totalNegatif)
        $('#total_karyawan').html(data.totalKaryawan)
        $('#total_year').html(data.totalPerTahun)
        $('#total_month').html(data.totalPerPoBulan)
        $('#total_monthNe').html(data.totalPerNeBulan)
        $('#tidak_terpapar').html(data.tidakTerpapar)
        $('#divisi_terbanyak').html(data.divisiTerbanyak)

        // console.log(data);
      }
    });
  }

function getJabatan() { 
    $('#direktorat').val('');
    $.ajax({
        type: "GET",
        url: "../Karyawan/getJabatanKaryawan",
        dataType: "json",
        success: function (r) {
            r.karyawan.forEach(v => {
            $('#direktorat').append('<option value="'+v.idj+'" >'+v.nma_jabatan+'</option>');
            });
        }
    });
  }

function detail_modal(id)
{
    $('#detailModal').modal('show'); // show bootstrap modal
    $.ajax({
        type: "GET",
        url: "../hcm/getTrackCov/"+id,
        dataType: "json",
        success: function (data) {
            console.log(data);
            $('#nama').html(data.nama.nama);
            $('#nma_jabatan').html(data.nama.nma_jabatan);
            $('#act_ming_kang').html(data.nama.act_ming_kang);
            $('#act_luar_kntr').html(data.nama.act_luar_kntr);
            dt_histori_covid(id);
        }
    });
}

function dt_histori_covid(tcid) {
    $('#tabelHis').DataTable({
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
            "url": 'dt_histori_covid/'+tcid,
            "type": "GET",
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            "targets": [0,2],
            "orderable": false
        }]
    });
}