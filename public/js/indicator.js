$(document).ready(function () {

    $(document.body).on('click', '.admin_indicator .value', function () {
      $(this).parent().find(".drop_down_icon").css("display","block");
      $(this).parent().find(".formule").css("display","block");
    });
    
    $(document.body).on('click', '.admin_indicator .value', function (event) { 
        event.stopPropagation();
    });


    $(document).on('click', function (event) {
        if (!$(event.target).closest('.admin_indicatort').length) {
            $(".drop_down_icon").css("display", "none");
            $(".formule").css("display", "none");
        }
    });
    
    $(document.body).on('click', '.doctor_indicator .value', function () {
      $(this).parent().find(".drop_down_icon").css("display","block");
      $(this).parent().find(".formule").css("display","block");
    });
    
    $(document.body).on('click', '.doctor_indicator .value', function (event) { 
        event.stopPropagation();
    });


    $(document).on('click', function (event) {
        if (!$(event.target).closest('.spec_indicator').length) {
            $(".drop_down_icon").css("display", "none");
            $(".formule").css("display", "none");
        }
    });
    
    
    
    $(document.body).on('click', '.spec_indicator .value', function () {
      $(this).parent().find(".drop_down_icon").css("display","block");
      $(this).parent().find(".formule").css("display","block");
    });
    
    $(document.body).on('click', '.spec_indicator .value', function (event) { 
        event.stopPropagation();
    });


    $(document).on('click', function (event) {
        if (!$(event.target).closest('.spec_indicator').length) {
            $(".drop_down_icon").css("display", "none");
            $(".formule").css("display", "none");
        }
    });

});