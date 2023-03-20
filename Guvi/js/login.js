function loginUser() {
    var formData = $('#form2').serialize();
    $.ajax({
      type: 'POST',
      url: 'php/login.php',
      data: formData,
      dataType: 'json',
      encode: true
    })
    .done(function(data) {
      console.log(data);
      if(data.success) {
        window.location.replace("profile.html");
        alert('password or email invalid')
      } else {
        alert(data.error);
      }
    });
  }
  
  $(document).ready(function() {
    $('#form2').submit(function(event) {
      event.preventDefault();
      loginUser();
    });
  });