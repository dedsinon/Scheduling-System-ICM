
          $(document).ready(function() 
            {
              $("#showhide").click(function() 
            {
                if ($(this).data('val') == "1") 
                  {
                    $("#password").prop('type','text');
                    $("#eye").attr("class","glyphicon glyphicon-eye-close");
                    $(this).data('val','0');
            }
                else
                  {
                    $("#password").prop('type', 'password');
                    $("#eye").attr("class","glyphicon glyphicon-eye-open");
                    $(this).data('val','1');
                  }
            });
            });

        