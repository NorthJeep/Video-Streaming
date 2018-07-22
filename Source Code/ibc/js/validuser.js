      $('#user_name').on('keyup', function(){
        var s_uname = $(this).val();
        var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?!.*[0-9])(?!.*\W)(?!.*\s).+$/g;

        if(s_uname.length == 0){
          $('#div_uname').removeClass('has-error');
          $('#div_uname').removeClass('has-success');
          $('#uname_msg').text('The username must contain at lease one lowercase letter, one uppercase letter, and be at least 8 characters long.');
        }else if(s_uname.length < 8){
          $('#div_uname').addClass('has-error');
          $('#div_uname').removeClass('has-success');
          $('#uname_msg').text('Username must have more than 8 characters.');
        } else {
          if(pattern.test(s_uname) == false){
            $('#div_uname').addClass('has-error');
            $('#div_uname').removeClass('has-success');
            $('#uname_msg').text('The username lacks of required characters.');
          } else {

              $.ajax({
                url: 'check_uname.php',
                type: "POST",
                data: {uname: s_uname},
                success: function(data){
                  if(data == '1'){
                    $('#div_uname').addClass('has-error');
                    $('#div_uname').removeClass('has-success');
                    $('#uname_msg').text('Username already taken.');
                  } else if(data == '0'){
                    $('#div_uname').addClass('has-success');
                    $('#div_uname').removeClass('has-error');
                    $('#uname_msg').text('Username not taken.');
                  }
                }
              });

          }        
        }

      });

      $('#new_pass').on('keyup', function(){
        var passval = $(this).val();
        var pattern = /^(?=.*[a-z])(?=.*[0-9])(?!.*[A-Z])(?!.*\W)(?!.*\s).+$/g;

        if(passval.length == 0){
          $('#div_pass2').removeClass('has-error');
          $('#div_pass2').removeClass('has-success');
          $('#pass_msg2').text('The password must contain at lease one lowercase letter, one number, and be at least 6 characters long.');
        } else if(passval.length < 6){
          $('#div_pass2').addClass('has-error');
          $('#div_pass2').removeClass('has-success');
          $('#pass_msg2').text('Password must have at least 6 characters.');
        } else if(passval.length > 6) {
            if(pattern.test(passval) == false){
              $('#div_pass2').addClass('has-error');
              $('#div_pass2').removeClass('has-success');
              $('#pass_msg2').text('Password lacks of required characters.');
            } else {
              $('#div_pass2').addClass('has-success');
              $('#div_pass2').removeClass('has-error');
              $('#pass_msg2').text('Password accepted.');
            }
        }
      });

    function showPassU() {
      var obj = document.getElementById('new_pass');
      obj.type = "text";
      document.getElementById('icon_new').className = 'icon-eye-close';
    }
    function hidePassU() {
      var obj = document.getElementById('new_pass');
      obj.type = "password";
      document.getElementById('icon_new').className = 'icon-eye-open';
    }

    function showPassU2() {
      var obj = document.getElementById('new_pass2');
      obj.type = "text";
      document.getElementById('icon_new2').className = 'icon-eye-close';
    }
    function hidePassU2() {
      var obj = document.getElementById('new_pass2');
      obj.type = "password";
      document.getElementById('icon_new2').className = 'icon-eye-open';
    }