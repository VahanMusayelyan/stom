$(document).ready(function () {

    $(document.body).on('mouseover', '.dropdown_list', function () {
        var dropdown = $(this).parent();

        var _token = $("input[name=_token]").val();
        var value = dropdown.attr("data-value");
        var user_id = dropdown.attr("data-name");
        var org_id = dropdown.attr("data-org");
        $.ajax({
            url: "/ajax-post-list",
            type: "POST",
            data: {_token: _token, value: value, user_id: user_id, org_id: org_id},
            success: function (response) {
                if (response) {
                    var result = JSON.parse(response);
                    var link = '';
                    if (result.length > 0) {

                        if (value == 0) {
                            for (var i = 0; i < result.length; i++) {
                                link += "<a href='/organizations/" + result[i]['id'] + "'>" + result[i]['org_name'] + "</a>";
                            }

                        } else {
                            for (var i = 0; i < result.length; i++) {
                                link += "<a href='/employees/" + result[i]['employee_id'] + "'>" + result[i]['employee_name'] + "</a>";
                            }

                        }

                        if (($(dropdown).find('.dropdown-content').length > 0)) {
                            $(dropdown).find(".dropdown-content").css("display", "block");
                        } else {
                            $(dropdown).append("<div class='dropdown-content'>" + link + "</div>");
                            $(dropdown).find(".dropdown-content").css("display", "block");
                        }

                    } else {
                        $(dropdown).append("<div class='dropdown-content no-one'><span>Никакой клиники нету</span></div>");
                        $(dropdown).find(".dropdown-content").css("display", "block");

                    }




                } else {
                    alert("Повторите еще раз");
                }
            },
        });
    });


    $(".dropdown-content").click(function (event) {
        event.stopPropagation();
    });


    $(document).on('mouseover', function (event) {
        if (!$(event.target).closest('.dropdown-content').length) {
            $(".dropdown-content").css("display", "none");
        }
    });

    $(document).on('click', '.show-pass', function () {
        if ($('.pass').attr('type') !== 'password') {
            $('.pass').attr('type', 'password')
        } else {
            $('.pass').attr('type', 'email')
        }
    });

    $(document.body).on('click', '.preview_user', function () {
        var _token = $("input[name=_token]").val();
        var preview = $(this).attr("data-preview");
        if (preview == 1) {
            return false;
        }
        var td = $(this);
        var tr = $(this).parent().parent();
        var id = $(this).attr("data-id");


        $.ajax({
            url: "/ajax-post-preview",
            type: "POST",
            data: {_token: _token, id: id},
            success: function (response) {
                if (response == 1) {
                    td.attr("data-preview", "1");
                    tr.removeClass("no-preview");
                    tr.addClass("preview");
                }

            },

        });


    });





    $('#example7').calendar({
        type: 'month',
        onChange: function (date, text) {
            var _token = $("input[name=_token]").val();
            var first_data = text;
            var specialization = $("select.selectpicker").val();
            $("#data_dirst_input_doc").val(first_data);

            $.ajax({
                url: "/ajax-post-statdoctor",
                type: "POST",
                data: {_token: _token, first_data: first_data, specialization: specialization},
                success: function (response) {
                    if (response) {
                        var result = JSON.parse(response);
                        $("table.table.table-value.table1.doctor_stat  tbody").empty();
                      
                        var statistic_doc = result['statistic_doc'];
                        var employee_doctor = result['employee_doctor'];

                        result['employee_doctor'].forEach(function (empoyeevalue, keyemp) {

                            if (statistic_doc[empoyeevalue['id']] !== undefined) {
                               
                                if(statistic_doc[empoyeevalue['id']]['first_consulting'] !== null){
                                    var first_consulting = statistic_doc[empoyeevalue['id']]['first_consulting'];
                                    first_consulting = parseInt(first_consulting.toLocaleString().replace(/ /g, ''));
                                    first_consulting = first_consulting.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    first_consulting ='';
                                }
                                
                                if(statistic_doc[empoyeevalue['id']]['first_therapy'] !== null){
                                    var first_therapy = statistic_doc[empoyeevalue['id']]['first_therapy'];
                                    first_therapy = parseInt(first_therapy.toLocaleString().replace(/ /g, ''));
                                    first_therapy = first_therapy.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    first_therapy ='';
                                }
                                
                                if(statistic_doc[empoyeevalue['id']]['total_therapy'] !== null){
                                    var total_therapy = statistic_doc[empoyeevalue['id']]['total_therapy'];
                                    total_therapy = parseInt(total_therapy.toLocaleString().replace(/ /g, ''));
                                    total_therapy = total_therapy.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    total_therapy ='';
                                }
                                if(statistic_doc[empoyeevalue['id']]['schedule_time'] !== null){
                                    var schedule_time = statistic_doc[empoyeevalue['id']]['schedule_time'];
                                    schedule_time = parseInt(schedule_time.toLocaleString().replace(/ /g, ''));
                                    schedule_time = schedule_time.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    schedule_time ='';
                                }
                                if(statistic_doc[empoyeevalue['id']]['spent_time'] !== null){
                                    var spent_time = statistic_doc[empoyeevalue['id']]['spent_time'];
                                    spent_time = parseInt(spent_time.toLocaleString().replace(/ /g, ''));
                                    spent_time = spent_time.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    spent_time ='';
                                }
                                if(statistic_doc[empoyeevalue['id']]['turnover'] !== null){
                                    var turnover = statistic_doc[empoyeevalue['id']]['turnover'];
                                    turnover = parseInt(turnover.toLocaleString().replace(/ /g, ''));
                                    turnover = turnover.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    turnover ='';
                                }
                                if(statistic_doc[empoyeevalue['id']]['clients'] !== null){
                                    var clients = statistic_doc[empoyeevalue['id']]['clients'];
                                    clients = parseInt(clients.toLocaleString().replace(/ /g, ''));
                                    clients = clients.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    clients ='';
                                }
                                
                               
                                $("table.table.table-value.table1.doctor_stat  tbody").append("<tr>\n\
                                <td scope='row' class='color_th'>" + empoyeevalue['employee_name'] + "<input hidden='hidden' name='colum_number[]' value='"+empoyeevalue['id']+"'><input hidden='hidden' name='specializ[]' value='"+empoyeevalue['specializ_id']+"'></td>\n\
                                <td class='statistic_doc first_consulting'><div class='value'><input name='first_consulting[]' class='change_value change_value_doctor' value='"+first_consulting+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc first_therapy'><div class='value'><input name='first_therapy[]' class='change_value change_value_doctor' value='"+first_therapy+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc total_therapy'><div class='value'><input name='total_therapy[]' class='change_value change_value_doctor' value='"+total_therapy+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc schedule_time'><div class='value'><input name='schedule_time[]' class='change_value change_value_doctor' value='"+schedule_time+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc spent_time'><div class='value'><input name='spent_time[]' class='change_value change_value_doctor' value='"+spent_time+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc turnover'><div class='value'><input name='turnover[]' class='change_value change_value_doctor' value='"+turnover+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc clients'><div class='value'><input name='clients[]' class='change_value change_value_doctor' value='"+clients+"' autocomplete='off'></div></td>\n\
                                <td class='specializ'>" + empoyeevalue['specialization'] + "</td></tr>");
                            } else {
                                $("table.table.table-value.table1.doctor_stat  tbody").append("<tr>\n\
                                <td scope='row' class='color_th'>" + empoyeevalue['employee_name'] + "<input hidden='hidden' name='colum_number[]' value='"+empoyeevalue['id']+"'><input hidden='hidden' name='specializ[]' value='"+empoyeevalue['specializ_id']+"'></td>\n\
                                <td class='statistic_doc first_consulting'><div class='value'><input name='first_consulting[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc first_therapy'><div class='value'><input name='first_therapy[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc total_therapy'><div class='value'><input name='total_therapy[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc schedule_time'><div class='value'><input name='schedule_time[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc spent_time'><div class='value'><input name='spent_time[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc turnover'><div class='value'><input name='turnover[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc clients'><div class='value'><input name='clients[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='specializ'>" + empoyeevalue['specialization'] + "</td></tr>");
                            }

                        });

                        $("table.table.table-value.table1.doctor_stat  tbody").append("<tr class='total'><td scope='row' class='color_th'>Всего</td></tr>");
                        
                        for (j = 0; j < 8; j++) {
                            if(j == 7){
                                 $("table.table.table-value.table1.doctor_stat tbody tr:last-child").append("<td class='color_th'>---------------</td>");
                            }else{
                                 $("table.table.table-value.table1.doctor_stat tbody tr:last-child").append("<td class='color_th'><div class='value'></div></td>");
                            }
                           
                        }
                        
                        sumstatdoc();                 
             

                    } else {
                        alert("Повторите еще раз");
                    }
                },
            });


        },
    });



    

    $('#example8').calendar({
        type: 'month',
        onChange: function (date, text) {
            var _token = $("input[name=_token]").val();
            var first_data = text;
            var specialization = $("select.selectpicker").val();
            $("#data_dirst_input").val(first_data);
            $.ajax({
                url: "/ajax-post-statadmin",
                type: "POST",
                data: {_token: _token, first_data: first_data, specialization: specialization},
                success: function (response) {
                    if (response) {
                        var result = JSON.parse(response);
                        $("table.table.table-value.table1.admin_stat  tbody").empty();
                      
                        var statistic_admin = result['statistic_admin'];
                        var employee_admin = result['employee_admin'];


                        result['employee_admin'].forEach(function (empoyeevalue, keyemp) {

                            if (statistic_admin[empoyeevalue['id']] !== undefined) {
                               
                                if(statistic_admin[empoyeevalue['id']]['first_patient'] !== null){
                                    var first_patient = statistic_admin[empoyeevalue['id']]['first_patient'];
                                    first_patient = parseInt(first_patient.toLocaleString().replace(/ /g, ''));
                                    first_patient = first_patient.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    first_patient ='';
                                }
                                
                                if(statistic_admin[empoyeevalue['id']]['recorded_patient'] !== null){
                                    var recorded_patient = statistic_admin[empoyeevalue['id']]['recorded_patient'];
                                    recorded_patient = parseInt(recorded_patient.toLocaleString().replace(/ /g, ''));
                                    recorded_patient = recorded_patient.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    recorded_patient ='';
                                }
                                
                                if(statistic_admin[empoyeevalue['id']]['final_patient'] !== null){
                                    var final_patient = statistic_admin[empoyeevalue['id']]['final_patient'];
                                    final_patient = parseInt(final_patient.toLocaleString().replace(/ /g, ''));
                                    final_patient = final_patient.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    final_patient ='';
                                }
                               
    
                                $("table.table.table-value.table1.admin_stat  tbody").append("<tr>\n\
                                <td scope='row' class='color_th'>" + empoyeevalue['employee_name'] + "<input hidden='hidden' name='colum_number[]' value='"+empoyeevalue['id']+"' autocomplete='off'></td>\n\
                                <td class='statistic first_patient'><div class='value'><input name='first_patient[]' class='change_value change_value_doctor' value='"+first_patient+"' autocomplete='off'></div></td>\n\
                                <td  class='statistic recorded_patient'><div class='value'><input name='recorded_patient[]' class='change_value change_value_doctor' value='"+recorded_patient+"' autocomplete='off'></div></td>\n\
                                <td  class='statistic final_patient'><div class='value'><input name='final_patient[]' class='change_value change_value_doctor' value='"+final_patient+"' autocomplete='off'></div></td></tr>");
                            } else {
                                $("table.table.table-value.table1.admin_stat  tbody").append("<tr>\n\
                                <td scope='row' class='color_th'>" + empoyeevalue['employee_name'] + "<input hidden='hidden' name='colum_number[]' value='"+empoyeevalue['id']+"'></td>\n\
                                <td class='statistic first_patient'><div class='value'><input name='first_patient[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic recorded_patient'><div class='value'><input name='recorded_patient[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic final_patient'><div class='value'><input name='final_patient[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td></tr>");
                            }

                        });

                        $("table.table.table-value.table1.admin_stat  tbody").append("<tr class='total'><td scope='row' class='color_th'>Всего</td></tr>");
                        
                        for (j = 0; j < 3; j++) {
                            
                                 $("table.table.table-value.table1.admin_stat tbody tr:last-child").append("<td class='color_th'><div class='value'></div></td>");
                            
                           
                        }
                        
                        
                        sumstatadmin();                 
             

                    } else {
                        alert("Повторите еще раз");
                    }
                },
            });
        },
    });

$('select').on('change', function (e) {
            var _token = $("input[name=_token]").val();
            var first_data = $(".first_data").val();
            var specialization = $(this).val();
            
            $.ajax({
                url: "/ajax-post-statdoctor",
                type: "POST",
                data: {_token: _token, first_data: first_data, specialization: specialization},
                success: function (response) {
                    if (response) {
                        var result = JSON.parse(response);
                        $("table.table.table-value.table1.doctor_stat  tbody").empty();
                      
                        var statistic_doc = result['statistic_doc'];
                        var employee_doctor = result['employee_doctor'];

                        result['employee_doctor'].forEach(function (empoyeevalue, keyemp) {

                            if (statistic_doc[empoyeevalue['id']] !== undefined) {
                               
                                if(statistic_doc[empoyeevalue['id']]['first_consulting'] !== null){
                                    var first_consulting = statistic_doc[empoyeevalue['id']]['first_consulting'];
                                    first_consulting = parseInt(first_consulting.toLocaleString().replace(/ /g, ''));
                                    first_consulting = first_consulting.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    first_consulting ='';
                                }
                                
                                if(statistic_doc[empoyeevalue['id']]['first_therapy'] !== null){
                                    var first_therapy = statistic_doc[empoyeevalue['id']]['first_therapy'];
                                    first_therapy = parseInt(first_therapy.toLocaleString().replace(/ /g, ''));
                                    first_therapy = first_therapy.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    first_therapy ='';
                                }
                                
                                if(statistic_doc[empoyeevalue['id']]['total_therapy'] !== null){
                                    var total_therapy = statistic_doc[empoyeevalue['id']]['total_therapy'];
                                    total_therapy = parseInt(total_therapy.toLocaleString().replace(/ /g, ''));
                                    total_therapy = total_therapy.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    total_therapy ='';
                                }
                                if(statistic_doc[empoyeevalue['id']]['schedule_time'] !== null){
                                    var schedule_time = statistic_doc[empoyeevalue['id']]['schedule_time'];
                                    schedule_time = parseInt(schedule_time.toLocaleString().replace(/ /g, ''));
                                    schedule_time = schedule_time.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    schedule_time ='';
                                }
                                if(statistic_doc[empoyeevalue['id']]['spent_time'] !== null){
                                    var spent_time = statistic_doc[empoyeevalue['id']]['spent_time'];
                                    spent_time = parseInt(spent_time.toLocaleString().replace(/ /g, ''));
                                    spent_time = spent_time.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    spent_time ='';
                                }
                                if(statistic_doc[empoyeevalue['id']]['turnover'] !== null){
                                    var turnover = statistic_doc[empoyeevalue['id']]['turnover'];
                                    turnover = parseInt(turnover.toLocaleString().replace(/ /g, ''));
                                    turnover = turnover.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    turnover ='';
                                }
                                if(statistic_doc[empoyeevalue['id']]['clients'] !== null){
                                    var clients = statistic_doc[empoyeevalue['id']]['clients'];
                                    clients = parseInt(clients.toLocaleString().replace(/ /g, ''));
                                    clients = clients.toLocaleString().replace(/,/g, " ", );
                                }else{
                                    clients ='';
                                }
                                
                               
                                $("table.table.table-value.table1.doctor_stat  tbody").append("<tr>\n\
                                <td scope='row' class='color_th'>" + empoyeevalue['employee_name'] + "<input hidden='hidden' name='colum_number[]' value='"+empoyeevalue['id']+"'><input hidden='hidden' name='specializ[]' value='"+empoyeevalue['specializ_id']+"'></td>\n\
                                <td class='statistic_doc first_consulting'><div class='value'><input name='first_consulting[]' class='change_value change_value_doctor' value='"+first_consulting+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc first_therapy'><div class='value'><input name='first_therapy[]' class='change_value change_value_doctor' value='"+first_therapy+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc total_therapy'><div class='value'><input name='total_therapy[]' class='change_value change_value_doctor' value='"+total_therapy+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc schedule_time'><div class='value'><input name='schedule_time[]' class='change_value change_value_doctor' value='"+schedule_time+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc spent_time'><div class='value'><input name='spent_time[]' class='change_value change_value_doctor' value='"+spent_time+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc turnover'><div class='value'><input name='turnover[]' class='change_value change_value_doctor' value='"+turnover+"' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc clients'><div class='value'><input name='clients[]' class='change_value change_value_doctor' value='"+clients+"' autocomplete='off'></div></td>\n\
                                <td class='specializ'>" + empoyeevalue['specialization'] + "</td></tr>");
                            } else {
                                $("table.table.table-value.table1.doctor_stat  tbody").append("<tr>\n\
                                <td scope='row' class='color_th'>" + empoyeevalue['employee_name'] + "<input hidden='hidden' name='colum_number[]' value='"+empoyeevalue['id']+"'><input hidden='hidden' name='specializ[]' value='"+empoyeevalue['specializ_id']+"'></td>\n\
                                <td class='statistic_doc first_consulting'><div class='value'><input name='first_consulting[]' class='change_value change_value_doctor' value='' autocomplete='off' ></div></td>\n\
                                <td class='statistic_doc first_therapy'><div class='value'><input name='first_therapy[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc total_therapy'><div class='value'><input name='total_therapy[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc schedule_time'><div class='value'><input name='schedule_time[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc spent_time'><div class='value'><input name='spent_time[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc turnover'><div class='value'><input name='turnover[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='statistic_doc clients'><div class='value'><input name='clients[]' class='change_value change_value_doctor' value='' autocomplete='off'></div></td>\n\
                                <td class='specializ'>" + empoyeevalue['specialization'] + "</td></tr>");
                            }

                        });

                        $("table.table.table-value.table1.doctor_stat  tbody").append("<tr class='total'><td scope='row' class='color_th'>Всего</td></tr>");
                        
                        for (j = 0; j < 8; j++) {
                            if(j == 7){
                                 $("table.table.table-value.table1.doctor_stat tbody tr:last-child").append("<td class='color_th'>---------------</td>");
                            }else{
                                 $("table.table.table-value.table1.doctor_stat tbody tr:last-child").append("<td class='color_th'><div class='value'></div></td>");
                            }
                           
                        }
                        
                        sumstatdoc();                 
             

                    } else {
                        alert("Повторите еще раз");
                    }
                },
            });

});






});

function confirmationDelete(anchor)
{
    var conf = confirm('Вы уверены, что хотите удалить?');
    if (conf)
        window.location = anchor.attr("href");
}

function confirmationDeleteEmployee(anchor)
{
    var conf = confirm('Вы уверены, что хотите удалить?');
    if (conf)
        window.location = anchor.attr("href");
}



function sumstatdoc(){
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

}


function sumstatadmin(){
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
}