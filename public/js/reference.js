$(document).ready(function () {
//
//    $(document.body).on('dblclick', '.reference_admin td.conversion', function () {
//        var input = $('.reference_admin td.conversion').find('input');
//        if (input.length > 0) {
//            alert("PLEASE FILL OPENED INPUTS");
//            return false;
//        } else {
//            var td = $(this).find('div span').first().text();
//            var prop = $(this).find('span.property').text();
//            $(this).empty();
//            $(this).append("<input class='change_value' value='" + td + "'><span class='property'>" + prop + "</span>");
//
//        }
//    });

//    $(document.body).on('dblclick', '.reference_doctor td.reference', function () {
//        var input = $('.reference_doctor td.reference').find('input');
//        if (input.length > 0) {
//            alert("PLEASE FILL OPENED INPUTS");
//            return false;
//        } else {
//            var td = $(this).find('div span').first().text();
//            var prop = $(this).find('span.property').text();
//            $(this).empty();
//            $(this).append("<input class='change_value' value='" + td + "'><span class='property'>" + prop + "</span>");
//
//        }
//    });



    $(document.body).on('blur', '.reference_admin td.conversion .value input', function () {
	
        var _token = $("input[name=_token]").val();
        var val = $(this).val();
		var input = $(this);
        var prop = $(this).next('span.property').text();
        val = val.replace(/ /g, '');
        var id = $(this).parent().parent().parent().attr('data-number');
        var city = $(this).parent().parent().parent().attr('data-city');
        var class_name = $(this).parent().parent().parent().attr('data-class');
        var specializ = $(this).parent().parent().parent().attr('data-specializ');
        var td = $(this).parent().parent();
        var col = td.attr('class').split(' ')[1];

		
        $.ajax({
            url: "/ajax-post-refadmin",
            type: "POST",
            data: {_token: _token, id: id, val: val, col: col, city: city, class_name: class_name, specializ: specializ},
            success: function (response) {
                if (response) {
                    val = parseInt(val.toLocaleString().replace(/ /g, ''));
                    if (isNaN(val)) {
                        input.val("")
                    } else {
                        val = val.toLocaleString().replace(/,/g, " ", );
                        input.val(val);
                    }
                    td.parent().attr("data-number", "number_" + response);
                    class_name = td.parent().attr('class');
                    $("." + class_name).attr("data-number", "number_" + response);
                   
                }
            },
        });
    });





    $(document.body).on('blur', '.reference_doctor td.reference .change_value', function () {
        var _token = $("input[name=_token]").val();
        var val = $(this).val();
	var input = $(this);
        var prop = $(this).next('span.property').text();
        val = val.replace(/ /g, '');
        var id = $(this).parent().parent().parent().attr('data-number');
        var city = $(this).parent().parent().parent().attr('data-city');
        var class_name = $(this).parent().parent().parent().attr('data-class');
        var specializ = $(this).parent().parent().parent().attr('data-specializ');
        var td = $(this).parent().parent();
        var col = td.attr('class').split(' ')[1];
		

        $.ajax({
            url: "/ajax-post-refdoctor",
            type: "POST",
            data: {_token: _token, id: id, val: val, col: col, city: city, class_name: class_name, specializ: specializ},
            success: function (response) {
                if (response) {
                    val = parseInt(val.toLocaleString().replace(/ /g, ''));
                    if (isNaN(val)) {
                        input.val("")
                    } else {
                        val = val.toLocaleString().replace(/,/g, " ", );
                        input.val(val);
                    }
                    td.parent().attr("data-number", "number_" + response);
                    class_name = td.parent().attr('class');
                    $("." + class_name).attr("data-number", "number_" + response);
                    
                }
            },
        });
    });





});
