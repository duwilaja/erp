function changeScore(id,score,weight,karyawan_id) {
    $.ajax({
        type: "post",
        url: url+"kpi/ubahScore",
        data: {
            'score' : $('input[name="score-'+id+'"]').val(), 
            'weight' : weight, 
            'id' : id, 
            'idk' : karyawan_id, 
        },
        dataType: "json",
        success: function (r) {
            $('#txt-total-'+id).text(r.total);
            $('#total_all').text(r.total_all);
        }
    });
}