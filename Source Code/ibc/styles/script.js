function changeColor(color){
      var color = color.value;
      document.getElementById('prev_color').style.color = color;
    }
    function changeBg(color){
      var color = color.value;
      document.getElementById('prev_bg').style.color = color;
    }
    function changeEmT(color){
      var color = color.value;
      document.getElementById('prev_emt').style.color = color;
    }

    $('#sec_mute').change(function() {
      if ($(this).is(':checked')) {
        $('#get_mute').val('checked');
      } else {
        $('#get_mute').val('unchecked');
      }
    });

    $('#sec_mute2').change(function() {
      if ($(this).is(':checked')) {
        $('#get_mute2').val('checked');
      } else {
        $('#get_mute2').val('unchecked');
      }
    });

    $('#reloadDisp').on('click', function(){
        $.ajax({
            url: "refresh.php",
            type: "POST",
            data: {'rf': '1'}
        });
    });

    $("form").submit(function () {
      $.ajax({
            url: "refresh.php",
            type: "POST",
            data: {'rf': '1'}
        });
    });

    $(function() {
        $("td[colspan=3]").find("div").hide();
        $(".shet").click(function(event) {
            event.stopPropagation();
            var $target = $(event.target);
            if ( $target.closest("td").attr("colspan") > 1 ) {
                $target.slideUp();
            } else {
                $target.closest("tr").next().find("div").slideToggle();
            }                    
        });
    });

    $('#selectall').change(function() {
      var checkboxes = $(this).closest('form').find(':checkbox');
      if($(this).is(':checked')) {
          checkboxes.prop('checked', true);
          $("#count_sel").text("All files selected."); 
      } else {
          checkboxes.prop('checked', false);
          $("#count_sel").text("No file selected."); 
      }
  });

    $('input[name="checkbox[]"]').click(function() {
      var total = $('input[name="checkbox[]"]:checked').length;
      var all = ($('input[name="checkbox[]"]').length);
      if(total == 0){
        $("#count_sel").text("No file selected.");
      }
      else if(total == 1){
        $("#count_sel").text(total + " file selected.");
      } else if(total > 1){
        if(total == all){
          $("#count_sel").text("All files selected.");
        }
        else if(total < all){
          $("#count_sel").text(total + " files selected."); 
        }
      } 
  });