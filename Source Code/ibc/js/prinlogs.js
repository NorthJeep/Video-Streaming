      $(document).ready(function(){

        $('#ins_filter').on('click', function(){
          var from_val = $('#ins_from').val();
          var to_val = $('#ins_to').val();
          var lg_type = $('#log_type_ins').find(':selected').val();

          if(new Date(from_val) > new Date(to_val)){
            alert('Please select a proper range of dates.');
          } else {
            $.ajax({
                url: "log_filter.php",
                type: "POST",
                data: {date_from: from_val, date_to: to_val, type: 'INSERT', log_type: lg_type},
                beforeSend: function(){
                  $('#ins_table_tb').html('<td colspan="6"><center><em>Loading...</em></center></td>');
                },
                success: function(data){
                  $('#ins_table_tb').html(data);
                }
            });
          }

        });

        $('#ins_print').on('click', function(){
          var from_val = $('#ins_from').val();
          var to_val = $('#ins_to').val();
          var lg_type = $('#log_type_ins').find(':selected').val();

          if(new Date(from_val) > new Date(to_val)){
            alert('Please select a proper range of dates.');
          } else {
            $.ajax({
                url: "log_print.php",
                type: "POST",
                data: {date_from: from_val, date_to: to_val, type: 'INSERT', log_type: lg_type},
                success: function(data){
                  var WindowObject = window.open("", "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
                  WindowObject.document.writeln(data);
                  WindowObject.focus();
                  WindowObject.print();
                  WindowObject.close();
                }
            });
          }

        });

        $('#upd_filter').on('click', function(){
          var from_val2 = $('#upd_from').val();
          var to_val2 = $('#upd_to').val();
          var lg_type2 = $('#log_type_upd').find(':selected').val();

          if(new Date(from_val2) > new Date(to_val2)){
            alert('Please select a proper range of dates.');
          } else {
              $.ajax({
                url: "log_filter.php",
                type: "POST",
                data: {date_from: from_val2, date_to: to_val2, type: 'UPDATE', log_type: lg_type2},
                beforeSend: function(){
                  $('#upd_table_tb').html('<td colspan="6"><center><em>Loading...</em></center></td>');
                },
                success: function(data){
                  $('#upd_table_tb').html(data);
                }
            });
          }

        });

        $('#upd_print').on('click', function(){
          var from_val = $('#upd_from').val();
          var to_val = $('#upd_to').val();
          var lg_type = $('#log_type_upd').find(':selected').val();

          if(new Date(from_val) > new Date(to_val)){
            alert('Please select a proper range of dates.');
          } else {
              $.ajax({
                url: "log_print.php",
                type: "POST",
                data: {date_from: from_val, date_to: to_val, type: 'UPDATE', log_type: lg_type},
                success: function(data){
                  var WindowObject = window.open("", "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
                  WindowObject.document.writeln(data);
                  WindowObject.focus();
                  WindowObject.print();
                  WindowObject.close();
                }
            });
          }
        });

        $('#del_filter').on('click', function(){
          var from_val3 = $('#del_from').val();
          var to_val3 = $('#del_to').val();
          var lg_type3 = $('#log_type_del').find(':selected').val();

          if(new Date(from_val3) > new Date(to_val3)){
            alert('Please select a proper range of dates.');
          } else {
              $.ajax({
                url: "log_filter.php",
                type: "POST",
                data: {date_from: from_val3, date_to: to_val3, type: 'DELETE', log_type: lg_type3},
                beforeSend: function(){
                  $('#del_table_tb').html('<td colspan="6"><center><em>Loading...</em></center></td>');
                },
                success: function(data){
                  $('#del_table_tb').html(data);
                }
            });
          }

        });

        $('#del_print').on('click', function(){
          var from_val = $('#del_from').val();
          var to_val = $('#del_to').val();
          var lg_type = $('#log_type_del').find(':selected').val();

          if(new Date(from_val) > new Date(to_val)){
            alert('Please select a proper range of dates.');
          } else {
              $.ajax({
                url: "log_print.php",
                type: "POST",
                data: {date_from: from_val, date_to: to_val, type: 'DELETE', log_type: lg_type},
                success: function(data){
                  var WindowObject = window.open("", "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
                  WindowObject.document.writeln(data);
                  WindowObject.focus();
                  WindowObject.print();
                  WindowObject.close();
                }
            });
          }
        });

      });