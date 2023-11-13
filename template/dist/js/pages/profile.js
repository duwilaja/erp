$(document).ready(function() {
    addEducation();
    addAward();
    addSkill();
    addJobHistory();
    addPelatihan();

    $('#selectSkill').select2({
        tags : true,
        placeholder: 'Please Select Skill'
      });
});

function addEducation() { 
    $('#addEducation').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'karyawan/inEducation/',
            data:  $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });

            }
        });
    });
 }

 function addAward() { 
    $('#addAward').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'karyawan/inAward/',
            data:  $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });

            }
        });
    });
 }

 function addSkill() { 
    $('#addSkill').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'karyawan/inSkill/',
            data:  $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });

            }
        });
    });
 }

 function addJobHistory() { 
    $('#addJobHistory').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'karyawan/inJobHistory/',
            data:  $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });

            }
        });
    });
 }

 function addPelatihan() { 
    $('#addPelatihan').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: url+'karyawan/inPelatihan/',
            data:  $(this).serialize(),
            dataType: "json",
            success: function (r) {
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: r.msg,
                });

            }
        });
    });
 }