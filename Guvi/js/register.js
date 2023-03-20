function registerUser() {
    var formData = $('#form1').serialize();
    
    $.ajax({
      type: 'POST',
      url: 'php/register.php',
      data: formData,
      dataType: 'json',
      encode: true
    })
    .done(function(data) {
      console.log(data);
      if(data.success) {
        window.location.replace("login.html");
        alert('Sign Up Successful')
      } else {
        alert(data.error);
      }
    });
  }
  
  $(document).ready(function() {
    $('#form1').submit(function(event) {
      event.preventDefault();
      registerUser();
    });
  });