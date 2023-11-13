var st = document.getElementById('st').getContext('2d');

$(document).ready(function () {
    showtable();
    stat();

    $("#sticky").sticky({
        topSpacing:0,
    });
});

const stat_st = new Chart(st, {
    type: 'bar',
    data: {
        labels: [],
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


function stat() { 
    $.ajax({
        type: "POST",
        url: "getTicketByDate",
        dataType: "json",
        data : {
            'pic' : $('#pic').val(),
            'tgl_mulai' : $('#tgl_mulai').val(),
            'tgl_akhir' : $('#tgl_akhir').val(),
            'status' : $('#status').val(),
            'custend' : $('#customer').val(),
            'tahun' : $('#tahun').val(),
            'bulan' : $('#bulan').val(),
        },
        success: function (res) {

            $('#new').text(res.jml_ticket.new);
            $('#pro').text(res.jml_ticket.progress);
            $('#pen').text(res.jml_ticket.pending);
            $('#res').text(res.jml_ticket.resolved);
            $('#clo').text(res.jml_ticket.closed);
            $('#all').text(res.jml_ticket.all);

            stat_st.data.labels = res.tgl,
            stat_st.data.datasets =  [
                {
                    label: "Jumlah Tiket", 
                    data : res.data,
                    backgroundColor : "#ffc107",
                    // weight : 2
                }
            ];
            
            stat_st.options.scales.yAxes[0].ticks.max = res.max;
            stat_st.update();   
        }
    });
}

function getDownloadReport() { 
    $.ajax({
        type: "GET",
        url: "report_download",
        dataType: "HTML",
        data : {
            'pic' : $('#pic').val(),
            'tgl_mulai' : $('#tgl_mulai').val(),
            'tgl_akhir' : $('#tgl_akhir').val(),
            'custend' : $('#customer').val(),
            'status' : $('#status').val(),
            'tahun' : $('#tahun').val(),
            'bulan' : $('#bulan').val(),
        },
        success: function (res) {
            window.location = this.url;           
        }
    });
}

$('#formFilter').submit(function (e) { 
    e.preventDefault();
    stat();
    showtable();
});

function showtable() {
    //console.log('list');
    $('#table').DataTable({
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
            "url": 'dtReportTicket',
            "type": "POST",
            "data": {
                'custend' : $('#customer').val(),
                'tgl_mulai' : $('#tgl_mulai').val(),
                'tgl_akhir' : $('#tgl_akhir').val(),
                'status' : $('#status').val(),
                'tahun' : $('#tahun').val(),
                'bulan' : $('#bulan').val(),
            }
        },
        //Set column definition initialisation properties
        "columnDefs": [{
            // "targets": [5],
            "orderable": false
        }]
    });
}

// let dat = [];
// let customer=[];
// let cusweek = [];

// function ochanges(bul = 3){
//     var tes2 =  fetch(url+'oprations/tes/'+bul).then(function (response) {
//         // The API call was successful!
//         return response.json();
//     }).then(function (data) {
//         // This is the JSON from our response
//         dat = data;


//         for(let i = 0 ; i < dat.length ; i++){
//             customer.push(dat[i].cus);
//         }

//         cusweek = [];
//         cusweek = customer.filter(groupCus);


//         for(let i = 0; i < cusweek.length; i++){
//             alldat[i] = (cusAndWeek(dat, cusweek[i]))[0];
//         }

//         changeChart(alldat);

//         changes(bul, cusByMonth(bul), groupByCus(cusByMonth(bul)));


//     }).catch(function (err) {
//         // There was an error
//         console.warn('Something went wrong.', err);
//     });
// }


// function cekBulan(bulan){
//     let data = [];
//     for(var i = 0; i < dat.length; i++){
//         if(dat[i].bulan == bulan){
//             data.push(dat[i].status);
//         }
//     }

//     return data;
// }

// function catt(data){
//     let all = [0,0,0,0];

//     for(var u = 0; u < data.length ; u++){
//         switch(data[u]) {
//             case "new":
//             all[0]++;
//             break;
//             case "pending" :
//             all[1]++;
//             break;
//             case "progress" :
//             all[2]++;
//             break;
//             case "closed" :
//             all[3]++;
//             break;
//         } 
//     }

//     return all;
// }

// var d = new Date();
// var n = d.getMonth() + 1;

// function changes(bul = n, tot = [], grp = [], datc = []){
//     document.getElementById("new").innerHTML = catt(cekBulan(bul))[0];
//     document.getElementById("pen").innerHTML = catt(cekBulan(bul))[1];
//     document.getElementById("prog").innerHTML = catt(cekBulan(bul))[2];
//     document.getElementById("close").innerHTML = catt(cekBulan(bul))[3];

//     document.getElementById("tot").innerHTML = tot.length;

//     cus = ``;

//     if(grp.length > 0){
//         for(var t = 0; t < grp.length ; t++){
//             cus = cus + ` 
//             <div class="row">
//             <div class="col-md-12 col-12"><hr></div>
//             <div class="col-md-8 col"> ${grp[t].cus}</div>
//             <div class="col-md-4 col text-right"><h4><strong>${grp[t].tot}</strong></h4></div>
//             </div>`;
//         }
//     }else{
//         cus =  ` 
//         <div class="row">
//         <div class="col-md-12 col text-center" style="color : grey">No data</div>
//         </div>`;
//     }

//     document.getElementById("customers").innerHTML = cus;


// }

// setTimeout(() => {ochanges(n, cusByMonth(n),  groupByCus(cusByMonth(n)))}, 1000);
// //setTimeout(() => {console.log(cusAndWeek(dat, dat[0].cus))}, 1000);


// let cusByMonth = function(bulan){
//     let cus = [];
//     for(var i = 0; i < dat.length; i++){
//         if(dat[i].bulan == bulan){
//             cus.push(dat[i].cus);
//         }
//     }
//     return cus;
// }

// let groupByCus = function(array_elements){    
//     array_elements.sort();

//     var current = null;
//     var cnt = 0;

//     var data = [];
//     for (var i = 0; i < array_elements.length; i++) {
//         if (array_elements[i] != current) {
//             if (cnt > 0) {
//                 data.push(
//                     {
//                         cus: current,
//                         tot : cnt
//                     }
//                     );
//                 }
//                 current = array_elements[i];
//                 cnt = 1;
//         } else {
//             cnt++;
//         }
//     }
//         if (cnt > 0) {
//             data.push(
//                 {
//                     cus: current,
//                     tot : cnt
//                 });
//                 return data;
//             }else{
//                 return data = 0;
//             }


//         }


//     let chartData = [];
//     function cusAndWeek (data = [], cus = "",){

//     let datas = [{
//         label : "",
//         data : [0,0,0,0,0]

//         }];
//     for(var i = 0; i < data.length; i++){

//         if(data[i].cus == cus){
//             datas[0].label = cus;
//             switch (data[i].week){
//                 case 1 :
//                     datas[0].data[0]++;
//                     datas[0].backgroundColor = randomCol()
//                     break;
//                 case 2 :
//                     datas[0].data[1]++;
//                     datas[0].backgroundColor = randomCol()
//                     break;
//                 case 3 :
//                     datas[0].data[2]++;
//                     datas[0].backgroundColor = randomCol()
//                     break;
//                 case 4 :
//                     datas[0].data[3]++;
//                     datas[0].backgroundColor = randomCol()
//                     break;
//                 case 5 :
//                     datas[0].data[4]++
//                     datas[0].backgroundColor = randomCol()
//                     break;
//             }
//         }

//     }


//     return datas;


// }

// function groupCus(value, index, self){
//     return self.indexOf(value) === index;
// }


// function changeChart(data){

//     var chart = new Chart(ctx, {
//         // The type of chart we want to create
//         type: 'bar',

//         // The data for our dataset
//         data: {
//             labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
//             datasets: data
//         },

//         // Configuration options go here
//         options: {
//             scales: {
//                 yAxes: [{
//                     ticks: {

//                         stepSize: 1
//                     }
//                 }]
//             }
//         }
//     });
// }

// function randomCol(){
//     return "#"+(Math.random().toString(16)+"000000").slice(2, 8).toUpperCase();
// }