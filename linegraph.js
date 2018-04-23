$(document).ready(function(){
  $.ajax({
    url : "http://localhost/SintoriSportsWebsite/report_payment.php",
    type : "GET",
    success : function(data){
      console.log(data);
    },
    error : function(data){

    }
  });
});
