$(document).ready(function () {
    const changeStaffType = function (office_id) {
        if (office_id) {
            $("select#office_staff_id").empty();
            if (listOfficeType) {
                if (listOfficeType.length > 0) {
                    let filter = listOfficeType.filter((x) => x.office_id == office_id);
                    if (filter) {
                        $("select#office_staff_id").append($("<option>").val("").html("- Choose Staff Type -"));
                        if (filter.length > 0) {
                            for (let data of filter) {
                                $("select#office_staff_id").append($("<option>").val(data.id).html(`${data.staff_code} (${data.start_date} - ${data.end_date})`));
                            }
                        }
                    }
                }
            }
        } else {
            $("select#office_staff_id").empty();
            $("select#office_staff_id").append($("<option>").val("").html("- Choose Staff Type -"));
        }
    }
    $('#jbtn').select2();
    let k_id = $('#k_id').val();
    if (k_id) {
        let office_id = $('#office_id').val();
        let staff_code = $('#staff_code').val();
        changeStaffType(office_id);
        let filter = listOfficeType.filter((x) => x.office_id == office_id && x.staff_code == staff_code);
        if (filter) {
            if (filter.length > 0) {
                $('#office_staff_id').val(filter[0].id);
            }
        }
    } else {
        let office_id = $('#office_id').val();
        changeStaffType(office_id);
    }
    $('#office_id').change(function () {
        let val = $(this).val();
        console.log(val);
        $('#select_office_id').val(val);
        $('#staff_code').val("");
        changeStaffType(val);
    });
    $('#office_staff_id').change(function () {
        let val = $(this).val();
        let filter = listOfficeType.filter((x) => x.id == val);
        let staff_code = "";
        if (filter) {
            if (filter.length > 0) {
                $('#staff_code').val(filter[0].staff_code);
            }
        }
    });

});


