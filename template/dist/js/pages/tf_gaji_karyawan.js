
var gp = $('input[name=gp]');
var tf = $('input[name=tf]');
var ts = $('input[name=ts]');
var t = $('input[name=t]');
var bpjs_kes = $('input[name=bpjs_kes]');
var bpjs_ket = $('input[name=bpjs_ket]');
var pph21 = $('input[name=pph21]');
var totalGaji = $('#total_gaji');
var totalGaji1 = $('input[name=total_gaji]');

var p_gp = $('input[name=p_gp]');
var p_tf = $('input[name=p_tf]');
var p_ts = $('input[name=p_ts]');
var p_t = $('input[name=p_t]');
var p_bpjs_kes = $('input[name=p_bpjs_kes]');
var p_bpjs_ket = $('input[name=p_bpjs_ket]');
var p_pph21 = $('input[name=p_pph21]');

var hPenghasilan = [0];
var hPotongan = [0];
var hasilTunjanganLain = [0];
var hasilGajiKotor = 0;
var hasilGajiBersih = 0;

$(document).ready(function() {
    
    $('select[name=nama_karyawan]').change(function (e) { 
        e.preventDefault();
        getKarywan(this.value);
    });

    $('select[name=karyawan]').select2({
        placeholder: 'Please Select Employes'
    });

    $('select[name=bulan_tf]').select2({
        placeholder: 'Please Select Month Transfer'
    });

});

function getKaryawan(id='') {
    $.ajax({
        type: "get",
        url:url+'karyawan/getKaryawanSlip/'+id,
        dataType: "json",
        success: function (res) {
            r = res.data;
            if (res.status == 1) {
                stxt('txtidslip',r.idslip);
                stxt('jabatan',r.jabatan);
                stxt('direktorat',r.direktorat);
                stxt('departemen',r.departemen);
                stxt('golongan',r.golongan);
                stxt('status_karyawan',r.status_karyawan);

                sinp('gj',r.gj);
                $('input[name="idslip"]').val(r.idslip);
            }
        }
    });
}

function cekTotalPenghasilan() {
    var total = 0;
    total += ninp('gp');
    total += ninp('tk');
    total += ninp('to');
    total += ninp('tj');

    stxt('hasilPenghasilan',total);
    hPenghasilan.pop();
    hPenghasilan.push(total);
    cekTotalSemua();
}

function cekTotalPotongan() {
    var total = 0;
    total += ninp('p_pph21');
    total += ninp('p_bpjs_kes');
    total += ninp('p_bpjs_ket');
    total += ninp('p_ta');
    total += ninp('p_pinjaman');

    stxt('hasilPotongan',total);
    hPotongan.pop();
    hPotongan.push(total);
    cekTotalSemua();
}

function cekTotalTunjanganLain() {
    var total = 0;
    total += ninp('pph21');
    total += ninp('bpjs_kes');
    total += ninp('bpjs_ket');
    total += ninp('ta');
    total += ninp('lembur');

    stxt('hasilTunjanganLain',total);
    hasilTunjanganLain.pop();
    hasilTunjanganLain.push(total);
    cekTotalSemua();
}

function cekTotalSemua() {
    var totalKotor = (hPenghasilan[0] + hasilTunjanganLain[0]);
    var totalBersih = (hPenghasilan[0] + hasilTunjanganLain[0]) - hPotongan[0];
    stxt('hasilGajiKotor',totalKotor);
    stxt('hasilGajiBersih',totalBersih);
    terbilang(totalBersih);

  
    $('input[name="total_tj"]').val(hPenghasilan[0]);
    $('input[name="total_tj_lainnya"]').val(hasilTunjanganLain[0]);
    $('input[name="total_gj_kotor"]').val(totalKotor);
    $('input[name="total_gj_bersih"]').val(totalBersih);
    $('input[name="total_gj_potongan"]').val(hPotongan[0]);


}

function terbilang(nilai='') {
    $.ajax({
        url: url+'payroll/penyebutUang/'+nilai,
        type: 'GET',
        dataType: 'json',
    })
    .done(function(r) {
        stxt('terbilang',r);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    
}

function cekTotal() {
    var total = 0;
    total +=  parseInt(gp.val());   
    total +=  parseInt(tf.val());   
    total +=  parseInt(ts.val());   
    total +=  parseInt(t.val());   
    total +=  parseInt(bpjs_kes.val());   
    total +=  parseInt(bpjs_ket.val());   
    total +=  parseInt(pph21.val());

    total -=  parseInt(p_gp.val());   
    total -=  parseInt(p_tf.val());   
    total -=  parseInt(p_ts.val());   
    total -=  parseInt(p_t.val());   
    total -=  parseInt(p_bpjs_kes.val());   
    total -=  parseInt(p_bpjs_ket.val());   
    total -=  parseInt(p_pph21.val()); 

    totalGaji1.val(total);
    totalGaji.text(total);
     cekNaN();
}

function cekNaN() {
    if (isNaN(totalGaji.val()) == true) {
        totalGaji.text('');
        totalGaji1.val('');
    }    
   
}
