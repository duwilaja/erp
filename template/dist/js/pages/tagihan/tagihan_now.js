let nm = 1;

$(document).ready(function () {
    getTgh(nm); //Tagihan Sekarang / Minggu ini
});

$('#sel-filter').change(function (e) { 
    e.preventDefault();
    getTgh(nm);
});

$('#sel-urutan').change(function (e) { 
    e.preventDefault();
    getTgh(nm);
});

function cari() { 
    getTgh(nm);
}

