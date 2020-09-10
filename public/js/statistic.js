$(document).ready(function () {
    var regex = /^\d*[.]?\d*$/;
    /* table sum admin */
    var sumfirst = 0;
    var sumrec = 0;
    var sumfinal = 0;

    $('.admin_stat .first_patient .value input').each(function () {

        if ($(this).val() !== "") {
            sumfirst += parseInt($(this).val().replace(/ /g, ''));
        }


    });
    $('.admin_stat .recorded_patient .value input').each(function () {
        if ($(this).val() !== "") {
            sumrec += parseInt($(this).val().replace(/ /g, ''));
        }
    });
    $('.admin_stat .final_patient .value input').each(function () {
        if ($(this).val() !== "") {
            sumfinal += parseInt($(this).val().replace(/ /g, ''));
        }
    });

    if (!isNaN(sumfirst)) {
        $('.admin_stat tr:last-child').find("td:eq(1) .value").text(sumfirst.toLocaleString().replace(/,/g, " ", ));
    }
    if (!isNaN(sumrec)) {
        $('.admin_stat tr:last-child').find("td:eq(2) .value").text(sumrec.toLocaleString().replace(/,/g, " ", ));
    }
    if (!isNaN(sumfinal)) {
        $('.admin_stat tr:last-child').find("td:eq(3) .value").text(sumfinal.toLocaleString().replace(/,/g, " ", ));
    }



    /* colum update admin*/

//    $(document.body).on('blur', '.admin_stat td div input', function () {
//        var _token = $("input[name=_token]").val();
//        var val = $(this).val();
//        var input = $(this);
//        val = val.replace(/ /g, '');
//
//        if (regex.test(val)) {
//
//        } else {
//            return false;
//
//        }
//
//        var index = $(this).parent().parent().index();
//        index = index ;
//        var col = $(this).parent().parent().attr('data-col');
//        var id = $(this).parent().parent().parent().attr('data-id');
//        var org = $(this).parent().parent().parent().attr('data-org');
//        var td = $(this).parent().parent();
//        var class_name = td.attr('class').split(' ')[1];
//        var first_data = $(".first_data").val();
//
//        var total = 0;
//        $.ajax({
//            url: "/ajax-post-admin",
//            type: "POST",
//            data: {_token: _token, id: id, val: val, col: col, org: org, first_data: first_data},
//            success: function (response) {
//                if (response == 1) {
//                    val = parseInt(val.toLocaleString().replace(/ /g, ''));
//                    if (isNaN(val)) {
//                        input.val("")
//                    } else {
//                        val = val.toLocaleString().replace(/,/g, " ", );
//                        input.val(val)
//                    }
//
//                    $('.' + class_name + ' .value input').each(function () {
//
//                        x = $(this).val().replace(/[^0-9\.]+/g, "");
//                        if (x !== "") {
//                            total += parseInt(x);
//                        }
//
//                    });
//                    total = total.toLocaleString().replace(/,/g, " ", );
//                    $('.admin_stat tr:last-child').find("td:eq(" + index + ")").find(".value").text(total);
//
//                }
//            },
//        });
//    });






    /* table sum doctor */
    var first_consulting = 0;
    var first_therapy = 0;
    var total_therapy = 0;
    var schedule_time = 0;
    var spent_time = 0;
    var turnover = 0;
    var clients = 0;

    $('.doctor_stat .first_consulting .value input').each(function () {
        if ($(this).val() !== "") {
            first_consulting += parseInt($(this).val().replace(/ /g, ''));
        }
    });
    $('.doctor_stat .first_therapy .value input').each(function () {
        if ($(this).val() !== "") {
            first_therapy += parseInt($(this).val().replace(/ /g, ''));
        }
    });
    $('.doctor_stat .total_therapy .value input').each(function () {
        if ($(this).val() !== "") {
            total_therapy += parseInt($(this).val().replace(/ /g, ''));
        }
    });
    $('.doctor_stat .schedule_time .value input').each(function () {
        if ($(this).val() !== "") {
            schedule_time += parseInt($(this).val().replace(/ /g, ''));
        }
    });
    $('.doctor_stat .spent_time .value input').each(function () {
        if ($(this).val() !== "") {
            spent_time += parseInt($(this).val().replace(/ /g, ''));
        }
    });
    $('.doctor_stat .turnover .value input').each(function () {
        if ($(this).val() !== "") {
            turnover += parseInt($(this).val().replace(/ /g, ''));
        }
    });
    $('.doctor_stat .clients .value input').each(function () {
        if ($(this).val() !== "") {
            clients += parseInt($(this).val().replace(/ /g, ''));
        }
    });

    if (!isNaN(first_consulting)) {
        $('.doctor_stat tr:last-child').find("td:eq(1) .value").text(first_consulting.toLocaleString().replace(/,/g, " ", ));
    }
    if (!isNaN(first_therapy)) {
        $('.doctor_stat tr:last-child').find("td:eq(2) .value").text(first_therapy.toLocaleString().replace(/,/g, " ", ));
    }
    if (!isNaN(total_therapy)) {
        $('.doctor_stat tr:last-child').find("td:eq(3) .value").text(total_therapy.toLocaleString().replace(/,/g, " ", ));
    }
    if (!isNaN(schedule_time)) {
        $('.doctor_stat tr:last-child').find("td:eq(4) .value").text(schedule_time.toLocaleString().replace(/,/g, " ", ));
    }
    if (!isNaN(spent_time)) {
        $('.doctor_stat tr:last-child').find("td:eq(5) .value").text(spent_time.toLocaleString().replace(/,/g, " ", ));
    }
    if (!isNaN(turnover)) {
        $('.doctor_stat tr:last-child').find("td:eq(6) .value").text(turnover.toLocaleString().replace(/,/g, " ", ));
    }
    if (!isNaN(clients)) {

        $('.doctor_stat tr:last-child').find("td:eq(7) .value").text(clients.toLocaleString().replace(/,/g, " ", ));
    }




    /* colum update doctor*/

//    $(document.body).on('blur', '.doctor_stat td input', function () {
//        var _token = $("input[name=_token]").val();
//        var val = $(this).val();
//        val = val.replace(/ /g, '');
//
//        if (regex.test(val)) {
//
//        } else {
//
//            return false;
//
//        }
//
//        var input = $(this);
//        var index = $(this).parent().parent().index();
//        index = index;
//        var col = $(this).parent().parent().attr('data-col');
//        var id = $(this).parent().parent().parent().attr('data-id');
//        var org = $(this).parent().parent().parent().attr('data-org');
//        var specializ_id = $(this).parent().parent().parent().attr('data-spec');
//        var td = $(this).parent().parent();
//        var class_name = td.attr('class').split(' ')[1];
//        var total = 0;
//        var first_data = $(".first_data").val();
//
//        $.ajax({
//            url: "/ajax-post-doctor",
//            type: "POST",
//            data: {_token: _token, id: id, val: val, col: col, org: org, specializ_id: specializ_id, first_data: first_data},
//            success: function (response) {
//                if (response == 1) {
//                    val = parseInt(val.toLocaleString().replace(/ /g, ''));
//                    if (isNaN(val)) {
//                        input.val("")
//                    } else {
//                        val = val.toLocaleString().replace(/,/g, " ", );
//                        input.val(val)
//                    }
//
//                    $('.' + class_name + ' .value input').each(function () {
//                        x = $(this).val().replace(/[^0-9\.]+/g, "");
//                        if (x !== "") {
//                            total += parseInt(x);
//                        }
//                    });
//                    total = total.toLocaleString().replace(/,/g, " ", );
//
//                    $('.doctor_stat tr:last-child').find("td:eq(" + index + ")").find(".value").text(total);
//
//                }
//            },
//        });
//    });




    /*  table sum spec */

    var first_consulting_spec = 0;
    var first_therapy_spec = 0;
    var total_therapy_spec = 0;
    var schedule_time_spec = 0;
    var spent_time_spec = 0;
    var turnover_spec = 0;
    var clients_spec = 0;

    $('.spec_stat .first_consulting_spec .value').each(function () {
        if ($(this).text() !== "") {
            first_consulting_spec += parseInt($(this).text().replace(/ /g, ''));
        }
    });

    $('.spec_stat .first_therapy_spec .value').each(function () {
        if ($(this).text() !== "") {
            first_therapy_spec += parseInt($(this).text().replace(/ /g, ''));
        }
    });
    $('.spec_stat .total_therapy_spec .value').each(function () {
        if ($(this).text() !== "") {
            total_therapy_spec += parseInt($(this).text().replace(/ /g, ''));
        }
    });
    $('.spec_stat .schedule_time_spec .value').each(function () {
        if ($(this).text() !== "") {
            schedule_time_spec += parseInt($(this).text().replace(/ /g, ''));
        }
    });
    $('.spec_stat .spent_time_spec .value').each(function () {
        if ($(this).text() !== "") {
            spent_time_spec += parseInt($(this).text().replace(/ /g, ''));
        }
    });
    $('.spec_stat .turnover_spec .value').each(function () {
        if ($(this).text() !== "") {
            turnover_spec += parseInt($(this).text().replace(/ /g, ''));
        }
    });
    $('.spec_stat .clients_spec .value').each(function () {
        if ($(this).text() !== "") {
            clients_spec += parseInt($(this).text().replace(/ /g, ''));
        }
    });

    $('.spec_stat tr:last-child').find("td:eq(0) .value").text(first_consulting_spec.toLocaleString().replace(/,/g, " ", ));
    $('.spec_stat tr:last-child').find("td:eq(1) .value").text(first_therapy_spec.toLocaleString().replace(/,/g, " ", ));
    $('.spec_stat tr:last-child').find("td:eq(2) .value").text(total_therapy_spec.toLocaleString().replace(/,/g, " ", ));
    $('.spec_stat tr:last-child').find("td:eq(3) .value").text(schedule_time_spec.toLocaleString().replace(/,/g, " ", ));
    $('.spec_stat tr:last-child').find("td:eq(4) .value").text(spent_time_spec.toLocaleString().replace(/,/g, " ", ));
    $('.spec_stat tr:last-child').find("td:eq(5) .value").text(turnover_spec.toLocaleString().replace(/,/g, " ", ));
    $('.spec_stat tr:last-child').find("td:eq(6) .value").text(clients_spec.toLocaleString().replace(/,/g, " ", ));



    $(document.body).on('click', '.cancel_admin_stat', function () {

        $(".change_value").each(function () {
            $(this).val("");
        });

    });

    $('.change_value').keypress(function (event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault();
            alert('Все поля должны быть только цифры');
        }

    });
    
    var specializ =  $( "#sel1 option:selected" ).val();
        $("#specializ").val(specializ);
    
    $("#sel1").change(function(){
        var spec =  $( "#sel1 option:selected" ).val();
        $("#specializ").val(spec)

    })
   
    
       $(document.body).on('blur', '.admin_stat .change_value', function () {
        var val = $(this).val();
        var input = $(this);
        val = parseInt(val.toLocaleString().replace(/ /g, ''));
        console.log(val);
        if (isNaN(val)) {
            input.val("")
        } else {
            val = val.toLocaleString().replace(/,/g, " ", );
            input.val(val)
        }
        var index = $(this).parent().parent().index();
        var td = $(this).parent().parent();
        var class_name = td.attr('class').split(' ')[1];

        var total = 0;
        $('.' + class_name + ' .value input').each(function () {

                        x = $(this).val().replace(/[^0-9\.]+/g, "");
                        if (x !== "") {
                            total += parseInt(x);
                        }

                    });
                    total = total.toLocaleString().replace(/,/g, " ", );
                    $('.admin_stat tr:last-child').find("td:eq(" + index + ")").find(".value").text(total);

    });
    
    
       $(document.body).on('blur', '.doctor_stat .change_value', function () {
    
        var val = $(this).val();
        var input = $(this);
        val = parseInt(val.toLocaleString().replace(/ /g, ''));
        if (isNaN(val)) {
            input.val("")
        } else {
            val = val.toLocaleString().replace(/,/g, " ", );
            input.val(val)
        }
        var index = $(this).parent().parent().index();
        var td = $(this).parent().parent();
        var class_name = td.attr('class').split(' ')[1];

        var total = 0;
        $('.' + class_name + ' .value input').each(function () {

                        x = $(this).val().replace(/[^0-9\.]+/g, "");
                        if (x !== "") {
                            total += parseInt(x);
                        }

                    });
                    total = total.toLocaleString().replace(/,/g, " ", );
                     $('.doctor_stat tr:last-child').find("td:eq(" + index + ")").find(".value").text(total);

    });
    


});


