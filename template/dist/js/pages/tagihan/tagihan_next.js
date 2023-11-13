let nm = 2;

$(document).ready(function () {
    getTgh(nm); //Tagihan Selanjutnya / Tagihan Bulan Besok
});

$('#sel-filter').change(function (e) { 
    e.preventDefault();
    getTgh(nm);
});

$('#sel-urutan').change(function (e) { 
    e.preventDefault();
    getTgh(nm);
});