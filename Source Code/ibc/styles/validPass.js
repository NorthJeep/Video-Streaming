$('#new_pass').on('keyup', function(){
    var passval = $(this).val();
    if(passval.length == 0){
      $('#div_pass').removeClass('has-error');
      $('#div_pass').removeClass('has-success');
      $('#pass_msg').text('');
      $('#submit_newpass').prop('disabled', true);
    }else if(passval.length < 8){
      $('#div_pass').addClass('has-error');
      $('#div_pass').removeClass('has-success');
      $('#pass_msg').text('Password must have at least 8 characters.');
      $('#submit_newpass').prop('disabled', true);
    } else {
      $('#div_pass').addClass('has-success');
      $('#div_pass').removeClass('has-error');
      $('#pass_msg').text('Password has more than 8 characters.');
      $('#submit_newpass').prop('disabled', false);
    }
  });