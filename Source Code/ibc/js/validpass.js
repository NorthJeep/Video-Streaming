      function showPass() {
      var obj = document.getElementById('curr_pass');
      obj.type = "text";
      document.getElementById('icon_curr').className = 'icon-eye-close';
    }
    function hidePass() {
      var obj = document.getElementById('curr_pass');
      obj.type = "password";
      document.getElementById('icon_curr').className = 'icon-eye-open';
    }

    function showPass2() {
      var obj = document.getElementById('chng_pass');
      obj.type = "text";
      document.getElementById('icon_chng').className = 'icon-eye-close';
    }
    function hidePass2() {
      var obj = document.getElementById('chng_pass');
      obj.type = "password";
      document.getElementById('icon_chng').className = 'icon-eye-open';
    }

    function showPass3() {
      var obj = document.getElementById('re_pass');
      obj.type = "text";
      document.getElementById('icon_re').className = 'icon-eye-close';
    }
    function hidePass3() {
      var obj = document.getElementById('re_pass');
      obj.type = "password";
      document.getElementById('icon_re').className = 'icon-eye-open';
    }

  $('#chng_pass').on('keyup', function(){
    var passval = $(this).val();
    var pattern = /^(?=.*[a-z])(?=.*[0-9])(?!.*[A-Z])(?!.*\W)(?!.*\s).+$/g;

    if(passval.length == 0){
      $('#div_pass').removeClass('has-error');
      $('#div_pass').removeClass('has-success');
      $('#pass_msg').text('The password must contain at lease one lowercase letter, one number, and be at least 6 characters long.');
    } else if(passval.length < 6){
      $('#div_pass').addClass('has-error');
      $('#div_pass').removeClass('has-success');
      $('#pass_msg').text('Password must have at least 6 characters.');
    } else if(passval.length > 6) {
        if(pattern.test(passval) == false){
          $('#div_pass').addClass('has-error');
          $('#div_pass').removeClass('has-success');
          $('#pass_msg').text('Password lacks of required characters.');
        } else {
          $('#div_pass').addClass('has-success');
          $('#div_pass').removeClass('has-error');
          $('#pass_msg').text('Password accepted.');
        }
    }
  });

  $('#re_pass').on('keyup', function(){
    var preval = $(this).val();
    var passval = $('#chng_pass').val();
    if(preval != passval){
      $('#div_pass2').addClass('has-error');
      $('#div_pass2').removeClass('has-success');
      $('#pass_msg2').text('Re-type did not match to what you entered.');
    } else {
        if(passval.length == 0){
          $('#div_pass2').removeClass('has-error');
          $('#div_pass2').removeClass('has-success');
          $('#pass_msg2').text('');
        } else {
          $('#div_pass2').addClass('has-success');
          $('#div_pass2').removeClass('has-error');
          $('#pass_msg2').text('Passwords matched.');
        }
    }
  });

  $('#form_pass').submit(function(e){
    var preval = $('#re_pass').val();
    var passval = $('#chng_pass').val();
    if(preval != passval){
      alert('Re-type did not match to what you entered.');
      e.preventDefault();
    }
  });