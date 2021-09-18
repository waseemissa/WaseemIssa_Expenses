$(document).ready(function(){
  
    $("#input_first_name").hover(function(){
      $("#first_name").text("First Name: at least 3 characters");
    });
  
    $("#input_last_name").hover(function(){
      $("#last_name").text("Last Name: at least 3 characters");
    });
  
    $("#input_email").hover(function(){
      $("#email").text("Email: name@example.com");
    });
  
    $("#input_date_of_birth").hover(function(){
      $("#date_of_birth").text("Date of Birth: d-m-Y");
    });
  
  
    $("#input_password").hover(function(){
      $("#password").text("Password: at least 8 characters");
    });
   
    $("#input_confirm_password").hover(function(){
      $("#confirm_password").text("Confirm Password: Should match password");
    });
  
    //hints
  
    //show errors
    
  
    $('.alert').alert();
  
    $("#btn-submit").click(function(){
      $('.alert').alert('close')
    });
  
  });