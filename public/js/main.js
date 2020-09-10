$(document).ready(function(){
    
 $('.js-example-basic-multiple').select2();
 $('.js-example-basic-single').select2();

$('#org_edit').select2({
    placeholder: "Select Clinics",
    allowClear: true
});
$('#org_add').select2({
    placeholder: "Select Clinics",
    allowClear: true
});

$(".status").click(function(event){
      radio = $(this).find('input');
      _token = $("input[name=_token]").val()
      id = $(this).find('input').attr("data-id");
      value = $(this).find('input').val();

      $.ajax({
        url: "/ajax-post",
        type:"POST",
        data:{_token: _token,id:id,value:value},
        success:function(response){
          if(response == 1) {
           radio.attr("checked","checked");
           
          }
      },
       });
  });
  
$(".status_user").click(function(event){
      radio = $(this).find('input');
      _token = $("input[name=_token]").val()
      id = $(this).find('input').attr("data-id");
      value = $(this).find('input').val();

      $.ajax({
        url: "/ajax-post-user",
        type:"POST",
        data:{_token: _token,id:id,value:value},
        success:function(response){
          if(response == 1) {
           radio.attr("checked","checked");
           
          }
      },
       });
  });

    
    
});